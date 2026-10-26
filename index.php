<?php
require_once 'config/database.php';
require_once 'includes/consent.php';

$page_title = 'Startseite';
$page_description = 'Professionelle Büroreinigung, Unterhaltsreinigung und Fensterreinigung in München. Zuverlässig, geprüft und flexibel ☎ +49 89 38043537 – jetzt kostenloses Angebot.';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('/assets/images/Fensterreinigung.jpg');">
    <div class="container">
        <div class="hero-content">
            <h1>Professionelle Reinigungslösungen für München</h1>
            <p>
                Wir bieten maßgeschneiderte Reinigungs- und Facility-Management-Lösungen für Unternehmen jeder Größe. 
                Vertrauen Sie auf über mehrere Jahre Erfahrung und höchste Qualitätsstandards.
            </p>
            <div class="hero-buttons">
                <a href="/kontakt.php#angebot" class="btn btn-primary btn-lg">
                    <i class="fas fa-file-invoice"></i>
                    Kostenloses Angebot anfragen
                </a>
                <a href="/kontakt.php" class="btn btn-white btn-lg">
                    <i class="fas fa-calendar-check"></i>
                    Vor-Ort-Termin vereinbaren
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Unsere Leistungen</span>
            <h2 class="section-title">Rundum-Service für Ihr Unternehmen</h2>
            <p class="section-description">
                Von der Büroreinigung bis zur Photovoltaikreinigung – 
                wir bieten Ihnen professionelle Lösungen aus einer Hand.
            </p>
        </div>
        
        <div class="grid grid-3">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>Büroreinigung</h3>
                <p>
                    Saubere Arbeitsplätze für produktive Teams. Flexible Reinigungszeiten 
                    außerhalb Ihrer Bürozeiten.
                </p>
                <a href="/bueroreinigung.php" class="btn btn-outline">Mehr erfahren →</a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-broom"></i>
                </div>
                <h3>Unterhaltsreinigung</h3>
                <p>
                    Regelmäßige Pflege und Wartung für dauerhaft gepflegte und hygienische Arbeitsumgebungen.
                </p>
                <a href="/leistungen.php#unterhaltsreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-window-maximize"></i>
                </div>
                <h3>Fensterreinigung</h3>
                <p>
                    Streifenfreie Sauberkeit für klare Durchsicht. Professionelle Reinigung für alle Gebäudetypen.
                </p>
                <a href="/leistungen.php#fensterreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3>Shopreinigung</h3>
                <p>
                    Einladende Verkaufsräume für Ihre Kunden. Diskrete Reinigung außerhalb der Öffnungszeiten.
                </p>
                <a href="/leistungen.php#shopreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-stairs"></i>
                </div>
                <h3>Treppenhausreinigung</h3>
                <p>
                    Saubere Treppenhäuser für einen gepflegten ersten Eindruck in Wohn- und Geschäftsgebäuden.
                </p>
                <a href="/leistungen.php#treppenhausreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3>Bauendreinigung</h3>
                <p>
                    Perfekter Abschluss nach Bau- und Renovierungsarbeiten. Entfernung von Bauschutt und Staub.
                </p>
                <a href="/leistungen.php#bauendreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Hausmeisterservice</h3>
                <p>
                    Verlässliche kleine Reparaturen, Wartungen und Pflegearbeiten für Wohn- und Geschäftsgebäude.
                </p>
                <a href="/leistungen.php#hausmeisterservice" class="btn btn-outline">Mehr erfahren →</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-snowflake"></i>
                </div>
                <h3>Winterdienst</h3>
                <p>
                    Sichern Sie Zugänge, Wege und Parkflächen mit professionellem Winterdienst und Streuung.
                </p>
                <a href="/leistungen.php#winterdienst" class="btn btn-outline">Mehr erfahren →</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Grünanlagenservice</h3>
                <p>
                    Pflege von Grünflächen, Rasen und Außenanlagen für ein gepflegtes Gesamtbild Ihres Objekts.
                </p>
                <a href="/leistungen.php#gruenanlagenservice" class="btn btn-outline">Mehr erfahren →</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <h3>Umzug &amp; Entsorgung</h3>
                <p>
                    Ordnungsgemäßer Rückbau, Transport und fachgerechte Entsorgung bei Renovierungen und Umzügen.
                </p>
                <a href="/leistungen.php#umzug-entsorgung" class="btn btn-outline">Mehr erfahren →</a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-square-parking"></i>
                </div>
                <h3>Tiefgaragenreinigung</h3>
                <p>
                    Intensive Reinigung von Tiefgaragenflächen, Fahrspuren und Technikbereichen für Sauberkeit und Sicherheit.
                </p>
                <a href="/leistungen.php#tiefgaragenreinigung" class="btn btn-outline">Mehr erfahren →</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Warum MDC Facility Management?</span>
            <h2 class="section-title">Ihre Vorteile auf einen Blick</h2>
        </div>
        
        <div class="grid grid-4">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h4>Über mehrere Jahre Erfahrung</h4>
                <p>Langjährige Expertise in der professionellen Reinigungsbranche</p>
            </div>
                
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>Geschultes Personal</h4>
                <p>Qualifizierte und motivierte Reinigungskräfte</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Umweltfreundlich</h4>
                <p>Einsatz ökologischer Reinigungsmittel</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h4>Flexibel & Zuverlässig</h4>
                <p>Anpassung an Ihre Arbeitszeiten und Bedürfnisse</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>Persönlicher Ansprechpartner</h4>
                <p>Direkte Kommunikation und schnelle Reaktionszeiten</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-euro-sign"></i>
                </div>
                <h4>Faire Preise</h4>
                <p>Transparente Kostenstruktur ohne versteckte Gebühren</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h4>24/7 Notdienst</h4>
                <p>Rund um die Uhr für Sie erreichbar im Notfall</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section>
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Unser Prozess</span>
            <h2 class="section-title">In 4 Schritten zu Ihrer Reinigungslösung</h2>
        </div>
        
        <div class="grid grid-4">
            <div class="card text-center">
                <div class="card-icon" style="margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-phone"></i>
                </div>
                <h4>1. Kontaktaufnahme</h4>
                <p>Sie kontaktieren uns telefonisch, per E-Mail oder über unser Kontaktformular.</p>
            </div>
            
            <div class="card text-center">
                <div class="card-icon" style="margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-search"></i>
                </div>
                <h4>2. Bedarfsanalyse</h4>
                <p>Wir analysieren Ihre Anforderungen und erstellen ein maßgeschneidertes Angebot.</p>
            </div>
            
            <div class="card text-center">
                <div class="card-icon" style="margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-file-signature"></i>
                </div>
                <h4>3. Vertragsabschluss</h4>
                <p>Nach Ihrer Freigabe kümmern wir uns um alle Details und Formalitäten.</p>
            </div>
            
            <div class="card text-center">
                <div class="card-icon" style="margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-broom"></i>
                </div>
                <h4>4. Start der Reinigung</h4>
                <p>Unser Team beginnt termingerecht mit der professionellen Reinigung.</p>
            </div>
        </div>
    </div>
</section>
<!--
<section class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Kundenstimmen</span>
            <h2 class="section-title">Das sagen unsere Kunden</h2>
        </div>
        
        <div class="grid grid-3">
            <div class="card">
                <div style="color: var(--accent-color); font-size: 1.5rem; margin-bottom: var(--spacing-sm);">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>
                    "MDC Facility Management überzeugt durch Zuverlässigkeit und höchste Qualität. 
                    Unser Bürogebäude erstrahlt täglich in neuem Glanz. Absolute Empfehlung!"
                </p>
                <strong>— Michael Weber, Geschäftsführer TechPro GmbH</strong>
            </div>
            
            <div class="card">
                <div style="color: var(--accent-color); font-size: 1.5rem; margin-bottom: var(--spacing-sm);">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>
                    "Seit Jahren vertrauen wir auf die professionelle Industriereinigung von MDC. 
                    Pünktlich, gründlich und immer freundlich. Danke für die tolle Zusammenarbeit!"
                </p>
                <strong>— Sabine Müller, Facility Managerin MetallBau AG</strong>
            </div>
            
            <div class="card">
                <div style="color: var(--accent-color); font-size: 1.5rem; margin-bottom: var(--spacing-sm);">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>
                    "Flexibel, kompetent und preiswert – MDC erfüllt alle unsere Anforderungen. 
                    Der persönliche Ansprechpartner ist Gold wert. Wir sind sehr zufrieden!"
                </p>
                <strong>— Thomas Klein, Immobilienverwaltung Klein & Partner</strong>
            </div>
        </div>
    </div>
</section>
-->
<!-- CTA Section -->
<section style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); color: white; text-align: center;">
    <div class="container">
        <h2 style="color: white; margin-bottom: var(--spacing-md);">
            Bereit für professionelle Reinigung?
        </h2>
        <p style="font-size: 1.25rem; margin-bottom: var(--spacing-xl); max-width: 700px; margin-left: auto; margin-right: auto;">
            Fordern Sie jetzt Ihr kostenloses und unverbindliches Angebot an. 
            Wir beraten Sie gerne persönlich und finden die perfekte Lösung für Ihr Unternehmen.
        </p>
        <div style="display: flex; gap: var(--spacing-md); justify-content: center; flex-wrap: wrap;">
            <a href="/kontakt.php" class="btn btn-white btn-lg">
                <i class="fas fa-envelope"></i>
                Jetzt Kontakt aufnehmen
            </a>
            <a href="tel:+498938043537" class="btn btn-outline btn-lg" style="border-color: white; color: white;">
                <i class="fas fa-phone"></i>
                +49 89 38043537
            </a>
        </div>
    </div>
</section>

<!-- Service Areas -->
<section>
    <div class="container">
        <div class="section-header">
            <!--<span class="section-subtitle">Einsatzgebiete</span>-->
            <h2 class="section-title">Wir sind in ganz München und Umgebung für Sie da</h2>
            <p class="section-description">
                Von der Innenstadt bis zu den Außenbezirken – MDC Facility Management ist Ihr zuverlässiger Partner 
                für professionelle Reinigungsdienstleistungen in München und dem Münchner Umland.
            </p>
        </div>
        
        <div style="background-color: var(--bg-light); padding: var(--spacing-xl); border-radius: var(--radius-lg); text-align: center;">
            <?php mdc_consent_map(400, 'border-radius: var(--radius-md); overflow: hidden;'); ?>
            <p style="margin-top: var(--spacing-md); color: var(--text-light);">
                <i class="fas fa-map-marker-alt" style="color: var(--primary-color);"></i>
                <strong>MDC Facility Management</strong> | Rosa-Kempf-Str. 23, 81248 München
            </p>
        </div>
    </div>
</section>

<section class="home-badge-section">
    <div class="container">
        <div class="home-badge-grid">
            <div class="home-badge-card home-badge-card--secondary">
                <div class="home-badge-icon home-badge-icon--image" aria-label="Handwerkskammer Bayern Logo">
                    <img src="/uploads/images/Handwerkskammer Logo München und Oberbayern.png" alt="Handwerkskammer Bayern Logo" class="home-badge-image" loading="lazy" decoding="async" width="900" height="300">
                </div>

                <div class="home-badge-content">
                    <p>
                        Qualitätsbewusstes Handwerk mit<br>
                        Verlässlichkeit, Kompetenz und<br>
                        professioneller Betreuung für Ihre<br>
                        Anforderungen im Gebäudemanagement<br>
                        und Facility-Service.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
