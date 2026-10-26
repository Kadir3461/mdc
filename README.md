# MDC Facility Management - Unternehmenswebsite

![MDC Logo](assets/images/logo.svg)

Eine vollständige, moderne und professionelle Unternehmenswebsite für MDC Facility Management im Bereich Gebäudereinigung, Industriereinigung und Facility Management in München.

## 📋 Inhaltsverzeichnis

- [Features](#features)
- [Technologie-Stack](#technologie-stack)
- [Anforderungen](#anforderungen)
- [Installation](#installation)
- [Konfiguration](#konfiguration)
- [Struktur](#struktur)
- [Benutzer-Accounts](#benutzer-accounts)
- [Sicherheit](#sicherheit)
- [SEO](#seo)
- [Support](#support)

## ✨ Features

### Hauptfunktionen
- ✅ Moderne, responsive Website (Desktop, Tablet, Mobile)
- ✅ Professionelles Design mit Blau/Weiß/Hellgrau Farbschema
- ✅ 13 vollständige Seiten (Startseite, Leistungen, Über uns, Kontakt, etc.)
- ✅ Login-System mit Admin- und Kundenbereich
- ✅ Kontaktformular mit E-Mail-Benachrichtigung
- ✅ Google Maps Integration
- ✅ SEO-optimiert mit Schema.org Markup
- ✅ DSGVO-konform mit Cookie-Consent
- ✅ Moderne Icons (Font Awesome)
- ✅ Smooth Scrolling und Animationen

### Admin-Funktionen
- 👨‍💼 Kunden verwalten (anlegen, bearbeiten, löschen)
- 📁 Bilder und Dokumente hochladen
- 🔗 Dateien Kunden zuordnen
- 📦 Dokumente archivieren
- 📊 Dashboard mit Statistiken
- 💬 Nachrichten-System
- 📝 Kontaktanfragen verwalten
- 📈 Aktivitätsprotokolle

### Kunden-Funktionen
- 👤 Profil ansehen und bearbeiten
- 📷 Hochgeladene Bilder ansehen
- 📄 Dokumente herunterladen
- 🗄️ Archivierte Dokumente einsehen
- 💬 Nachrichten an Admin senden

## 🛠️ Technologie-Stack

- **Backend:** PHP 7.4+ (PDO für Datenbank)
- **Datenbank:** MySQL 5.7+ / MariaDB 10.3+
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **Icons:** Font Awesome 6.4
- **Fonts:** Google Fonts (Inter, Poppins)
- **Responsive:** Mobile-First Design

## 📦 Anforderungen

### Server-Anforderungen
- PHP 7.4 oder höher
- MySQL 5.7+ oder MariaDB 10.3+
- Apache oder Nginx Webserver
- mod_rewrite (für Apache)
- PHP Extensions:
  - PDO
  - pdo_mysql
  - mbstring
  - openssl

### Empfohlene Spezifikationen
- PHP 8.0+
- 512 MB RAM (minimum)
- 1 GB freier Speicherplatz
- SSL-Zertifikat (HTTPS)

## 🚀 Deployment (Live-Server)

Updates werden mit dem Skript [`deploy/deploy.py`](deploy/deploy.py) per SFTP auf den IONOS-Webspace (`/mdc/live/public`) übertragen. Es läuft unter Windows, macOS und Linux und lädt nur geänderte Dateien hoch.

**Einmalig:** Python 3 installieren, dann `pip install paramiko`

```bash
git pull
python deploy/deploy.py --dry-run   # zeigt, was hochgeladen würde
python deploy/deploy.py             # hochladen (mit Rückfrage)
```

Unter Windows genügt ein Doppelklick auf `deploy\deploy.bat` (installiert `paramiko` bei Bedarf automatisch).

- **Passwort:** in `deploy.py` bei `SFTP_PASSWORD` eintragen, über die Umgebungsvariable `MDC_SFTP_PASSWORD` setzen oder leer lassen – dann wird es beim Start abgefragt. Ein eingetragenes Passwort **nicht committen**.
- **Weitere Optionen:** `--all` (alles neu hochladen), `--delete` (auf dem Server entfernen, was lokal gelöscht wurde; `uploads/` bleibt immer unangetastet), `--yes` (ohne Rückfrage).
- Nicht übertragen werden u. a. `.env`, `.git`, `.ddev`, `deploy/`, `*.md` und `*.sql`. Die Produktions-`.env` liegt auf dem Server außerhalb des Webroots unter `/mdc/live/.env`.
- Nach dem Upload prüft das Skript automatisch, ob https://www.mdc-facility.de/ fehlerfrei antwortet.

## 🚀 Installation

### Schritt 1: Dateien hochladen

1. Laden Sie alle Dateien auf Ihren Webserver hoch (z.B. per FTP)
2. Platzieren Sie die Dateien im Document Root (meist `public_html/` oder `htdocs/`)

```
/public_html/
├── config/
├── includes/
├── assets/
├── admin/
├── uploads/
├── archive/
├── index.php
├── ...
└── database.sql
```

### Schritt 2: Datenbank erstellen

1. Öffnen Sie phpMyAdmin oder ein anderes MySQL-Tool
2. Erstellen Sie eine neue Datenbank: `mdc_cleaning`
3. Importieren Sie die Datei `database.sql`:
   - In phpMyAdmin: Reiter "Importieren" → Datei auswählen → "OK"
   - Per Terminal:
   ```bash
   mysql -u benutzername -p mdc_cleaning < database.sql
   ```

### Schritt 3: Konfiguration anpassen

Öffnen Sie die Datei `config/database.php` und passen Sie folgende Werte an:

```php
define('DB_HOST', 'localhost');        // Ihr Datenbank-Host
define('DB_NAME', 'mdc_cleaning');     // Ihr Datenbankname
define('DB_USER', 'ihr_username');     // Ihr Datenbank-Benutzername
define('DB_PASS', 'ihr_passwort');     // Ihr Datenbank-Passwort

define('CONTACT_EMAIL', 'kontakt@mdc-facility.de');  // Ihre E-Mail-Adresse
define('SITE_URL', 'https://www.ihre-domain.de');  // Ihre Website-URL
```

### Schritt 4: Verzeichnisrechte setzen

Setzen Sie die Schreibrechte für Upload-Ordner:

```bash
chmod 755 uploads/
chmod 755 uploads/images/
chmod 755 uploads/documents/
chmod 755 archive/
```

Oder über FTP-Client: Rechtsklick → Dateirechte → 755

### Schritt 5: SSL-Zertifikat einrichten (empfohlen)

1. Bei den meisten Hostern kostenlos über Let's Encrypt verfügbar
2. In `config/database.php` die Session-Sicherheit aktivieren:
   ```php
   ini_set('session.cookie_secure', 1);  // Auf 1 setzen für HTTPS
   ```

### Schritt 6: Website testen

1. Öffnen Sie Ihre Website im Browser
2. Testen Sie die Navigation
3. Testen Sie das Kontaktformular
4. Melden Sie sich mit den Demo-Zugängen an

## ⚙️ Konfiguration

### E-Mail-Konfiguration

Die Website verwendet die PHP `mail()` Funktion. Bei manchen Hostern müssen Sie SMTP konfigurieren. 
Empfehlung: Verwenden Sie PHPMailer für bessere E-Mail-Zustellung.

### Google Maps API

1. Holen Sie sich einen Google Maps API Key: https://developers.google.com/maps
2. Ersetzen Sie in den relevanten Seiten die Maps-Embed-URL mit Ihrem API Key
3. Passen Sie die Koordinaten für Rosa-Kempf-Str. 23, München an

### Anpassungen

**Logo ändern:**
- Ersetzen Sie `/assets/images/logo.svg` mit Ihrem eigenen Logo
- Achten Sie auf transparenten Hintergrund

**Farben anpassen:**
- Öffnen Sie `/assets/css/style.css`
- Ändern Sie die CSS-Variablen im `:root` Bereich:
```css
:root {
    --primary-color: #0066CC;
    --secondary-color: #00A3E0;
    --accent-color: #FFB81C;
}
```

**Kontaktdaten:**
- Suchen Sie nach "+49 1516 7664588" und ersetzen Sie durch Ihre Telefonnummer
- Suchen Sie nach "kontakt@mdc-facility.de" und ersetzen Sie durch Ihre E-Mail

## 📁 Struktur

```
MD_Reinigung/
├── config/
│   └── database.php           # Datenbank-Konfiguration
├── includes/
│   ├── header.php            # Header-Template
│   └── footer.php            # Footer-Template
├── assets/
│   ├── css/
│   │   └── style.css         # Haupt-Stylesheet
│   ├── js/
│   │   └── main.js           # JavaScript-Funktionen
│   └── images/
│       └── logo.svg          # Logo
├── admin/                    # Admin-Bereich (zu erstellen)
├── uploads/
│   ├── images/               # Hochgeladene Bilder
│   └── documents/            # Hochgeladene Dokumente
├── archive/                  # Archivierte Dateien
├── index.php                 # Startseite
├── industriereinigung.php    # Industriereinigung
├── gebaeudereinigung.php     # Gebäudereinigung
├── bueroreinigung.php        # Büroreinigung
├── hausmeisterservice.php    # Hausmeisterservice
├── facility-management.php   # Facility Management
├── leistungen.php            # Leistungsübersicht
├── ueber-uns.php             # Über uns
├── kontakt.php               # Kontakt mit Formular
├── login.php                 # Login-Seite
├── logout.php                # Logout
├── dashboard.php             # Dashboard (Admin/Kunde)
├── datenschutz.php           # Datenschutzerklärung
├── impressum.php             # Impressum
├── sitemap.xml               # XML-Sitemap
├── robots.txt                # Robots.txt
├── database.sql              # Datenbank-Schema
└── README.md                 # Diese Datei
```

## 👥 Benutzer-Accounts

### Demo-Zugänge (nach Installation verfügbar)

**Admin-Account:**
- E-Mail: `admin@mdc-facility.de`
- Passwort: wird beim Setup individuell vergeben (siehe database.sql)
- Rolle: Administrator

**Kunden-Account:**
- E-Mail: `kunde@beispiel.de`
- Passwort: wird beim Setup individuell vergeben (Konto standardmaessig inaktiv)
- Rolle: Kunde

### Neue Benutzer anlegen

**Als Admin über Dashboard:**
1. Login als Admin
2. Dashboard → "Kunden verwalten"
3. Neuen Kunden anlegen

**Manuell in der Datenbank:**
```sql
-- Neuen Benutzer erstellen
INSERT INTO users (email, password, role, status) 
VALUES ('neuer@kunde.de', '$2y$10$...', 'customer', 'active');

-- Kundenprofil erstellen
INSERT INTO customer_profiles (user_id, company_name, contact_person, phone, customer_number)
VALUES (LAST_INSERT_ID(), 'Firma GmbH', 'Max Mustermann', '089123456', 'KD-2026-002');
```

**Passwort hashen:**
```php
<?php
echo password_hash('MeinPasswort123', PASSWORD_DEFAULT);
?>
```

## 🔒 Sicherheit

### Implementierte Sicherheitsmaßnahmen

- ✅ **SQL-Injection-Schutz:** Prepared Statements mit PDO
- ✅ **XSS-Schutz:** htmlspecialchars() für alle Ausgaben
- ✅ **CSRF-Schutz:** Token-Validierung für Formulare
- ✅ **Passwort-Hashing:** bcrypt mit password_hash()
- ✅ **Session-Sicherheit:** HttpOnly, SameSite Cookies
- ✅ **Login-Schutz:** Max. 5 Fehlversuche, dann Account-Sperre
- ✅ **Activity Logging:** Alle wichtigen Aktionen werden protokolliert

### Empfohlene zusätzliche Maßnahmen

1. **SSL/TLS aktivieren** (HTTPS)
2. **Firewall konfigurieren**
3. **Regelmäßige Updates**
4. **Starke Passwörter erzwingen**
5. **Backup-Strategie implementieren**
6. **2-Faktor-Authentifizierung** (optional)

### Wichtige Sicherheitshinweise

⚠️ **Vor Produktivbetrieb:**
1. Ändern Sie alle Demo-Passwörter
2. Setzen Sie `error_reporting` und `display_errors` in `config/database.php` auf 0
3. Aktivieren Sie HTTPS
4. Löschen Sie `database.sql` vom Server
5. Schützen Sie `/admin/` mit .htaccess

**.htaccess für Admin-Bereich:**
```apache
<Files ~ "\.php$">
  Order allow,deny
  Allow from all
</Files>
```

## 📈 SEO

### Implementierte SEO-Features

- ✅ Semantisches HTML5
- ✅ Meta Tags (Title, Description, Keywords)
- ✅ Open Graph Tags (Social Media)
- ✅ Schema.org LocalBusiness Markup
- ✅ Sitemap.xml
- ✅ Robots.txt
- ✅ Alt-Texte für Bilder
- ✅ Saubere URL-Struktur
- ✅ Mobile-Friendly Design
- ✅ Schnelle Ladezeiten
- ✅ Interne Verlinkung

### SEO-Optimierung

**Google Search Console:**
1. Website bei Google Search Console anmelden
2. Sitemap einreichen: `https://ihre-domain.de/sitemap.xml`
3. Regelmäßig Performance überwachen

**Google My Business:**
1. Profil erstellen für MDC Facility Management
2. Adresse, Telefon, Öffnungszeiten eintragen
3. Fotos hochladen
4. Kundenbewertungen sammeln

## 🔧 Wartung

### Regelmäßige Aufgaben

**Täglich:**
- Kontaktanfragen prüfen
- Neue Nachrichten beantworten

**Wöchentlich:**
- Backup der Datenbank erstellen
- Activity Logs überprüfen
- Website-Funktionalität testen

**Monatlich:**
- PHP und MySQL Updates prüfen
- Sicherheitsupdates installieren
- SEO-Performance überprüfen
- Alte Logs archivieren

### Backup

**Datenbank-Backup erstellen:**
```bash
mysqldump -u username -p mdc_cleaning > backup_$(date +%Y%m%d).sql
```

**Dateien-Backup:**
```bash
tar -czf backup_files_$(date +%Y%m%d).tar.gz /pfad/zur/website/
```

**Automatisches Backup (cron):**
```bash
# In crontab einfügen (crontab -e)
0 2 * * * /pfad/zum/backup-script.sh
```

## 🐛 Troubleshooting

### Häufige Probleme

**Problem: "Verbindung zur Datenbank fehlgeschlagen"**
- Lösung: Prüfen Sie die Zugangsdaten in `config/database.php`
- Stellen Sie sicher, dass MySQL läuft
- Prüfen Sie, ob die Datenbank existiert

**Problem: "Kontaktformular sendet keine E-Mails"**
- Lösung: Prüfen Sie die `mail()` Konfiguration
- Viele Hoster blockieren die `mail()` Funktion
- Verwenden Sie PHPMailer mit SMTP

**Problem: "404 Fehler beim Laden von CSS/JS"**
- Lösung: Prüfen Sie die Pfade in `includes/header.php`
- Stellen Sie sicher, dass `/assets/` im richtigen Verzeichnis liegt

**Problem: "Upload funktioniert nicht"**
- Lösung: Prüfen Sie die Verzeichnisrechte (755 oder 777)
- Prüfen Sie `upload_max_filesize` in php.ini
- Prüfen Sie `post_max_size` in php.ini

**Problem: "Session-Fehler"**
- Lösung: Prüfen Sie, ob das `/tmp/` Verzeichnis beschreibbar ist
- Setzen Sie `session.save_path` in php.ini

## 📞 Support

### Kontakt

Bei Fragen oder Problemen:

- **E-Mail:** kontakt@mdc-facility.de
- **Telefon:** +49 89 38043537
- **Fax:** +49 89 38043538
- **Adresse:** Rosa-Kempf-Str. 23, 81248 München

### Weiterführende Ressourcen

- [PHP Dokumentation](https://www.php.net/docs.php)
- [MySQL Dokumentation](https://dev.mysql.com/doc/)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Google Fonts](https://fonts.google.com/)

## 📄 Lizenz

© 2026 MDC Facility Management. Alle Rechte vorbehalten.

Diese Website und der Quellcode sind Eigentum von MDC Facility Management.

---

**Version:** 1.0.0  
**Erstellt:** Juni 2026  
**Zuletzt aktualisiert:** <?php echo date('d.m.Y'); ?>

---

## ✅ Checkliste für Produktivbetrieb

- [ ] Datenbank-Zugangsdaten geändert
- [ ] Alle Demo-Passwörter geändert
- [ ] SSL-Zertifikat installiert (HTTPS)
- [ ] Error Reporting ausgeschaltet
- [ ] SITE_URL in config/database.php angepasst
- [ ] E-Mail-Adresse (CONTACT_EMAIL) angepasst
- [ ] Telefonnummer auf allen Seiten angepasst
- [ ] Logo hochgeladen
- [ ] Google Maps API Key eingefügt
- [ ] Impressum ausgefüllt (Firma, Namen, USt-ID)
- [ ] Datenschutzerklärung angepasst
- [ ] Backup-Strategie implementiert
- [ ] Google Search Console eingerichtet
- [ ] Google My Business erstellt
- [ ] Website getestet (alle Links, Formulare, Login)
- [ ] Mobile-Ansicht getestet
- [ ] Kontaktformular getestet
- [ ] Admin-Bereich getestet
- [ ] Upload-Funktion getestet

---

🎉 **Viel Erfolg mit Ihrer neuen Website!**
