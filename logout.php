<?php
require_once 'config/database.php';

// Session vollständig beenden
$_SESSION = [];

// Session-Cookie im Browser löschen
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

// Neue Session mit frischer ID für die Abmeldemeldung
session_start();
session_regenerate_id(true);
$_SESSION['logout_message'] = 'Sie wurden erfolgreich abgemeldet.';

// Zum Login umleiten
header('Location: /login.php');
exit;
