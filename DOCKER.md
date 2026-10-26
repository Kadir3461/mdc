# MDC Facility Management - Docker Setup

## 🐳 Schnellstart mit Docker

### Container starten

```bash
cd c:\Users\kaya-\Development\MD_Reinigung
docker-compose up -d
```

### Zugriff auf die Website

Nach dem Start der Container:

- **Website:** http://localhost:8000
- **phpMyAdmin:** http://localhost:8080
  - Benutzer: `root`
  - Passwort: `root123`

### Demo-Zugänge

**Admin-Login:**
- URL: http://localhost:8000/login.php
- E-Mail: `admin@mdc-facility.de`
- Passwort: wird beim Setup individuell vergeben (siehe database.sql)

**Kunden-Login:**
- E-Mail: `kunde@beispiel.de`
- Passwort: wird beim Setup individuell vergeben (Konto standardmaessig inaktiv)

## 📋 Container-Übersicht

Der Docker-Stack enthält:

1. **PHP 8.1 + Apache** (Port 8000)
   - PHP mit PDO, MySQL-Erweiterungen
   - Apache mit mod_rewrite
   - Ihre Website-Dateien

2. **MySQL 8.0** (Port 3306)
   - Datenbank: `mdc_cleaning`
   - Automatischer Import von `database.sql`
   - Persistente Daten in Volume

3. **phpMyAdmin** (Port 8080)
   - Webbasierte Datenbankverwaltung

## 🛠️ Wichtige Docker-Befehle

### Container starten
```bash
docker-compose up -d
```

### Container stoppen
```bash
docker-compose down
```

### Container stoppen und Datenbank löschen
```bash
docker-compose down -v
```

### Logs ansehen
```bash
# Alle Container
docker-compose logs -f

# Nur PHP
docker-compose logs -f php

# Nur MySQL
docker-compose logs -f mysql
```

### Container neu starten
```bash
docker-compose restart
```

### Container neu bauen (nach Änderungen am Dockerfile)
```bash
docker-compose up -d --build
```

### In Container-Shell einsteigen
```bash
# PHP Container
docker exec -it mdc_reinigung_php bash

# MySQL Container
docker exec -it mdc_reinigung_mysql bash
```

## 🔧 Konfiguration

### Datenbank-Verbindung

Die Datei `config/database.php` ist bereits für Docker konfiguriert:

- **Host:** `mysql` (Service-Name aus docker-compose.yml)
- **Datenbank:** `mdc_cleaning`
- **Benutzer:** `mdc_user`
- **Passwort:** `mdc_pass123`

### Passwörter ändern

Bearbeiten Sie `docker-compose.yml`:

```yaml
mysql:
  environment:
    MYSQL_ROOT_PASSWORD: IhrNeuesPasswort
    MYSQL_USER: IhrBenutzer
    MYSQL_PASSWORD: IhrBenutzerPasswort
```

Dann Container neu erstellen:
```bash
docker-compose down -v
docker-compose up -d
```

## 📁 Verzeichnisstruktur

```
MD_Reinigung/
├── docker-compose.yml     # Docker-Orchestrierung
├── Dockerfile             # PHP/Apache Image
├── .env.example          # Umgebungsvariablen (optional)
├── config/
│   └── database.php      # DB-Config (Docker-ready)
├── database.sql          # Wird automatisch importiert
└── ...                   # Ihre Website-Dateien
```

## 🐛 Troubleshooting

### Website zeigt Datenbankfehler

**Problem:** "Verbindung zur Datenbank fehlgeschlagen"

**Lösung:**
```bash
# Prüfen ob MySQL bereit ist
docker-compose logs mysql

# Warten bis "ready for connections" erscheint
# Dann PHP-Container neu starten
docker-compose restart php
```

### Port bereits in Verwendung

**Problem:** "Bind for 0.0.0.0:8000 failed: port is already allocated"

**Lösung 1:** Anderen Port verwenden (docker-compose.yml ändern):
```yaml
php:
  ports:
    - "8001:80"  # Statt 8000
```

**Lösung 2:** Prozess auf Port 8000 beenden:
```bash
# Port-Nutzung prüfen
netstat -ano | findstr :8000

# Prozess beenden (ID aus obigem Befehl)
taskkill /PID <ProzessID> /F
```

### Datenbank nicht initialisiert

**Problem:** Tabellen fehlen

**Lösung:**
```bash
# Container stoppen und Volumes löschen
docker-compose down -v

# Neu starten (database.sql wird automatisch importiert)
docker-compose up -d

# Logs überprüfen
docker-compose logs mysql
```

### Datei-Upload funktioniert nicht

**Problem:** "Permission denied" beim Upload

**Lösung:**
```bash
# In PHP-Container einsteigen
docker exec -it mdc_reinigung_php bash

# Rechte setzen
chown -R www-data:www-data /var/www/html/uploads
chmod -R 755 /var/www/html/uploads
exit
```

### Code-Änderungen werden nicht übernommen

**Problem:** Website zeigt alte Version

**Lösung:**
```bash
# Browser-Cache leeren (Strg+Shift+R)

# Oder Container neu bauen
docker-compose up -d --build
```

## 🚀 Produktiv-Deployment

Für Produktion ändern Sie:

1. **Sichere Passwörter** in docker-compose.yml
2. **SSL-Zertifikat** hinzufügen (Let's Encrypt)
3. **Error Reporting** ausschalten in config/database.php
4. **Volume Backup** einrichten

```bash
# Datenbank-Backup erstellen
docker exec mdc_reinigung_mysql mysqldump -u root -proot123 mdc_cleaning > backup.sql
```

## 📞 Support

Bei Fragen:
- **README.md** - Vollständige Dokumentation
- **Docker Logs** - `docker-compose logs -f`

---

**Version:** 1.0.0  
**Erstellt:** 07.06.2026
