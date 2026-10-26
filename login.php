<?php
require_once 'config/database.php';

// Wenn bereits eingeloggt, zum Dashboard umleiten
if (isLoggedIn()) {
    header('Location: /dashboard.php');
    exit;
}

$error = '';

/**
 * Nur interne Pfade als Weiterleitungsziel zulassen (Schutz vor Open Redirect).
 */
function safeRedirectTarget($target)
{
    $target = (string) $target;

    // Steuerzeichen (u. a. Tab) wuerden von Browsern aus der URL entfernt
    // und koennten so eine externe Adresse ergeben -> komplett ablehnen
    if (preg_match('/[\x00-\x20\x7F]/', $target)) {
        return '/dashboard.php';
    }

    // Keine absoluten URLs, keine protokollrelativen Pfade, keine Backslashes
    if ($target === '' || $target[0] !== '/' || strncmp($target, '//', 2) === 0 || strpos($target, '\\') !== false) {
        return '/dashboard.php';
    }

    if (preg_match('#^/[A-Za-z][A-Za-z0-9+.-]*:#', $target)) {
        return '/dashboard.php';
    }

    return $target;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = 'Ihre Sitzung ist abgelaufen. Bitte laden Sie die Seite neu und melden Sie sich erneut an.';
    } elseif (!empty($email) && !empty($password)) {
        $db = getDB();
        
        try {
            $stmt = $db->prepare("SELECT id, email, password, role, status, failed_login_attempts FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Account gesperrt?
                if ($user['status'] === 'locked') {
                    $error = 'Ihr Account wurde gesperrt. Bitte kontaktieren Sie den Administrator.';
                } elseif ($user['status'] === 'inactive') {
                    $error = 'Ihr Account ist inaktiv. Bitte kontaktieren Sie den Administrator.';
                } elseif ($user['failed_login_attempts'] >= 5) {
                    // Account nach 5 Fehlversuchen sperren
                    $stmt = $db->prepare("UPDATE users SET status = 'locked' WHERE id = ?");
                    $stmt->execute([$user['id']]);
                    $error = 'Ihr Account wurde nach zu vielen Fehlversuchen gesperrt.';
                } else {
                    // Passwort prüfen
                    if (password_verify($password, $user['password'])) {
                        // Login erfolgreich - Session-ID erneuern (Schutz vor Session-Fixation)
                        session_regenerate_id(true);

                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['user_role'] = $user['role'];
                        
                        // Failed attempts zurücksetzen und letzten Login aktualisieren
                        $stmt = $db->prepare("UPDATE users SET failed_login_attempts = 0, last_login = NOW() WHERE id = ?");
                        $stmt->execute([$user['id']]);
                        
                        // Activity Log
                        $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) VALUES (?, 'login', 'Benutzer hat sich eingeloggt', ?, ?)");
                        $stmt->execute([$user['id'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'] ?? '']);
                        
                        // Redirect (nur interne Ziele)
                        $redirect = safeRedirectTarget($_GET['redirect'] ?? '/dashboard.php');
                        header('Location: ' . $redirect);
                        exit;
                    } else {
                        // Falsches Passwort
                        $stmt = $db->prepare("UPDATE users SET failed_login_attempts = failed_login_attempts + 1 WHERE id = ?");
                        $stmt->execute([$user['id']]);
                        $error = 'E-Mail oder Passwort ist falsch.';
                    }
                }
            } else {
                $error = 'E-Mail oder Passwort ist falsch.';
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $error = 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.';
        }
    } else {
        $error = 'Bitte füllen Sie alle Felder aus.';
    }
}

$page_title = 'Login';
$page_description = 'Login zum Kundenbereich von MDC Facility Management';
include 'includes/header.php';
?>

<section style="padding: var(--spacing-2xl) 0; min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div style="max-width: 500px; margin: 0 auto;">
            <div class="card" style="padding: var(--spacing-2xl);">
                <div style="text-align: center; margin-bottom: var(--spacing-xl);">
                    <img src="/uploads/images/MDC%20Facility%20Management%20Logo%20v2.png" alt="MDC Facility Management" style="max-height: 200px; height: auto; margin: 0 auto var(--spacing-md);" loading="lazy" decoding="async" width="900" height="408">
                    <h2>Willkommen zurück</h2>
                    <p style="color: var(--text-light);">Melden Sie sich in Ihrem Kundenbereich an</p>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="/login.php<?php echo isset($_GET['redirect']) ? '?redirect=' . urlencode(safeRedirectTarget($_GET['redirect'])) : ''; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo e(generateCSRFToken()); ?>">
                    <div class="form-group">
                        <label for="email">E-Mail-Adresse</label>
                        <input type="email" id="email" name="email" class="form-control" required autofocus
                               value="<?php echo isset($_POST['email']) ? e($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Passwort</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    
                    <div style="margin-bottom: var(--spacing-md);">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="remember" style="cursor: pointer;">
                            <span>Angemeldet bleiben</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        <i class="fas fa-sign-in-alt"></i>
                        Anmelden
                    </button>
                </form>
                
                <div style="margin-top: var(--spacing-lg); text-align: center; padding-top: var(--spacing-lg); border-top: 1px solid var(--border-color);">
                    <p style="color: var(--text-light); margin-bottom: 0.5rem;">
                        <a href="#">Passwort vergessen?</a>
                    </p>
                    <p style="color: var(--text-light); margin: 0;">
                        Noch kein Kunde? <a href="/kontakt.php">Jetzt Kontakt aufnehmen</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
