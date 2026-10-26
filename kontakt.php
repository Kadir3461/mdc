<?php
require_once 'config/database.php';
require_once 'includes/mail.php';
require_once 'includes/spamschutz.php';
require_once 'includes/consent.php';

$page_title = 'Kontakt';
$page_description = 'Kontaktieren Sie MDC Facility Management für professionelle Reinigungslösungen in München. Kostenloses Angebot anfragen ☎ +49 89 38043537';

$success = false;
$error = false;
$csrfError = false;
$validationError = false;
$spamError = false;

$serviceOptions = [
    'Büroreinigung', 'Unterhaltsreinigung', 'Fensterreinigung', 'Shopreinigung',
    'Treppenhausreinigung', 'Bauendreinigung', 'Hausmeisterservice', 'Winterdienst',
    'Grünanlagenservice', 'Umzug & Entsorgung', 'Tiefgaragenreinigung', 'Fassadenreinigung',
    'Glasreinigung', 'Photovoltaikreinigung', 'Allgemeine Anfrage'
];
$rhythmOptions = ['Täglich', '2–3x pro Woche', '1x pro Woche', 'Nach Bedarf'];
$quickAreas = [50, 150, 300, 500, 1000, 2500, 5000];

// Vorauswahl über ?category=Büroreinigung (oder ?service=...)
$presetCategory = $_GET['category'] ?? $_GET['service'] ?? '';
$selService = in_array($_POST['service_type'] ?? $presetCategory, $serviceOptions, true)
    ? ($_POST['service_type'] ?? $presetCategory) : '';
$selArea = (int) ($_POST['area'] ?? 150);
$selRhythm = in_array($_POST['rhythm'] ?? '', $rhythmOptions, true) ? $_POST['rhythm'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedToken = $_POST['csrf_token'] ?? '';

    // Eingaben bereinigen und prüfen
    $companyName   = mb_substr(trim($_POST['company_name'] ?? ''), 0, 255);
    $contactPerson = mb_substr(trim($_POST['contact_person'] ?? ''), 0, 255);
    $emailRaw      = trim($_POST['email'] ?? '');
    $phone         = mb_substr(trim($_POST['phone'] ?? ''), 0, 50);
    $notes         = trim($_POST['message'] ?? '');
    $serviceType   = in_array($_POST['service_type'] ?? '', $serviceOptions, true) ? $_POST['service_type'] : 'Allgemeine Anfrage';
    $area          = filter_var($_POST['area'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 1000000]]);
    $rhythm        = in_array($_POST['rhythm'] ?? '', $rhythmOptions, true) ? $_POST['rhythm'] : '';
    $email         = filter_var($emailRaw, FILTER_VALIDATE_EMAIL);

    $formValid = $contactPerson !== '' && $email && !empty($_POST['privacy']);

    $messageText = '';
    if ($area || $rhythm) {
        $messageText .= "Konfiguration:\n";
        if ($area)   { $messageText .= "- Objektgröße: " . $area . " m²\n"; }
        if ($rhythm) { $messageText .= "- Gewünschter Rhythmus: " . $rhythm . "\n"; }
        $messageText .= "\n";
    }
    $messageText .= $notes !== '' ? $notes : '(keine zusätzlichen Hinweise)';

    $spamCheck = mdc_spam_check([
        'company_name'   => $companyName,
        'contact_person' => $contactPerson,
        'email'          => $emailRaw,
        'phone'          => $phone,
        'message'        => $notes,
    ]);

    if (!validateCSRFToken($submittedToken)) {
        $error = true;
        $csrfError = true;
    } elseif (!$formValid) {
        $error = true;
        $validationError = true;
    } elseif ($spamCheck['spam']) {
        error_log('Contact form: als Spam eingestuft (' . $spamCheck['reason'] . ') - IP ' . mdc_spam_client_ip());

        if ($spamCheck['silent']) {
            // Bots sollen keinen Unterschied erkennen
            $success = true;
        } else {
            $error = true;
            $spamError = true;
        }
    } else {
        $db = getDB();
        
        try {
            $stmt = $db->prepare("
                INSERT INTO contact_requests 
                (company_name, contact_person, email, phone, service_type, message, privacy_accepted, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?)
            ");
            
            $stmt->execute([
                $companyName,
                $contactPerson,
                $email,
                $phone,
                $serviceType,
                $messageText,
                $_SERVER['REMOTE_ADDR'],
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
            
            // E-Mail an das MDC-Team
            $mailData = [
                'company_name'   => $companyName,
                'contact_person' => $contactPerson,
                'email'          => $email,
                'phone'          => $phone,
                'service_type'   => $serviceType,
                'area'           => $area ?: 0,
                'rhythm'         => $rhythm,
                'notes'          => $notes,
            ];

            if (!mdc_send_team_notification($mailData)) {
                error_log('Contact form: Benachrichtigung an das Team fehlgeschlagen');
            }

            // Automatische Bestätigung ("Danke-Mail") an den Kunden
            if (!mdc_send_customer_confirmation($mailData)) {
                error_log('Contact form: Bestätigungsmail an den Kunden fehlgeschlagen');
            }
            
            $success = true;
            mdc_spam_reset_form();
        } catch (Exception $e) {
            $error = true;
            error_log("Contact form error: " . $e->getMessage());
        }
    }
}

mdc_spam_start_form();

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('/assets/images/content/kontakt-reinigungsfirma-muenchen.jpg'); min-height: 400px;">
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
                <h2>MDC Facility Management</h2>
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
                                    <a href="tel:+498938043537" style="font-size: 1.125rem;">+49 89 38043537</a><br>
                                    <span style="font-size: 1.125rem;">Fax: +49 89 38043538</span>
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
                        <?php elseif ($validationError): ?>
                            Bitte prüfen Sie Ihre Angaben: Ansprechpartner, eine gültige E-Mail-Adresse und die Zustimmung zur Datenschutzerklärung sind erforderlich.
                        <?php elseif ($spamError): ?>
                            Wir haben bereits mehrere Anfragen von Ihnen erhalten. Bitte warten Sie einen Moment oder rufen Sie uns direkt unter +49 89 38043537 an.
                        <?php else: ?>
                            Ihre Nachricht konnte nicht versendet werden. Bitte versuchen Sie es erneut oder kontaktieren Sie uns telefonisch.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!$success): ?>
                <form id="configForm" method="POST" action="/kontakt.php#angebot" novalidate data-start-step="<?php echo $error && !$csrfError ? '2' : '1'; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo e(generateCSRFToken()); ?>">
                    <?php echo mdc_spam_honeypot_html(); ?>
                    
                    <div class="cfg-progress">
                        <div class="cfg-progress-label">
                            <span id="cfgStepLabel">Schritt 1: Konfiguration</span>
                            <span id="cfgPercent">40%</span>
                        </div>
                        <div class="cfg-progress-bar"><div id="cfgProgressFill" style="width: 40%;"></div></div>
                    </div>
                    
                    <!-- Schritt 1: Konfiguration -->
                    <div class="cfg-step" id="cfgStep1">
                        <div class="form-group">
                            <span class="cfg-heading">1. Reinigungskategorie</span>
                            <div class="cfg-options" role="radiogroup" aria-label="Reinigungskategorie">
                                <?php foreach ($serviceOptions as $opt): ?>
                                    <label class="cfg-option">
                                        <input type="radio" name="service_type" value="<?php echo e($opt); ?>" <?php echo $selService === $opt ? 'checked' : ''; ?>>
                                        <span><?php echo e($opt); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="cfg-heading" for="area">2. Objektgröße (m²)</label>
                            <input type="number" id="area" name="area" class="form-control" min="1" max="1000000" step="1"
                                   value="<?php echo $selArea > 0 ? (int) $selArea : 150; ?>">
                            <input type="range" id="areaRange" class="cfg-range" min="10" max="5000" step="10" value="150" aria-label="Objektgröße Schieberegler">
                            <div class="cfg-quick">
                                <span>Schnellauswahl:</span>
                                <?php foreach ($quickAreas as $qa): ?>
                                    <button type="button" class="cfg-chip" data-area="<?php echo $qa; ?>"><?php echo $qa >= 1000 ? rtrim(rtrim(number_format($qa / 1000, 1, ',', ''), '0'), ',') . 'k' : $qa; ?> m²</button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="cfg-heading">3. Gewünschter Rhythmus</span>
                            <div class="cfg-options" role="radiogroup" aria-label="Gewünschter Rhythmus">
                                <?php foreach ($rhythmOptions as $opt): ?>
                                    <label class="cfg-option">
                                        <input type="radio" name="rhythm" value="<?php echo e($opt); ?>" <?php echo $selRhythm === $opt ? 'checked' : ''; ?>>
                                        <span><?php echo e($opt); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="alert alert-error" id="cfgStep1Error" hidden></div>
                        
                        <button type="button" id="cfgNext" class="btn btn-primary btn-lg" style="width: 100%;">
                            Weiter zu den Kontaktdaten <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    
                    <!-- Schritt 2: Kontaktdaten -->
                    <div class="cfg-step" id="cfgStep2" hidden>
                        <div class="cfg-summary" id="cfgSummary" aria-live="polite"></div>
                        
                        <div class="form-group">
                            <label for="company_name">Firmenname</label>
                            <input type="text" id="company_name" name="company_name" class="form-control" maxlength="255"
                                   value="<?php echo isset($_POST['company_name']) ? e($_POST['company_name']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_person">Ansprechpartner *</label>
                            <input type="text" id="contact_person" name="contact_person" class="form-control" maxlength="255" required
                                   value="<?php echo isset($_POST['contact_person']) ? e($_POST['contact_person']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-Mail-Adresse *</label>
                            <input type="email" id="email" name="email" class="form-control" required
                                   value="<?php echo isset($_POST['email']) ? e($_POST['email']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone" class="form-control" maxlength="50"
                                   value="<?php echo isset($_POST['phone']) ? e($_POST['phone']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Zusätzliche Hinweise (optional)</label>
                            <textarea id="message" name="message" class="form-control" rows="4"><?php echo isset($_POST['message']) ? e($_POST['message']) : ''; ?></textarea>
                        </div>
                        
                        <div class="checkbox-group">
                            <input type="checkbox" id="privacy" name="privacy" value="1" required>
                            <label for="privacy">
                                Ich habe die <a href="/datenschutz.php" target="_blank">Datenschutzerklärung</a>
                                zur Kenntnis genommen und stimme der Verarbeitung meiner Daten zu. *
                            </label>
                        </div>
                        
                        <div class="alert alert-error" id="cfgStep2Error" hidden></div>
                        
                        <div class="cfg-actions">
                            <button type="button" id="cfgBack" class="btn btn-outline">
                                <i class="fas fa-arrow-left"></i> Zurück
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i>
                                Anfrage absenden
                            </button>
                        </div>
                    </div>
                </form>
                <script src="/assets/js/konfigurator.js" defer></script>
                <?php endif; ?>
                    

                    

                    

                    

                    

                            
                            

                    

                    

                    

            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: var(--spacing-xl);">So finden Sie uns</h2>
        <div style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg);">
            <?php mdc_consent_map(450); ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
