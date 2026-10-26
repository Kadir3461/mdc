#!/usr/bin/env python3
"""
Deployment von mdc-facility.de auf den IONOS-Webspace (SFTP).

Läuft unter Windows, macOS und Linux.

Einmalig installieren:
    pip install paramiko

Aufruf (im Projektordner):
    python deploy/deploy.py            # nur geänderte Dateien hochladen
    python deploy/deploy.py --dry-run  # nur anzeigen, was hochgeladen würde
    python deploy/deploy.py --all      # alle Dateien neu hochladen
    python deploy/deploy.py --delete   # zusätzlich Dateien löschen, die lokal nicht mehr existieren
                                       # (der Ordner uploads/ wird dabei nie angefasst)

Passwort:
    Entweder unten bei SFTP_PASSWORD eintragen, über die Umgebungsvariable
    MDC_SFTP_PASSWORD setzen oder leer lassen - dann fragt das Skript danach.
"""

import argparse
import fnmatch
import os
import posixpath
import stat
import sys
import unicodedata
import urllib.request
from getpass import getpass
from pathlib import Path

# ---------------------------------------------------------------------------
# Zugangsdaten
# ---------------------------------------------------------------------------
SFTP_HOST = "access-5021642580.webspace-host.com"
SFTP_PORT = 22
SFTP_USER = "su1691709"
SFTP_PASSWORD = ""  # WICHTIG: Passwort nicht committen! Leer lassen = Abfrage beim Start.

REMOTE_ROOT = "/mdc/live/public"
LIVE_URL = "https://www.mdc-facility.de/"

# ---------------------------------------------------------------------------
# Was nicht auf den Server gehört
# ---------------------------------------------------------------------------
EXCLUDE_DIRS = {
    ".git", ".ddev", ".idea", ".vscode", "docker", "deploy", "node_modules", "__pycache__",
}
EXCLUDE_FILES = [
    ".env", ".env.*", ".gitignore", ".DS_Store", "Thumbs.db", "desktop.ini",
    "Dockerfile", "docker-compose.yml", "*.md", "*.sql", "*.log", "*.orig", "*.swp",
    "image.png", "cookies.txt", "kontakt_get.html", "post_response.html",
]
# Diese Remote-Ordner werden bei --delete nie bereinigt (Admin-Uploads auf dem Server)
PROTECTED_REMOTE_DIRS = ["uploads"]


def project_root() -> Path:
    here = Path(__file__).resolve().parent
    return here.parent if here.name == "deploy" else here


def is_excluded(rel_path: str) -> bool:
    parts = rel_path.split("/")
    if any(part in EXCLUDE_DIRS for part in parts[:-1]):
        return True
    name = parts[-1]
    return any(fnmatch.fnmatch(name, pattern) for pattern in EXCLUDE_FILES)


def nfc(text: str) -> str:
    # macOS speichert Umlaute zerlegt (NFD); Server und HTML erwarten NFC (z. B. "Büroreinigung.jpg")
    return unicodedata.normalize("NFC", text)


def collect_local_files(root: Path) -> dict:
    files = {}
    for path in root.rglob("*"):
        if not path.is_file():
            continue
        rel = nfc(path.relative_to(root).as_posix())
        if is_excluded(rel):
            continue
        st = path.stat()
        files[rel] = (path, st.st_size, int(st.st_mtime))
    return files


def remote_stat(sftp, path):
    try:
        return sftp.stat(path)
    except IOError:
        return None


def ensure_remote_dir(sftp, remote_dir: str, known: set):
    if remote_dir in known or remote_dir in ("", "/"):
        return
    ensure_remote_dir(sftp, posixpath.dirname(remote_dir), known)
    if remote_stat(sftp, remote_dir) is None:
        sftp.mkdir(remote_dir)
    known.add(remote_dir)


def walk_remote(sftp, base: str, rel: str = ""):
    current = posixpath.join(base, rel) if rel else base
    for entry in sftp.listdir_attr(current):
        child_rel = posixpath.join(rel, entry.filename) if rel else entry.filename
        if stat.S_ISDIR(entry.st_mode):
            yield from walk_remote(sftp, base, child_rel)
        else:
            yield nfc(child_rel)


def check_live_site():
    try:
        req = urllib.request.Request(LIVE_URL, headers={"User-Agent": "mdc-deploy"})
        with urllib.request.urlopen(req, timeout=20) as resp:
            body = resp.read().decode("utf-8", "replace")
            broken = any(s in body for s in ("Fatal error", "Parse error", "Warning:"))
            return resp.status, broken
    except Exception as exc:  # nur Statusanzeige
        return str(exc), True


def main():
    parser = argparse.ArgumentParser(description="Deployment von mdc-facility.de per SFTP")
    parser.add_argument("--dry-run", action="store_true", help="nichts hochladen, nur anzeigen")
    parser.add_argument("--all", action="store_true", help="alle Dateien hochladen, nicht nur geänderte")
    parser.add_argument("--delete", action="store_true", help="auf dem Server fehlende lokale Dateien entfernen")
    parser.add_argument("--yes", "-y", action="store_true", help="ohne Rückfrage ausführen")
    args = parser.parse_args()

    try:
        import paramiko
    except ImportError:
        print("Fehler: Das Paket 'paramiko' fehlt. Bitte installieren mit:\n    pip install paramiko")
        return 1

    root = project_root()
    if not (root / "index.php").exists():
        print(f"Fehler: Projektordner nicht gefunden ({root}).")
        return 1

    local_files = collect_local_files(root)
    print(f"Projekt:  {root}")
    print(f"Ziel:     {SFTP_USER}@{SFTP_HOST}:{REMOTE_ROOT}")
    print(f"Dateien:  {len(local_files)} lokal\n")

    password = SFTP_PASSWORD or os.environ.get("MDC_SFTP_PASSWORD", "")
    if not password:
        password = getpass(f"SFTP-Passwort für {SFTP_USER}: ")

    transport = paramiko.Transport((SFTP_HOST, SFTP_PORT))
    try:
        transport.connect(username=SFTP_USER, password=password)
    except paramiko.AuthenticationException:
        print("Fehler: Anmeldung fehlgeschlagen - Passwort prüfen.")
        transport.close()
        return 1
    sftp = paramiko.SFTPClient.from_transport(transport)

    try:
        if remote_stat(sftp, REMOTE_ROOT) is None:
            print(f"Fehler: Zielordner {REMOTE_ROOT} existiert nicht auf dem Server.")
            return 1

        to_upload = []
        for rel, (_path, size, mtime) in sorted(local_files.items()):
            remote = remote_stat(sftp, posixpath.join(REMOTE_ROOT, rel))
            if args.all or remote is None or remote.st_size != size or int(remote.st_mtime or 0) < mtime:
                to_upload.append(rel)

        to_delete = []
        if args.delete:
            for rel in walk_remote(sftp, REMOTE_ROOT):
                if rel.split("/")[0] in PROTECTED_REMOTE_DIRS:
                    continue
                if rel not in local_files and not is_excluded(rel):
                    to_delete.append(rel)

        if not to_upload and not to_delete:
            print("Alles aktuell - nichts zu tun.")
            return 0

        for rel in to_upload:
            print(f"  hochladen  {rel}")
        for rel in to_delete:
            print(f"  löschen    {rel}")
        print(f"\n{len(to_upload)} Datei(en) hochladen, {len(to_delete)} löschen.")

        if args.dry_run:
            print("Testlauf (--dry-run): keine Änderungen vorgenommen.")
            return 0

        if not args.yes and input("Fortfahren? [j/N] ").strip().lower() not in ("j", "ja", "y", "yes"):
            print("Abgebrochen.")
            return 0

        known_dirs = set()
        for i, rel in enumerate(to_upload, 1):
            path, _size, mtime = local_files[rel]
            remote_path = posixpath.join(REMOTE_ROOT, rel)
            ensure_remote_dir(sftp, posixpath.dirname(remote_path), known_dirs)
            sftp.put(str(path), remote_path)
            sftp.utime(remote_path, (mtime, mtime))
            print(f"  [{i}/{len(to_upload)}] {rel}")

        for rel in to_delete:
            sftp.remove(posixpath.join(REMOTE_ROOT, rel))
            print(f"  gelöscht   {rel}")
    finally:
        sftp.close()
        transport.close()

    status, broken = check_live_site()
    print(f"\nLive-Check {LIVE_URL}: HTTP {status}")
    if status != 200 or broken:
        print("ACHTUNG: Die Website antwortet nicht fehlerfrei - bitte prüfen!")
        return 2

    print("Deployment erfolgreich abgeschlossen.")
    return 0


if __name__ == "__main__":
    try:
        sys.exit(main())
    except KeyboardInterrupt:
        print("\nAbgebrochen.")
        sys.exit(130)
