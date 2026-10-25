<?php
require_once 'config/database.php';

$page_title = 'Industriereinigung München';
$page_description = 'Professionelle Industriereinigung in München ✓ Produktionshallen ✓ Werkstätten ✓ Maschinen ✓ Schnell, gründlich & sicher. Jetzt Angebot anfragen!';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?q=80&w=2070');">
    <div class="container">
        <div class="hero-content">
            <h1>Industriereinigung München</h1>
            <p>
                Professionelle Reinigung für Produktionsstätten, Werkshallen und Industrieanlagen. 
                Schnell, gründlich und sicher – damit Ihre Produktion reibungslos läuft.
            </p>
            <div class="hero-buttons">
                <a href="#kontakt" class="btn btn-primary btn-lg">
                    <i class="fas fa-file-invoice"></i>
                    Kostenloses Angebot anfragen
                </a>
                <a href="tel:+498938043537" class="btn btn-white btn-lg">
                    <i class="fas fa-phone"></i>
                    +49 89 38043537
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Introduction -->
<section>
    <div class="container">
        <div class="grid grid-2" style="align-items: center; gap: var(--spacing-2xl);">
            <div>
                <span class="section-subtitle">Industriereinigung München</span>
                <h2>Sauberkeit für Ihre Produktion</h2>
                <p>
                    In der Industrie sind Sauberkeit und Hygiene nicht nur eine Frage der Optik, sondern auch der 
                    Sicherheit, Produktivität und Qualität. MDC Facility Management bietet Ihnen professionelle 
                    Industriereinigung in München und Umgebung – maßgeschneidert auf die speziellen Anforderungen 
                    Ihres Betriebs.
                </p>
                <p>
                    Ob Produktionshallen, Werkstätten, Lagerhallen oder Maschinenparks – unser erfahrenes Team 
                    sorgt für eine gründliche und sichere Reinigung, die Ihre Arbeitsprozesse nicht beeinträchtigt. 
                    Wir arbeiten flexibel zu Ihren Produktionszeiten und garantieren höchste Qualitätsstandards.
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: 0.5rem 0; display: flex; gap: 0.75rem;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-top: 0.25rem;"></i>
                        <span>Über 10 Jahre Erfahrung in der Industriereinigung</span>
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; gap: 0.75rem;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-top: 0.25rem;"></i>
                        <span>Geschultes Personal für Industrieumgebungen</span>
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; gap: 0.75rem;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-top: 0.25rem;"></i>
                        <span>Modernste Reinigungstechnik und -mittel</span>
                    </li>
                    <li style="padding: 0.5rem 0; display: flex; gap: 0.75rem;">
                        <i class="fas fa-check-circle" style="color: var(--primary-color); margin-top: 0.25rem;"></i>
                        <span>Flexible Einsatzzeiten nach Ihren Bedürfnissen</span>
                    </li>
                </ul>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1565688534245-05d6b5be184a?q=80&w=2070" 
                     alt="Industriereinigung München" 
                     style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Unsere Leistungen</span>
            <h2 class="section-title">Industriereinigung auf höchstem Niveau</h2>
        </div>
        
        <div class="grid grid-3">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                <h3>Hallenreinigung</h3>
                <p>
                    Gründliche Reinigung von Produktionshallen, Lagerhallen und Werkstätten. 
                    Fußböden, Wände, Decken und alle Oberflächen werden professionell gereinigt.
                </p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <h3>Maschinenreinigung</h3>
                <p>
                    Fachgerechte Reinigung von Maschinen und Anlagen. Wir entfernen Öl, Fett, 
                    Späne und Produktionsrückstände sicher und schonend.
                </p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-broom"></i>
                </div>
                <h3>Unterhaltsreinigung</h3>
                <p>
                    Regelmäßige Reinigung Ihrer Industrieräume nach festem Zeitplan. 
                    Täglich, wöchentlich oder individuell nach Ihrem Bedarf.
                </p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3>Bauendreinigung</h3>
                <p>
                    Professionelle Endreinigung nach Umbau- oder Renovierungsarbeiten. 
                    Wir beseitigen Staub, Schmutz und Baustellenrückstände.
                </p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-spray-can"></i>
                </div>
                <h3>Spezialreinigung</h3>
                <p>
                    Reinigung von schwer zugänglichen Bereichen, Fassaden, Dächern und 
                    speziellen Oberflächen mit Spezialgeräten.
                </p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3>Entsorgungsservice</h3>
                <p>
                    Fachgerechte Entsorgung von Produktionsabfällen, Verpackungen und 
                    Reinigungsrückständen nach geltenden Vorschriften.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section>
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Ihre Vorteile</span>
            <h2 class="section-title">Warum MDC für Ihre Industriereinigung?</h2>
        </div>
        
        <div class="grid grid-2">
            <div class="card">
                <h4><i class="fas fa-shield-alt" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                    Sicherheit geht vor</h4>
                <p>
                    Unser Personal ist umfassend in Arbeitssicherheit geschult. Wir kennen die Anforderungen 
                    in Industrieumgebungen und arbeiten nach allen relevanten Sicherheitsvorschriften.
                </p>
            </div>
            
            <div class="card">
                <h4><i class="fas fa-clock" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                    Flexible Arbeitszeiten</h4>
                <p>
                    Wir passen uns Ihren Produktionszeiten an. Reinigung im laufenden Betrieb, in Schichtpausen 
                    oder außerhalb der Betriebszeiten – ganz nach Ihrem Wunsch.
                </p>
            </div>
            
            <div class="card">
                <h4><i class="fas fa-tools" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                    Modernste Technik</h4>
                <p>
                    Wir setzen auf professionelle Industriereinigungsgeräte: Hochdruckreiniger, 
                    Industriesauger, Kehrmaschinen und mehr für beste Ergebnisse.
                </p>
            </div>
            
            <div class="card">
                <h4><i class="fas fa-leaf" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                    Umweltfreundlich</h4>
                <p>
                    Wo immer möglich setzen wir auf ökologische Reinigungsmittel, die effektiv 
                    reinigen und gleichzeitig die Umwelt schonen.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Process -->
<section class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Unser Ablauf</span>
            <h2 class="section-title">So läuft Ihre Industriereinigung ab</h2>
        </div>
        
        <div class="grid grid-4">
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                           color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                           font-size: 1.5rem; font-weight: bold; margin: 0 auto var(--spacing-md);">1</div>
                <h4>Begehung vor Ort</h4>
                <p>Wir besichtigen Ihre Räumlichkeiten und analysieren die Anforderungen.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                           color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                           font-size: 1.5rem; font-weight: bold; margin: 0 auto var(--spacing-md);">2</div>
                <h4>Individuelles Angebot</h4>
                <p>Sie erhalten ein transparentes, maßgeschneidertes Angebot für Ihre Reinigung.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                           color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                           font-size: 1.5rem; font-weight: bold; margin: 0 auto var(--spacing-md);">3</div>
                <h4>Planung & Abstimmung</h4>
                <p>Wir planen den Reinigungsablauf und stimmen alle Details mit Ihnen ab.</p>
            </div>
            
            <div class="card text-center">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                           color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                           font-size: 1.5rem; font-weight: bold; margin: 0 auto var(--spacing-md);">4</div>
                <h4>Professionelle Umsetzung</h4>
                <p>Unser Team führt die Reinigung termingerecht und zuverlässig durch.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="kontakt">
    <div class="container">
        <div class="grid grid-2" style="gap: var(--spacing-2xl);">
            <div>
                <h2>Jetzt kostenloses Angebot anfragen</h2>
                <p>
                    Sie möchten mehr über unsere Industriereinigung erfahren? Kontaktieren Sie uns für 
                    ein unverbindliches Angebot. Wir beraten Sie gerne persönlich und finden die optimale 
                    Lösung für Ihren Betrieb.
                </p>
                <div style="margin-top: var(--spacing-lg);">
                    <div style="display: flex; gap: 1rem; margin-bottom: var(--spacing-md); align-items: center;">
                        <div style="width: 50px; height: 50px; background: var(--bg-light); border-radius: var(--radius-md); 
                                    display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
                            <i class="fas fa-phone fa-lg"></i>
                        </div>
                        <div>
                            <strong>Telefon</strong><br>
                            <a href="tel:+498938043537">+49 89 38043537</a>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-bottom: var(--spacing-md); align-items: center;">
                        <div style="width: 50px; height: 50px; background: var(--bg-light); border-radius: var(--radius-md); 
                                    display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                        <div>
                            <strong>E-Mail</strong><br>
                            <a href="mailto:Info@mdc-fm.de">Info@mdc-fm.de</a>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <div style="width: 50px; height: 50px; background: var(--bg-light); border-radius: var(--radius-md); 
                                    display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div>
                            <strong>Adresse</strong><br>
                            Rosa-Kempf-Str. 23<br>81248 München
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-section">
                <form id="contactForm" method="POST" action="/kontakt.php#angebot">
                    <input type="hidden" name="service_type" value="Industriereinigung">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <div class="form-group">
                        <label for="company_name">Firmenname *</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_person">Ansprechpartner *</label>
                        <input type="text" id="contact_person" name="contact_person" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-Mail-Adresse *</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Ihre Nachricht *</label>
                        <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
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

<!-- FAQ -->
<section class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Häufige Fragen</span>
            <h2 class="section-title">FAQ zur Industriereinigung</h2>
        </div>
        
        <div style="max-width: 900px; margin: 0 auto;">
            <div class="card faq-item" style="margin-bottom: var(--spacing-md); cursor: pointer;">
                <h4 class="faq-question">
                    <i class="fas fa-plus" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                    Welche Industriebereiche reinigen Sie?
                </h4>
                <div class="faq-answer" style="display: none; margin-top: var(--spacing-md); padding-top: var(--spacing-md); 
                                                border-top: 1px solid var(--border-color);">
                    <p>
                        Wir reinigen alle Arten von Industriebetrieben: Produktionshallen, Werkstätten, Lagerhallen, 
                        Maschinenbau, Metallverarbeitung, Lebensmittelindustrie, Logistikzentren und vieles mehr. 
                        Sprechen Sie uns an – wir finden die passende Lösung für Ihre Branche.
                    </p>
                </div>
            </div>
            
            <div class="card faq-item" style="margin-bottom: var(--spacing-md); cursor: pointer;">
                <h4 class="faq-question">
                    <i class="fas fa-plus" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                    Können Sie während der Produktionszeiten reinigen?
                </h4>
                <div class="faq-answer" style="display: none; margin-top: var(--spacing-md); padding-top: var(--spacing-md); 
                                                border-top: 1px solid var(--border-color);">
                    <p>
                        Ja, wir passen uns flexibel Ihren Produktionszeiten an. Die Reinigung kann während des laufenden 
                        Betriebs, in Schichtpausen oder außerhalb der Betriebszeiten erfolgen – ganz nach Ihren Anforderungen.
                    </p>
                </div>
            </div>
            
            <div class="card faq-item" style="margin-bottom: var(--spacing-md); cursor: pointer;">
                <h4 class="faq-question">
                    <i class="fas fa-plus" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                    Wie oft sollte eine Industriereinigung durchgeführt werden?
                </h4>
                <div class="faq-answer" style="display: none; margin-top: var(--spacing-md); padding-top: var(--spacing-md); 
                                                border-top: 1px solid var(--border-color);">
                    <p>
                        Die Häufigkeit hängt von Ihrer Branche, dem Verschmutzungsgrad und gesetzlichen Anforderungen ab. 
                        Wir empfehlen in der Regel eine wöchentliche Unterhaltsreinigung sowie regelmäßige Grundreinigungen. 
                        Gerne erstellen wir einen individuellen Reinigungsplan für Sie.
                    </p>
                </div>
            </div>
            
            <div class="card faq-item" style="margin-bottom: var(--spacing-md); cursor: pointer;">
                <h4 class="faq-question">
                    <i class="fas fa-plus" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                    Sind Ihre Mitarbeiter für Industrieumgebungen geschult?
                </h4>
                <div class="faq-answer" style="display: none; margin-top: var(--spacing-md); padding-top: var(--spacing-md); 
                                                border-top: 1px solid var(--border-color);">
                    <p>
                        Absolut. Unser Personal wird regelmäßig in Arbeitssicherheit, Umgang mit Industrieanlagen und 
                        speziellen Reinigungstechniken geschult. Wir arbeiten nach allen relevanten Sicherheitsvorschriften 
                        und tragen die notwendige Schutzausrüstung.
                    </p>
                </div>
            </div>
            
            <div class="card faq-item" style="cursor: pointer;">
                <h4 class="faq-question">
                    <i class="fas fa-plus" style="color: var(--primary-color); margin-right: 0.75rem;"></i>
                    Was kostet eine Industriereinigung?
                </h4>
                <div class="faq-answer" style="display: none; margin-top: var(--spacing-md); padding-top: var(--spacing-md); 
                                                border-top: 1px solid var(--border-color);">
                    <p>
                        Die Kosten variieren je nach Größe der Fläche, Art der Verschmutzung, Reinigungsfrequenz und 
                        speziellen Anforderungen. Wir erstellen Ihnen gerne ein individuelles, transparentes Angebot 
                        nach einer kostenlosen Begehung vor Ort.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', function() {
        const faqItem = this.closest('.faq-item');
        const answer = faqItem.querySelector('.faq-answer');
        const icon = this.querySelector('.fa-plus, .fa-minus');
        const isActive = answer.style.display === 'block';
        
        // Close all
        document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
        document.querySelectorAll('.faq-question .fas').forEach(i => {
            i.classList.remove('fa-minus');
            i.classList.add('fa-plus');
        });
        
        // Open clicked if wasn't active
        if (!isActive) {
            answer.style.display = 'block';
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>
