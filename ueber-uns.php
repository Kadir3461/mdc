<?php
require_once 'config/database.php';

$page_title = 'Über uns - MDC Facility & Cleaning';
$page_description = 'Lernen Sie MDC Facility & Cleaning kennen - Ihr professioneller Partner für Gebäudereinigung und Facility Management in München seit über 15 Jahren.';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('https://images.unsplash.com/photo-1560179707-f14e90ef3623?q=80&w=2073'); min-height: 400px;">
    <div class="container">
        <div class="hero-content">
            <h1>Über uns</h1>
            <p>Ihr zuverlässiger Partner für professionelle Reinigungsdienstleistungen in München und Umgebung seit über 15 Jahren.</p>
        </div>
    </div>
</section>

<!-- Unsere Geschichte -->
<section>
    <div class="container">
        <div class="grid grid-2" style="gap: var(--spacing-2xl);">
            <div>
                <h2>MDC Facility & Cleaning</h2>
                <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">Sauberkeit ist Vertrauenssache</h3>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Seit über 15 Jahren steht MDC Facility & Cleaning für professionelle Reinigungsdienstleistungen 
                    im Raum München. Was als kleines Familienunternehmen begann, ist heute ein etablierter Partner 
                    für Industrie, Gewerbe und Immobilienverwaltungen.
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Unser Erfolg basiert auf Zuverlässigkeit, Qualität und persönlichem Service. Wir kennen unsere 
                    Kunden und ihre individuellen Anforderungen. Diese Nähe und das Vertrauen unserer Kunden sind 
                    die Grundlage unserer täglichen Arbeit.
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Heute beschäftigen wir über 50 Mitarbeiter und betreuen mehr als 200 Kunden in München und 
                    Umgebung – vom kleinen Büro bis zur großen Industriehalle.
                </p>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=2074" 
                     alt="MDC Facility & Cleaning Team" 
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- Unsere Werte -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Unsere Werte</h2>
        <p class="text-center" style="max-width: 700px; margin: 0 auto var(--spacing-xl);">
            Diese Grundsätze leiten uns bei allem, was wir tun:
        </p>
        <div class="grid grid-3">
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-award" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Qualität</h3>
                <p>Höchste Standards bei jedem Auftrag – das ist unser Anspruch und Ihr Nutzen.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-handshake" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Zuverlässigkeit</h3>
                <p>Pünktlich, verlässlich, verbindlich – darauf können Sie sich verlassen.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-leaf" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Nachhaltigkeit</h3>
                <p>Umweltschonende Reinigungsmittel und ressourcenschonende Arbeitsweise.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-users" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Teamgeist</h3>
                <p>Motivierte und geschulte Mitarbeiter sind die Basis unseres Erfolgs.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-comments" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Kommunikation</h3>
                <p>Offener Dialog, transparente Abläufe und schnelle Reaktionszeiten.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            margin: 0 auto var(--spacing-md);">
                    <i class="fas fa-shield-alt" style="font-size: 2rem; color: white;"></i>
                </div>
                <h3>Sicherheit</h3>
                <p>Vollversichert, zertifiziert und nach allen Vorschriften arbeitend.</p>
            </div>
        </div>
    </div>
</section>

<!-- Zahlen & Fakten -->
<section>
    <div class="container">
        <h2 class="text-center">MDC in Zahlen</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <div style="font-size: 3rem; font-weight: bold; color: var(--primary-color); margin-bottom: 0.5rem;">
                    15+
                </div>
                <h4>Jahre Erfahrung</h4>
                <p>Seit 2009 im Reinigungsgeschäft tätig</p>
            </div>
            
            <div class="card text-center">
                <div style="font-size: 3rem; font-weight: bold; color: var(--primary-color); margin-bottom: 0.5rem;">
                    50+
                </div>
                <h4>Mitarbeiter</h4>
                <p>Professionelles und geschultes Team</p>
            </div>
            
            <div class="card text-center">
                <div style="font-size: 3rem; font-weight: bold; color: var(--primary-color); margin-bottom: 0.5rem;">
                    200+
                </div>
                <h4>Zufriedene Kunden</h4>
                <p>Vertrauen in unsere Dienstleistungen</p>
            </div>
            
            <div class="card text-center">
                <div style="font-size: 3rem; font-weight: bold; color: var(--primary-color); margin-bottom: 0.5rem;">
                    24/7
                </div>
                <h4>Notdienst</h4>
                <p>Erreichbar, wenn Sie uns brauchen</p>
            </div>
        </div>
    </div>
</section>

<!-- Zertifizierungen -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Qualität & Zertifizierungen</h2>
        <p class="text-center" style="max-width: 700px; margin: 0 auto var(--spacing-xl);">
            Unsere Qualitätsstandards werden regelmäßig überprüft und zertifiziert:
        </p>
        <div class="grid grid-3">
            <div class="card text-center">
                <i class="fas fa-certificate" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>ISO 9001 Zertifizierung</h4>
                <p>Qualitätsmanagement nach internationalen Standards</p>
            </div>
            
            <div class="card text-center">
                <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Vollversichert</h4>
                <p>Betriebs- und Berufshaftpflichtversicherung</p>
            </div>
            
            <div class="card text-center">
                <i class="fas fa-user-graduate" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Geschultes Personal</h4>
                <p>Regelmäßige Fort- und Weiterbildungen</p>
            </div>
        </div>
    </div>
</section>

<!-- Team (Platzhalter) -->
<section>
    <div class="container">
        <h2 class="text-center">Unser Team</h2>
        <p class="text-center" style="max-width: 700px; margin: 0 auto var(--spacing-xl);">
            Ein motiviertes Team ist die Grundlage für exzellente Ergebnisse. Unsere Mitarbeiter sind 
            bestens geschult, erfahren und mit Herzblut bei der Sache.
        </p>
        <div class="grid grid-3">
            <div class="card text-center">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-tie" style="font-size: 3rem; color: white;"></i>
                </div>
                <h3>Geschäftsführung</h3>
                <h4 style="color: var(--text-light); font-weight: normal;">Leitung & Strategie</h4>
                <p>Verantwortlich für die Gesamtausrichtung und Kundenbetreuung</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-tasks" style="font-size: 3rem; color: white;"></i>
                </div>
                <h3>Objektleitung</h3>
                <h4 style="color: var(--text-light); font-weight: normal;">Koordination & Qualität</h4>
                <p>Einsatzplanung, Qualitätskontrolle und Kundenkontakt vor Ort</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                            border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users-cog" style="font-size: 3rem; color: white;"></i>
                </div>
                <h3>Reinigungsteam</h3>
                <h4 style="color: var(--text-light); font-weight: normal;">Über 50 Mitarbeiter</h4>
                <p>Geschulte Fachkräfte für alle Reinigungsarbeiten</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-light">
    <div class="container text-center">
        <h2>Werden Sie Teil unserer Erfolgsgeschichte</h2>
        <p style="font-size: 1.125rem; max-width: 600px; margin: 0 auto var(--spacing-lg);">
            Überzeugen Sie sich selbst von unserem Service. Wir freuen uns auf Ihre Anfrage!
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/kontakt.php" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope"></i>
                Jetzt Kontakt aufnehmen
            </a>
            <a href="tel:+4989XXXXXXXX" class="btn btn-outline btn-lg">
                <i class="fas fa-phone"></i>
                +49 89 XXX XXXX
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
