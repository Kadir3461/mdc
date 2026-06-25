<?php
/**
 * Datenbankkonfiguration für MDC Facility & Cleaning
 * 
 * WICHTIG: Ändern Sie diese Werte entsprechend Ihrer Hosting-Umgebung
 */

// Datenbank-Verbindungsparameter
// Für Docker: Hostname ist der Service-Name aus docker-compose.yml
define('DB_HOST', 'mysql');
define('DB_NAME', 'mdc_cleaning');
define('DB_USER', 'mdc_user');
define('DB_PASS', 'mdc_pass123');
define('DB_CHARSET', 'utf8mb4');

// Sitzungskonfiguration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Auf 1 setzen bei HTTPS
ini_set('session.cookie_samesite', 'Lax');

// Zeitzone
date_default_timezone_set('Europe/Berlin');

// E-Mail-Konfiguration
define('CONTACT_EMAIL', 'Info@mdc-fm.de');
define('SITE_NAME', 'MDC Facility & Cleaning');
define('SITE_URL', 'http://localhost'); // Ändern zur tatsächlichen URL

// Upload-Konfiguration
define('MAX_FILE_SIZE', 10485760); // 10MB in Bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOC_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
define('UPLOAD_IMAGE_PATH', __DIR__ . '/../uploads/images/');
define('UPLOAD_DOC_PATH', __DIR__ . '/../uploads/documents/');
define('ARCHIVE_PATH', __DIR__ . '/../archive/');

// Fehlerbehandlung (für Produktion auf 0 setzen)
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Datenbankverbindung mit PDO erstellen
 * 
 * @return PDO|null
 */
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
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
    if (!isset($_SESSION['csrf_token'])) {
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
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Session starten
startSecureSession();
