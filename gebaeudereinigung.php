<?php
require_once 'config/database.php';

$page_title = 'Gebäudereinigung München';
$page_description = 'Professionelle Gebäudereinigung in München - Zuverlässig, gründlich und termingerecht. ✓ Treppenhausreinigung ✓ Glasreinigung ✓ Winterdienst ☎ Jetzt anfragen!';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('/assets/images/content/gebaeudereinigung-muenchen.jpg'); min-height: 500px;">
    <div class="container">
        <div class="hero-content">
            <h1>Gebäudereinigung München</h1>
            <p>Professionelle und zuverlässige Reinigung für Wohn- und Geschäftsgebäude. 
            Wir sorgen für saubere, gepflegte Immobilien und zufriedene Mieter.</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="#angebot" class="btn btn-primary btn-lg">Jetzt Angebot anfragen</a>
                <a href="tel:+498938043537" class="btn btn-outline btn-lg">☎ +49 89 38043537</a>
            </div>
        </div>
    </div>
</section>

<!-- Einleitung -->
<section>
    <div class="container">
        <div class="grid grid-2">
            <div>
                <h2>Gebäudereinigung vom Profi</h2>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Ein gepflegtes Gebäude ist die Visitenkarte jeder Immobilie. Mit über 8 Jahren Erfahrung 
                    in der Gebäudereinigung sorgen wir für saubere Treppenhäuser, glänzende Eingangsbereiche 
                    und gepflegte Außenanlagen in ganz München.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-lg) 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Regelmäßige Treppenhausreinigung
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Professionelle Fenster- und Glasreinigung
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Zuverlässiger Winterdienst
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Müllplatz- und Außenreinigung
                    </li>
                </ul>
            </div>
            <div>
                <img src="/assets/images/content/unterhaltsreinigung-muenchen.jpg" 
                     alt="Gebäudereinigung München" 
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);" loading="lazy" decoding="async" width="1200" height="800">
            </div>
        </div>
    </div>
</section>

<!-- Leistungen -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Unsere Gebäudereinigung-Leistungen</h2>
        <div class="grid grid-3">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>Treppenhausreinigung</h3>
                <p>Regelmäßige Reinigung von Treppenhäusern, Fluren und Eingangsbereichen nach festem Reinigungsplan.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-window-maximize"></i>
                </div>
                <h3>Fensterreinigung</h3>
                <p>Streifenfreie Glas- und Rahmenreinigung für kristallklaren Durchblick – innen und außen.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-snowflake"></i>
                </div>
                <h3>Winterdienst</h3>
                <p>Schneeräumung und Streudienst für sichere Gehwege. Zuverlässig und termingerecht.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <h3>Gemeinschaftsräume</h3>
                <p>Reinigung von Waschküchen, Trockenräumen, Kellerfluren und anderen Gemeinschaftsflächen.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h3>Müllplatzreinigung</h3>
                <p>Regelmäßige Reinigung und Desinfektion der Müllplätze und Tonnenstellplätze.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-tree"></i>
                </div>
                <h3>Außenreinigung</h3>
                <p>Kehren von Gehwegen, Höfen und Parkplätzen. Laubbeseitigung und Grünflächenpflege.</p>
            </div>
        </div>
    </div>
</section>

<!-- Vorteile -->
<section>
    <div class="container">
        <h2 class="text-center">Ihre Vorteile</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <i class="fas fa-calendar-check" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Zuverlässig</h4>
                <p>Feste Reinigungszeiten und verlässliche Durchführung</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-euro-sign" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Fair kalkuliert</h4>
                <p>Transparente Preise ohne versteckte Kosten</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-users-cog" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Geschultes Personal</h4>
                <p>Professionelle und freundliche Mitarbeiter</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-leaf" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Umweltfreundlich</h4>
                <p>Einsatz ökologischer Reinigungsmittel</p>
            </div>
        </div>
    </div>
</section>

<!-- Ablauf -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">So einfach geht's</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: var(--primary-color); color: white; 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            font-size: 1.5rem; font-weight: bold; margin: 0 auto 1rem;">1</div>
                <h4>Anfrage</h4>
                <p>Senden Sie uns Ihre Anfrage per Telefon, E-Mail oder Kontaktformular</p>
            </div>
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: var(--primary-color); color: white; 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            font-size: 1.5rem; font-weight: bold; margin: 0 auto 1rem;">2</div>
                <h4>Vor-Ort-Termin</h4>
                <p>Wir besichtigen das Objekt und besprechen Ihre Anforderungen</p>
            </div>
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: var(--primary-color); color: white; 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            font-size: 1.5rem; font-weight: bold; margin: 0 auto 1rem;">3</div>
                <h4>Angebot</h4>
                <p>Sie erhalten ein detailliertes und transparentes Angebot</p>
            </div>
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: var(--primary-color); color: white; 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                            font-size: 1.5rem; font-weight: bold; margin: 0 auto 1rem;">4</div>
                <h4>Durchführung</h4>
                <p>Nach Auftragserteilung starten wir zeitnah mit der Reinigung</p>
            </div>
        </div>
    </div>
</section>

<!-- Kontaktformular -->
<section id="angebot">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;">
            <h2 class="text-center">Jetzt Angebot anfragen</h2>
            <p class="text-center" style="margin-bottom: var(--spacing-xl);">
                Nutzen Sie unser Kontaktformular für eine schnelle und unverbindliche Anfrage. 
                Wir melden uns so schnell wie möglich bei Ihnen.
            </p>
            
            <form id="contactForm" action="/kontakt.php#angebot" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <input type="hidden" name="service_type" value="Gebäudereinigung">
                
                <div class="form-group">
                    <label for="company_name">Firmenname / Hausverwaltung</label>
                    <input type="text" id="company_name" name="company_name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="contact_person">Ansprechpartner *</label>
                    <input type="text" id="contact_person" name="contact_person" class="form-control" required>
                </div>
                
                <div class="grid grid-2">
                    <div class="form-group">
                        <label for="email">E-Mail *</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message">Ihre Nachricht *</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required 
                              placeholder="Bitte beschreiben Sie Ihr Gebäude (Anzahl Etagen, Wohneinheiten, etc.) und Ihre Wünsche..."></textarea>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="privacy" name="privacy" required>
                    <label for="privacy">
                        Ich habe die <a href="/datenschutz.php" target="_blank">Datenschutzerklärung</a> gelesen und stimme zu. *
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: var(--spacing-md);">
                    <i class="fas fa-paper-plane"></i>
                    Anfrage absenden
                </button>
            </form>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Häufige Fragen zur Gebäudereinigung</h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Wie oft sollte ein Treppenhaus gereinigt werden?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Die Häufigkeit hängt von der Nutzung ab. Üblich ist eine wöchentliche Reinigung. 
                    Bei stark frequentierten Gebäuden empfehlen wir 2-3 mal pro Woche.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Was kostet eine Treppenhausreinigung?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Die Kosten richten sich nach Größe des Gebäudes, Anzahl der Etagen und Reinigungsfrequenz. 
                    Typischerweise liegt der Preis zwischen 15-30 € pro Reinigungsvorgang für ein Mehrfamilienhaus.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Sind Sie auch im Winter verfügbar?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ja, wir bieten ganzjährigen Service inklusive Winterdienst mit Schneeräumung und Streudienst 
                    für sichere Gehwege.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Verwenden Sie umweltfreundliche Reinigungsmittel?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ja, wir setzen bevorzugt biologisch abbaubare und umweltschonende Reinigungsmittel ein, 
                    die für Mensch und Umwelt unbedenklich sind.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Können Sie auch kurzfristig einspringen?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>In der Regel ja. Kontaktieren Sie uns telefonisch und wir finden eine Lösung für Ihren Bedarf.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
