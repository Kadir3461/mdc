<?php
require_once 'config/database.php';

$page_title = 'Kontakt';
$page_description = 'Kontaktieren Sie MDC Facility & Cleaning für professionelle Reinigungslösungen in München. Kostenloses Angebot anfragen ☎ +49 1516 7664588';

$success = false;
$error = false;
$csrfError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedToken = $_POST['csrf_token'] ?? '';

    if (validateCSRFToken($submittedToken)) {
        $db = getDB();
        
        try {
            $stmt = $db->prepare("
                INSERT INTO contact_requests 
                (company_name, contact_person, email, phone, service_type, message, privacy_accepted, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?)
            ");
            
            $stmt->execute([
                $_POST['company_name'] ?? '',
                $_POST['contact_person'],
                $_POST['email'],
                $_POST['phone'] ?? '',
                $_POST['service_type'] ?? 'Allgemeine Anfrage',
                $_POST['message'],
                $_SERVER['REMOTE_ADDR'],
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
            
            // E-Mail senden
            $to = CONTACT_EMAIL;
            $subject = 'Neue Kontaktanfrage von ' . preg_replace('/[\r\n]+/', ' ', ($_POST['company_name'] ?: $_POST['contact_person']));
            $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
            $replyTo = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $message = "Neue Kontaktanfrage über die Website:\n\n";
            $message .= "Firma: " . ($_POST['company_name'] ?? '-') . "\n";
            $message .= "Ansprechpartner: " . $_POST['contact_person'] . "\n";
            $message .= "E-Mail: " . $_POST['email'] . "\n";
            $message .= "Telefon: " . ($_POST['phone'] ?? '-') . "\n";
            $message .= "Gewünschte Leistung: " . ($_POST['service_type'] ?? '-') . "\n\n";
            $message .= "Nachricht:\n" . $_POST['message'] . "\n";
            
            $headers = "From: " . MAIL_FROM . "\r\n";
            if ($replyTo) {
                $headers .= "Reply-To: " . $replyTo . "\r\n";
            }
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            if (!mail($to, $subject, $message, $headers)) {
                error_log('Contact form: mail() fehlgeschlagen');
            }
            
            // Automatische Bestätigung an den Kunden
            if ($replyTo) {
                $confirmSubject = '=?UTF-8?B?' . base64_encode('Ihre Anfrage bei MDC Facility & Cleaning') . '?=';
                $confirmMessage = "Sehr geehrte Damen und Herren,\n\n";
                $confirmMessage .= "vielen Dank für Ihre Anfrage und Ihr Interesse an unseren Dienstleistungen.\n\n";
                $confirmMessage .= "Wir haben Ihre Nachricht erhalten und werden Ihr Anliegen schnellstmöglich prüfen.\n\n";
                $confirmMessage .= "Wir melden uns in Kürze bei Ihnen zurück.\n\n";
                $confirmMessage .= "Mit freundlichen Grüßen\n";
                $confirmMessage .= "Ihr Team von MDC Facility & Cleaning\n";
                
                $confirmHeaders = "From: =?UTF-8?B?" . base64_encode('MDC Facility & Cleaning') . "?= <" . MAIL_FROM . ">\r\n";
                $confirmHeaders .= "Reply-To: " . CONTACT_EMAIL . "\r\n";
                $confirmHeaders .= "MIME-Version: 1.0\r\n";
                $confirmHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
                
                if (!mail($replyTo, $confirmSubject, $confirmMessage, $confirmHeaders)) {
                    error_log('Contact form: Bestätigungsmail fehlgeschlagen');
                }
            }
            
            $success = true;
        } catch (Exception $e) {
            $error = true;
            error_log("Contact form error: " . $e->getMessage());
        }
    } else {
        $error = true;
        $csrfError = true;
    }
}

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070'); min-height: 400px;">
    <div class="container">
        <div class="hero-content">
            <h1>Kontakt</h1>
            <p>Nehmen Sie Kontakt zu uns auf – wir beraten Sie gerne persönlich und erstellen Ihnen ein maßgeschneidertes Angebot.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section>
    <div class="container">
        <div class="grid grid-2" style="gap: var(--spacing-2xl);">
            <!-- Contact Information -->
            <div>
                <h2>MDC Facility & Cleaning</h2>
                <p style="font-size: 1.125rem; color: var(--text-light); margin-bottom: var(--spacing-xl);">
                    Ihr Partner für professionelle Reinigungsdienstleistungen in München und Umgebung. 
                    Wir freuen uns auf Ihre Anfrage!
                </p>
                
                <div style="margin-bottom: var(--spacing-2xl);">
                    <div class="card" style="margin-bottom: var(--spacing-md);">
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                                        border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; 
                                        color: white; font-size: 1.5rem;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.25rem;">Adresse</h4>
                                <p style="margin: 0; color: var(--text-light);">
                                    Rosa-Kempf-Str. 23<br>
                                    81248 München
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card" style="margin-bottom: var(--spacing-md);">
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                                        border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; 
                                        color: white; font-size: 1.5rem;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.25rem;">Telefon</h4>
                                <p style="margin: 0;">
                                    <a href="tel:+4989XXXXXXXX" style="font-size: 1.125rem;">+49 1516 7664588</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card" style="margin-bottom: var(--spacing-md);">
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                                        border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; 
                                        color: white; font-size: 1.5rem;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.25rem;">E-Mail</h4>
                                <p style="margin: 0;">
                                    <a href="mailto:Info@mdc-fm.de" style="font-size: 1.125rem;">Info@mdc-fm.de</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                                        border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; 
                                        color: white; font-size: 1.5rem;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.25rem;">Öffnungszeiten</h4>
                                <p style="margin: 0; color: var(--text-light);">
                                    Mo - Fr: 08:00 - 18:00 Uhr<br>
                                    Sa: Nach Vereinbarung<br>
                                    <strong style="color: var(--accent-color);">24/7 Notdienst</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-section" id="angebot">
                <h3 style="margin-bottom: var(--spacing-md);">Jetzt Angebot anfragen</h3>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <strong>Vielen Dank!</strong> Ihre Nachricht wurde erfolgreich versendet. 
                        Wir melden uns schnellstmöglich bei Ihnen.
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Fehler!</strong>
                        <?php if ($csrfError): ?>
                            Ihre Sitzung ist abgelaufen. Bitte aktualisieren Sie die Seite und senden Sie das Formular erneut.
                        <?php else: ?>
                            Ihre Nachricht konnte nicht versendet werden. Bitte versuchen Sie es erneut oder kontaktieren Sie uns telefonisch.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <form id="contactForm" method="POST" action="/kontakt.php#angebot">
                    <input type="hidden" name="csrf_token" value="<?php echo e(generateCSRFToken()); ?>">
                    
                    <div class="form-group">
                        <label for="company_name">Firmenname</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" 
                               value="<?php echo isset($_POST['company_name']) ? e($_POST['company_name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_person">Ansprechpartner *</label>
                        <input type="text" id="contact_person" name="contact_person" class="form-control" required
                               value="<?php echo isset($_POST['contact_person']) ? e($_POST['contact_person']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-Mail-Adresse *</label>
                        <input type="email" id="email" name="email" class="form-control" required
                               value="<?php echo isset($_POST['email']) ? e($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                               value="<?php echo isset($_POST['phone']) ? e($_POST['phone']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="service_type">Gewünschte Leistung *</label>
                        <select id="service_type" name="service_type" class="form-control" required>
                            <option value="">Bitte wählen...</option>
                            
                            
                            <option value="Büroreinigung">Büroreinigung</option>
                            <option value="Unterhaltsreinigung">Unterhaltsreinigung</option>
                            <option value="Fensterreinigung">Fensterreinigung</option>
                            <option value="Shopreinigung">Shopreinigung</option>
                            <option value="Treppenhausreinigung">Treppenhausreinigung</option>
                            <option value="Bauendreinigung">Bauendreinigung</option>
                            <option value="Hausmeisterservice">Hausmeisterservice</option>
                            <option value="Winterdienst">Winterdienst</option>
                            <option value="Grünanlagenservice">Grünanlagenservice</option>
                            <option value="Umzug & Entsorgung">Umzug &amp; Entsorgung</option>
                            <option value="Tiefgaragenreinigung">Tiefgaragenreinigung</option>
                            <option value="Fassadenreinigung">Fassadenreinigung</option>
                            <option value="Glasreinigung">Glasreinigung</option>
                            <option value="Photovoltaikreinigung">Photovoltaikreinigung</option>
                            <option value="Allgemeine Anfrage">Allgemeine Anfrage</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Ihre Nachricht *</label>
                        <textarea id="message" name="message" class="form-control" rows="5" required><?php echo isset($_POST['message']) ? e($_POST['message']) : ''; ?></textarea>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="privacy" name="privacy" required>
                        <label for="privacy">
                            Ich habe die <a href="/datenschutz.php" target="_blank">Datenschutzerklärung</a> 
                            zur Kenntnis genommen und stimme der Verarbeitung meiner Daten zu. *
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: var(--spacing-md);">
                        <i class="fas fa-paper-plane"></i>
                        Anfrage absenden
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: var(--spacing-xl);">So finden Sie uns</h2>
        <div style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg);">
            <iframe 
                src="https://maps.google.com/maps?q=Rosa-Kempf-Str.+23,+81248+München&t=&z=15&ie=UTF8&iwloc=&output=embed"
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
