<?php
require_once 'config/database.php';

$page_title = 'Unsere Leistungen';
$page_description = 'Alle Reinigungsleistungen in München auf einen Blick: Büro-, Unterhalts-, Fenster-, Treppenhaus- und Fassadenreinigung ☎ Jetzt Angebot anfragen!';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('/assets/images/content/reinigungsdienstleistungen-muenchen.jpg'); min-height: 500px;">
    <div class="container">
        <div class="hero-content">
            <h1>Unsere Leistungen</h1>
            <p>Von der Büroreinigung bis zur Photovoltaikreinigung – wir bieten maßgeschneiderte 
            Reinigungslösungen für jeden Bedarf. Professionell, zuverlässig und termingerecht.</p>
            <a href="/kontakt.php" class="btn btn-primary btn-lg">Jetzt Angebot anfragen</a>
        </div>
    </div>
</section>

<!-- Leistungsübersicht -->
<section>
    <div class="container">
        <h2 class="text-center">Unser Leistungsspektrum</h2>
        <p class="text-center" style="max-width: 800px; margin: 0 auto var(--spacing-2xl);">
            Seit über mehreren Jahren sind wir Ihr kompetenter Partner für alle Reinigungsdienstleistungen 
            im Raum München. Ob Industrie, Gewerbe oder Wohnimmobilien – wir bieten individuelle Lösungen 
            für jeden Bereich.
        </p>
        
        <div class="grid grid-3" style="gap: var(--spacing-2xl);">
            <!-- Büroreinigung -->
            <div id="bueroreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/B%C3%BCroreinigung.jpg" 
                         alt="Büroreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-briefcase"></i> Büroreinigung
                        </span>
                    </div>
                </div>
                <h3>Büroreinigung</h3>
                <p style="flex-grow: 1;">
                    Saubere Arbeitsplätze für produktive Teams. Flexible Reinigungszeiten 
                    außerhalb Ihrer Bürozeiten.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Arbeitsplatzreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Gemeinschaftsräume</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Sanitärreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Flexible Zeiten</li>
                </ul>
                <a href="/bueroreinigung.php" class="btn btn-outline">Mehr erfahren <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Unterhaltsreinigung -->
            <div id="unterhaltsreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/assets/images/content/unterhaltsreinigung-muenchen.jpg" 
                         alt="Unterhaltsreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-broom"></i> Unterhaltsreinigung
                        </span>
                    </div>
                </div>
                <h3>Unterhaltsreinigung</h3>
                <p style="flex-grow: 1;">
                    Regelmäßige Pflege und Wartung Ihrer Räumlichkeiten. 
                    Für dauerhaft gepflegte und hygienische Arbeitsumgebungen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Regelmäßige Reinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Bodenreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Staubentfernung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Müllentsorgung</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Fensterreinigung -->
            <div id="fensterreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/assets/images/Fensterreinigung.jpg" 
                         alt="Fensterreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="967">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-window-maximize"></i> Fensterreinigung
                        </span>
                    </div>
                </div>
                <h3>Fensterreinigung</h3>
                <p style="flex-grow: 1;">
                    Streifenfreie Sauberkeit für klare Durchsicht. 
                    Professionelle Fensterreinigung für alle Gebäudetypen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Innen- und Außenreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Rahmenreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Schwer erreichbare Fenster</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Streifenfrei garantiert</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Shopreinigung -->
            <div id="shopreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Shoppreinigung.jpg" 
                         alt="Shopreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-store"></i> Shopreinigung
                        </span>
                    </div>
                </div>
                <h3>Shopreinigung</h3>
                <p style="flex-grow: 1;">
                    Einladende Verkaufsräume für Ihre Kunden. 
                    Diskrete Reinigung außerhalb Ihrer Öffnungszeiten.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Verkaufsflächen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Umkleidekabinen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Schaufenster</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Kundentoiletten</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Treppenhausreinigung -->
            <div id="treppenhausreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Treppenhausreinigung.jpg" 
                         alt="Treppenhausreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-stairs"></i> Treppenhausreinigung
                        </span>
                    </div>
                </div>
                <h3>Treppenhausreinigung</h3>
                <p style="flex-grow: 1;">
                    Saubere Treppenhäuser für einen gepflegten ersten Eindruck. 
                    Zuverlässige Reinigung für Wohn- und Geschäftsgebäude.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Treppenstufen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Geländer & Handläufe</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Eingangsbereiche</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Kellerabgänge</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Hausmeisterservice -->
            <div id="hausmeisterservice" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Hausmeisterservice.jpg" 
                         alt="Hausmeisterservice" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-tools"></i> Hausmeisterservice
                        </span>
                    </div>
                </div>
                <h3>Hausmeisterservice</h3>
                <p style="flex-grow: 1;">
                    Verlässliche Wartung, kleine Reparaturen und laufende Pflege für Wohn- und Geschäftsobjekte.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Wartung & Reparatur</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Gebäudepflege</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Verfügbare Ansprechpartner</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Flexible Hilfe bei Bedarf</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Winterdienst -->
            <div id="winterdienst" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Winterdienst.jpg" 
                         alt="Winterdienst" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-snowflake"></i> Winterdienst
                        </span>
                    </div>
                </div>
                <h3>Winterdienst</h3>
                <p style="flex-grow: 1;">
                    Sicherheit und Ordnung im Winter durch rechtzeitige Streuung, Räumung und Verkehrssicherung.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Räumung von Wegen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Streuen und Enteisen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Parkplätze und Zugänge</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>24/7 Bereitschaft</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Grünanlagenservice -->
            <div id="gruenanlagenservice" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Gr%C3%BCnanlagenservice.jpg" 
                         alt="Grünanlagenservice" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-leaf"></i> Grünanlagenservice
                        </span>
                    </div>
                </div>
                <h3>Grünanlagenservice</h3>
                <p style="flex-grow: 1;">
                    Pflegen Sie Außenbereiche, Rasen und Beete mit professioneller Garten- und Grünflächenbetreuung.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Rasenpflege</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Beetpflege</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Baumpflege</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Außenanlagen</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Umzug & Entsorgung -->
            <div id="umzug-entsorgung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Umzug%20%26%20Entsorgung.jpg" 
                         alt="Umzug & Entsorgung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-truck-moving"></i> Umzug &amp; Entsorgung
                        </span>
                    </div>
                </div>
                <h3>Umzug &amp; Entsorgung</h3>
                <p style="flex-grow: 1;">
                    Effizienter Abbau, Transport und fachgerechte Entsorgung bei Umbauten, Umzügen und Renovierungen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Umzugslogistik</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Rückbau</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Entsorgung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Reinigungsservice</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Tiefgaragenreinigung -->
            <div id="tiefgaragenreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Tiefgaragenreinigung.jpg" 
                         alt="Tiefgaragenreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-square-parking"></i> Tiefgaragenreinigung
                        </span>
                    </div>
                </div>
                <h3>Tiefgaragenreinigung</h3>
                <p style="flex-grow: 1;">
                    Saubere und sichere Tiefgaragen mit fachgerechter Reinigung von Fahrbahnen, Wänden und Technikräumen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Fahrbahnen & Rampen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Wand- & Deckenreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Stark verschmutzte Bereiche</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Technikräume</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- Bauendreinigung -->
            <div id="bauendreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Bauendreinigung.jpg" 
                         alt="Bauendreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-hard-hat"></i> Bauendreinigung
                        </span>
                    </div>
                </div>
                <h3>Bauendreinigung</h3>
                <p style="flex-grow: 1;">
                    Perfekter Abschluss nach Bau- und Renovierungsarbeiten. 
                    Entfernung von Bauschutt, Staub und Verschmutzungen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Grobe Endreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Feine Endreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Bauschuttentsorgung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Fensterpflege</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Fassadenreinigung -->
            <div id="fassadenreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/uploads/images/Fassadenreinigung.jpg" 
                         alt="Fassadenreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="800">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-building"></i> Fassadenreinigung
                        </span>
                    </div>
                </div>
                <h3>Fassadenreinigung</h3>
                <p style="flex-grow: 1;">
                    Schonende Reinigung Ihrer Gebäudefassade. 
                    Entfernung von Verschmutzungen, Graffiti und Algen.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Hochdruckreinigung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Graffitientfernung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Algenbewuchs</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Imprägnierung</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Glasreinigung -->
            <div id="glasreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/assets/images/Glasreinigung.jpg" 
                         alt="Glasreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="799">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-chess-board"></i> Glasreinigung
                        </span>
                    </div>
                </div>
                <h3>Glasreinigung</h3>
                <p style="flex-grow: 1;">
                    Kristallklare Glasflächen für moderne Architektur. 
                    Professionelle Reinigung von Glasfassaden und Wintergärten.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Glasfassaden</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Wintergärten</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Glasdächer</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Oberlichter</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Photovoltaikreinigung -->
            <div id="photovoltaikreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="/assets/images/content/reinigungsteam-muenchen.jpg" 
                         alt="Photovoltaikreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;" loading="lazy" decoding="async" width="1200" height="799">
                    <div style="position: absolute; top: 1rem; left: 1rem; display: none;">
                        <span class="badge badge-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-solar-panel"></i> Photovoltaikreinigung
                        </span>
                    </div>
                </div>
                <h3>Photovoltaikreinigung</h3>
                <p style="flex-grow: 1;">
                    Optimale Leistung durch saubere Solarmodule. 
                    Schonende Reinigung für maximale Energieausbeute.
                </p>
                <ul style="list-style: none; padding: 0; margin: var(--spacing-md) 0;">
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Solaranlagen</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>PV-Module</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Leistungsoptimierung</li>
                    <li style="padding: 0.25rem 0;"><i class="fas fa-check" style="color: var(--primary-color); margin-right: 0.5rem;"></i>Schonende Verfahren</li>
                </ul>
                <a href="/kontakt.php" class="btn btn-outline">Anfragen <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Vorteile -->
<section class="bg-light">
    <div class="container">
        <h2 class="text-center">Warum MDC Facility Management?</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <i class="fas fa-certificate" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>8+ Jahre Erfahrung</h4>
            </div>
            <div class="card text-center">
                <i class="fas fa-users-cog" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Geschultes Personal</h4>
            </div>
            <div class="card text-center">
                <i class="fas fa-shield-alt" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Vollversichert</h4>
                <p>Betriebs- und Berufshaftpflicht</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>24/7 Notdienst</h4>
                <p>Immer für Sie erreichbar</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section>
    <div class="container text-center">
        <h2>Bereit für eine saubere Lösung?</h2>
        <p style="font-size: 1.125rem; max-width: 600px; margin: 0 auto var(--spacing-lg);">
            Kontaktieren Sie uns für ein kostenloses und unverbindliches Angebot. 
            Wir beraten Sie gerne persönlich!
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/kontakt.php" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope"></i>
                Jetzt Angebot anfragen
            </a>
            <a href="tel:+498938043537" class="btn btn-outline btn-lg">
                <i class="fas fa-phone"></i>
                +49 89 38043537
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
