<?php
require_once 'config/database.php';

$page_title = 'Unsere Leistungen';
$page_description = 'Professionelle Reinigungsdienstleistungen in München - Büroreinigung, Unterhaltsreinigung, Fensterreinigung, Shopreinigung, Treppenhausreinigung, Bauendreinigung, Fassadenreinigung, Glasreinigung und Photovoltaikreinigung. ☎ Jetzt anfragen!';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('https://images.unsplash.com/photo-1527689368864-3a821dbccc34?q=80&w=2070'); min-height: 500px;">
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
            Seit über 15 Jahren sind wir Ihr kompetenter Partner für alle Reinigungsdienstleistungen 
            im Raum München. Ob Industrie, Gewerbe oder Wohnimmobilien – wir bieten individuelle Lösungen 
            für jeden Bereich.
        </p>
        
        <div class="grid grid-3" style="gap: var(--spacing-2xl);">
            <!-- Büroreinigung -->
            <div id="bueroreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069" 
                         alt="Büroreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=2070" 
                         alt="Unterhaltsreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="/assets/images/Fensterreinigung.png" 
                         alt="Fensterreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2070" 
                         alt="Shopreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?q=80&w=2070" 
                         alt="Treppenhausreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
            
            <!-- Bauendreinigung -->
            <div id="bauendreinigung" class="card" style="display: flex; flex-direction: column;">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <img src="https://images.unsplash.com/photo-1628177142898-93e36e4e3a50?q=80&w=2070" 
                         alt="Bauendreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070" 
                         alt="Fassadenreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="/assets/images/Glasreinigung.png" 
                         alt="Glasreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
                    <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=2072" 
                         alt="Photovoltaikreinigung" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
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
        <h2 class="text-center">Warum MDC Facility & Cleaning?</h2>
        <div class="grid grid-4">
            <div class="card text-center">
                <i class="fas fa-certificate" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>15+ Jahre Erfahrung</h4>
                <p>Kompetenz und Knowhow seit 2009</p>
            </div>
            <div class="card text-center">
                <i class="fas fa-users-cog" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h4>Geschultes Personal</h4>
                <p>50+ professionelle Mitarbeiter</p>
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
            <a href="tel:+4989XXXXXXXX" class="btn btn-outline btn-lg">
                <i class="fas fa-phone"></i>
                +49 89 XXX XXXX
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
