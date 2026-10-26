<?php
/**
 * Datenbankkonfiguration für MDC Facility Management
 * 
 * WICHTIG: Ändern Sie diese Werte entsprechend Ihrer Hosting-Umgebung
 */

/**
 * Werte aus einer .env-Datei laden (falls vorhanden).
 * Gesucht wird zuerst oberhalb des Webroots (Live-Server), dann im Projektverzeichnis.
 */
(function () {
    $candidates = [
        __DIR__ . '/../../.env',
        __DIR__ . '/../.env',
    ];

    $envFile = null;
    foreach ($candidates as $candidate) {
        if (is_readable($candidate)) {
            $envFile = $candidate;
            break;
        }
    }

    if ($envFile === null) {
        return;
    }

    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        if (strlen($value) >= 2 && ($value[0] === '"' || $value[0] === "'") && substr($value, -1) === $value[0]) {
            $value = substr($value, 1, -1);
        }

        if ($key !== '' && getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
})();

/**
 * Konfigurationswert aus der Umgebung lesen, sonst Standardwert verwenden.
 */
function env_value($key, $default = null)
{
    $value = getenv($key);

    return ($value === false || $value === '') ? $default : $value;
}

// Datenbank-Verbindungsparameter
// Für Docker: Hostname ist der Service-Name aus docker-compose.yml
define('DB_HOST', env_value('DB_HOST', 'mysql'));
define('DB_NAME', env_value('DB_NAME', 'mdc_cleaning'));
define('DB_USER', env_value('DB_USER', 'mdc_user'));
define('DB_PASS', env_value('DB_PASS', 'mdc_pass123'));
define('DB_PORT', (int) env_value('DB_PORT', 3306));
define('DB_CHARSET', 'utf8mb4');

// Umgebung: "production" auf dem Live-Server, sonst "development"
define('APP_ENV', env_value('APP_ENV', 'development'));
define('IS_PRODUCTION', APP_ENV === 'production');

// Sitzungskonfiguration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['SERVER_PORT'] ?? 80) == 443)
    || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
ini_set('session.cookie_secure', $isHttps ? 1 : 0);
ini_set('session.cookie_samesite', 'Lax');

// Zeitzone
date_default_timezone_set('Europe/Berlin');

// E-Mail-Konfiguration
// CONTACT_EMAIL: Empfänger der Kontaktanfragen (mehrere durch Komma getrennt)
// MAIL_FROM: Absenderadresse der eigenen Domain (wichtig für SPF/Zustellbarkeit)
define('CONTACT_EMAIL', env_value('CONTACT_EMAIL', 'Info@mdc-fm.de,kaya.kadir3461@gmail.com'));
define('MAIL_FROM', env_value('MAIL_FROM', 'kontakt@mdc-facility.de'));
define('SITE_NAME', 'MDC Facility Management');

// Firmendaten (u. a. für die E-Mail-Signatur)
define('COMPANY_NAME', 'MDC Facility Management');
define('COMPANY_STREET', 'Rosa-Kempf-Str. 23');
define('COMPANY_CITY', '81248 München');
define('COMPANY_PHONE', '+49 89 38043537');
define('COMPANY_PHONE_LINK', '+498938043537');
define('COMPANY_FAX', '+49 89 38043538');
define('COMPANY_EMAIL', 'Info@mdc-fm.de');

// Host-Header gegen eine Whitelist prüfen, damit Links in E-Mails und
// Meta-Tags nicht auf fremde Domains umgebogen werden können
$allowedHosts = array_filter(array_map('trim', explode(',', (string) env_value('ALLOWED_HOSTS', 'mdc-facility.de,www.mdc-facility.de,localhost,mdc.ddev.site'))));
$requestHost  = strtolower(preg_replace('/:\d+$/', '', (string) ($_SERVER['HTTP_HOST'] ?? '')));

$siteHost = 'www.mdc-facility.de';
foreach ($allowedHosts as $allowedHost) {
    if ($requestHost === strtolower($allowedHost)) {
        $siteHost = $_SERVER['HTTP_HOST'];
        break;
    }
}

$siteProtocol = $isHttps ? 'https' : 'http';
define('SITE_URL', env_value('SITE_URL', $siteProtocol . '://' . $siteHost));

// Upload-Konfiguration
define('MAX_FILE_SIZE', 10485760); // 10MB in Bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOC_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
define('UPLOAD_IMAGE_PATH', __DIR__ . '/../uploads/images/');
define('UPLOAD_DOC_PATH', __DIR__ . '/../uploads/documents/');
define('ARCHIVE_PATH', __DIR__ . '/../archive/');

// Fehlerbehandlung: im Live-Betrieb keine Details im Browser anzeigen
if (IS_PRODUCTION) {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

/**
 * Asset-URL mit Versionsstempel (Cache-Busting).
 * So erhalten Besucher nach einem Update sofort die neue Datei,
 * obwohl statische Dateien lange im Browser zwischengespeichert werden.
 */
function asset_url($path)
{
    $file = __DIR__ . '/..' . $path;
    $version = is_readable($file) ? filemtime($file) : null;

    return $version ? $path . '?v=' . $version : $path;
}

/**
 * Datenbankverbindung mit PDO erstellen
 * 
 * @return PDO|null
 */
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Datenbankverbindungsfehler: " . $e->getMessage());
            die("Verbindung zur Datenbank konnte nicht hergestellt werden.");
        }
    }
    
    return $pdo;
}

/**
 * Session sicher starten
 */
function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
        // Session-Fixation-Angriffe verhindern
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
        
        // Session-Hijacking erschweren
        if (!isset($_SESSION['user_agent'])) {
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
        } elseif ($_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {
            session_unset();
            session_destroy();
            session_start();
        }
    }
}

/**
 * Prüfen ob Benutzer eingeloggt ist
 * 
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}

/**
 * Prüfen ob Benutzer Admin ist
 * 
 * @return bool
 */
function isAdmin() {
    return isLoggedIn() && $_SESSION['user_role'] === 'admin';
}

/**
 * Prüfen ob Benutzer Kunde ist
 * 
 * @return bool
 */
function isCustomer() {
    return isLoggedIn() && $_SESSION['user_role'] === 'customer';
}

/**
 * Zum Login umleiten wenn nicht eingeloggt
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}

/**
 * Admin-Zugriff erzwingen
 */
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: /dashboard.php');
        exit;
    }
}

/**
 * XSS-Schutz: HTML-Sonderzeichen escapen
 * 
 * @param string $string
 * @return string
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF-Token generieren
 * 
 * @return string
 */
function generateCSRFToken() {
    if (session_status() === PHP_SESSION_NONE) {
        startSecureSession();
    }

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || $_SESSION['csrf_token'] === '') {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * CSRF-Token validieren
 * 
 * @param string $token
 * @return bool
 */
function validateCSRFToken($token) {
    if (!is_string($token) || !isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $token);
}

// Session starten
startSecureSession();
