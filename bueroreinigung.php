<?php
require_once 'config/database.php';

$page_title = 'Büroreinigung München';
$page_description = 'Professionelle Büroreinigung in München - Saubere Arbeitsplätze für produktive Teams. ✓ Täglich, wöchentlich oder monatlich ✓ Flexible Zeiten ☎ Jetzt anfragen!';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=2069'); min-height: 500px;">
    <div class="container">
        <div class="hero-content">
            <h1>Büroreinigung München</h1>
            <p>Professionelle Büroreinigung für ein sauberes und produktives Arbeitsumfeld. 
            Flexibel, zuverlässig und diskret – genau nach Ihren Wünschen.</p>
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
                <h2>Saubere Büros, motivierte Mitarbeiter</h2>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Ein gepflegtes Büro ist mehr als nur sauber – es ist die Basis für produktives Arbeiten, 
                    motivierte Mitarbeiter und einen professionellen Auftritt gegenüber Kunden und Geschäftspartnern.
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8;">
                    Wir bieten maßgeschneiderte Büroreinigung für Unternehmen jeder Größe – vom Einzelbüro 
                    bis zur großen Büroetage. Unsere Reinigung erfolgt diskret außerhalb Ihrer Arbeitszeiten 
                    oder nach individueller Vereinbarung.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-lg) 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Flexible Reinigungszeiten (früh morgens, abends, am Wochenende)
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Individuell anpassbare Reinigungspläne
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Zuverlässiges und diskretes Personal
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                        Umweltfreundliche Reinigungsmittel
                    </li>
                </ul>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=2069" 
                     alt="Büroreinigung München" 
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- Leistungen -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Unsere Büroreinigung-Leistungen</h2>
        <div class="grid grid-3">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-desktop"></i>
                </div>
                <h3>Arbeitsplatzreinigung</h3>
                <p>Schreibtische, Tastaturen, Monitore, Telefone – alles gründlich gereinigt und desinfiziert.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-couch"></i>
                </div>
                <h3>Gemeinschaftsbereiche</h3>
                <p>Küchen, Pausenräume, Besprechungsräume und Empfangsbereiche immer einsatzbereit.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-restroom"></i>
                </div>
                <h3>Sanitärreinigung</h3>
                <p>Gründliche Reinigung und Desinfektion aller Sanitäranlagen mit hygienischen Standards.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-broom"></i>
                </div>
                <h3>Bodenreinigung</h3>
                <p>Teppiche saugen, Hartböden wischen – für saubere Böden in allen Räumen.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-window-restore"></i>
                </div>
                <h3>Fensterreinigung</h3>
                <p>Innen- und Außenreinigung für klare Sicht und freundliche Atmosphäre.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3>Müllentsorgung</h3>
                <p>Regelmäßige Leerung aller Papierkörbe und fachgerechte Entsorgung.</p>
            </div>
        </div>
    </div>
</section>

<!-- Reinigungsintervalle -->
<section>
    <div class="container">
        <h2 class="text-center">Flexible Reinigungsintervalle</h2>
        <p class="text-center" style="max-width: 700px; margin: 0 auto var(--spacing-xl);">
            Wir passen uns Ihren Bedürfnissen an – wählen Sie die Häufigkeit, die zu Ihrem Büro passt:
        </p>
        <div class="grid grid-3">
            <div class="card text-center">
                <i class="fas fa-calendar-day" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h3>Täglich</h3>
                <p>Ideal für größere Büros und stark frequentierte Bereiche</p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem; text-align: left;">
                    <li>✓ Arbeitsplatzreinigung</li>
                    <li>✓ Sanitäranlagen</li>
                    <li>✓ Gemeinschaftsbereiche</li>
                    <li>✓ Müllentsorgung</li>
                </ul>
            </div>
            
            <div class="card text-center">
                <i class="fas fa-calendar-week" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h3>Wöchentlich</h3>
                <p>Perfekt für kleinere Büros und Teams</p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem; text-align: left;">
                    <li>✓ Gründliche Reinigung</li>
                    <li>✓ Bodenreinigung</li>
                    <li>✓ Staubwischen</li>
                    <li>✓ Fensterreinigung</li>
                </ul>
            </div>
            
            <div class="card text-center">
                <i class="fas fa-calendar-alt" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h3>Monatlich</h3>
                <p>Grundreinigung und spezielle Aufgaben</p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem; text-align: left;">
                    <li>✓ Intensivreinigung</li>
                    <li>✓ Schwer zugängliche Bereiche</li>
                    <li>✓ Spezialreinigungen</li>
                    <li>✓ Nach Vereinbarung</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Vorteile -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Ihre Vorteile unserer Büroreinigung</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Flexible Zeiten</h4>
                <p>Reinigung außerhalb Ihrer Arbeitszeiten</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-user-shield" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Diskretion</h4>
                <p>Zuverlässiges und vertrauenswürdiges Personal</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-sparkles" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Top Qualität</h4>
                <p>Gründliche Reinigung nach höchsten Standards</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-euro-sign" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Fair & transparent</h4>
                <p>Klare Preise ohne versteckte Kosten</p>
            </div>
        </div>
    </div>
</section>

<!-- Kontaktformular -->
<section id="angebot">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;">
            <h2 class="text-center">Jetzt Angebot für Büroreinigung anfragen</h2>
            <p class="text-center" style="margin-bottom: var(--spacing-xl);">
                Schildern Sie uns Ihre Anforderungen – wir erstellen Ihnen ein individuelles und 
                unverbindliches Angebot.
            </p>
            
            <form id="contactForm" action="/kontakt.php#angebot" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <input type="hidden" name="service_type" value="Büroreinigung">
                
                <div class="form-group">
                    <label for="company_name">Firmenname *</label>
                    <input type="text" id="company_name" name="company_name" class="form-control" required>
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
                              placeholder="Bitte beschreiben Sie Ihr Büro (Größe, Anzahl Arbeitsplätze, gewünschte Reinigungsintervalle, etc.)..."></textarea>
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
        <h2 class="text-center">Häufige Fragen zur Büroreinigung</h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Zu welchen Zeiten findet die Reinigung statt?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ganz nach Ihren Wünschen – früh morgens vor Arbeitsbeginn, abends nach Feierabend oder 
                    am Wochenende. Wir richten uns nach Ihren Bürozeiten.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Was kostet eine Büroreinigung?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Die Kosten hängen von der Bürogröße, dem Reinigungsumfang und der Frequenz ab. 
                    Für ein typisches 100 m² Büro mit wöchentlicher Reinigung ca. 150-250 € pro Monat.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Müssen wir die Reinigungsmittel stellen?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Nein, wir bringen alle notwendigen Reinigungsmittel, Geräte und Materialien mit.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Sind die Reinigungskräfte versichert?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ja, alle unsere Mitarbeiter sind vollständig versichert (Haftpflicht und Unfallversicherung).</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Können wir den Reinigungsplan anpassen?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Selbstverständlich! Der Reinigungsplan ist flexibel und kann jederzeit an Ihre 
                    sich ändernden Bedürfnisse angepasst werden.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
