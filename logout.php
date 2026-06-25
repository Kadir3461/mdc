<?php
require_once 'config/database.php';

// Session beenden
session_unset();
session_destroy();

// Neue Session für die Nachricht
session_start();
$_SESSION['logout_message'] = 'Sie wurden erfolgreich abgemeldet.';

// Zum Login umleiten
header('Location: /login.php');
exit;
