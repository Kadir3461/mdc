<?php
if (!defined('DB_HOST')) {
    require_once __DIR__ . '/../config/database.php';
}

$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($page_title) ? e($page_title) . ' | MDC Facility & Cleaning' : 'MDC Facility & Cleaning | Professionelle Gebäudereinigung München'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? e($page_description) : 'MDC Facility & Cleaning - Ihr professioneller Partner für Büroreinigung, Unterhaltsreinigung, Fensterreinigung, Shopreinigung, Treppenhausreinigung und weitere Reinigungsdienstleistungen in München und Umgebung.'; ?>">
    <meta name="keywords" content="Büroreinigung München, Unterhaltsreinigung München, Fensterreinigung München, Shopreinigung München, Treppenhausreinigung München, Bauendreinigung München, Fassadenreinigung München, Glasreinigung München, Photovoltaikreinigung München, Reinigungsfirma München">
    <meta name="author" content="MDC Facility & Cleaning">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo isset($page_title) ? e($page_title) : 'MDC Facility & Cleaning'; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? e($page_description) : 'Professionelle Gebäudereinigung in München'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">
    <meta property="og:locale" content="de_DE">
    
    <!-- Schema.org LocalBusiness Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "MDC Facility & Cleaning",
        "image": "<?php echo SITE_URL; ?>/assets/images/MDC_Logo_mit_Slogan.jpeg",
        "description": "Professionelle Büroreinigung, Unterhaltsreinigung, Fensterreinigung, Treppenhausreinigung und weitere Reinigungsdienstleistungen in München",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Rosa-Kempf-Str. 23",
            "addressLocality": "München",
            "postalCode": "81248",
            "addressCountry": "DE"
        },
        "telephone": "+49-89-XXXXXXXX",
        "email": "Info@mdc-fm.de",
        "url": "<?php echo SITE_URL; ?>",
        "priceRange": "$$",
        "areaServed": {
            "@type": "GeoCircle",
            "geoMidpoint": {
                "@type": "GeoCoordinates",
                "latitude": "48.1351",
                "longitude": "11.5820"
            },
            "geoRadius": "50000"
        },
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens": "08:00",
                "closes": "18:00"
            }
        ]
    }
    </script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
</head>
<body class="<?php echo $current_page; ?>-page">
    
    <!-- Header -->
    <header class="site-header">
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <div class="contact-info">
                        <a href="tel:+4989XXXXXXXX" class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+49 89 XXX XXXX</span>
                        </a>
                        <a href="mailto:Info@mdc-fm.de" class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>Info@mdc-fm.de</span>
                        </a>
                    </div>
                    <div class="header-right">
                        <?php if (isLoggedIn()): ?>
                            <a href="/dashboard.php" class="header-link">
                                <i class="fas fa-user"></i>
                                <span><?php echo isAdmin() ? 'Admin-Bereich' : 'Mein Bereich'; ?></span>
                            </a>
                            <a href="/logout.php" class="header-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Abmelden</span>
                            </a>
                        <?php else: ?>
                            <a href="/login.php" class="header-link">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="header-main">
            <div class="container">
                <nav class="main-nav">
                    <a href="/" class="logo">
                        <img src="/assets/images/MDC_Logo_mit_Slogan.jpeg" alt="MDC Facility & Cleaning Logo" style="height: 100%; width: 100;">
                    </a>
                    
                    <button class="mobile-menu-toggle" aria-label="Menü öffnen">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
                    <ul class="nav-menu">
                        <li><a href="/" class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">Startseite</a></li>
                        <li class="has-dropdown">
                            <a href="/leistungen.php" class="<?php echo $current_page === 'leistungen' ? 'active' : ''; ?>">
                                Leistungen <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/bueroreinigung.php">Büroreinigung</a></li>
                                <li><a href="/leistungen.php#unterhaltsreinigung">Unterhaltsreinigung</a></li>
                                <li><a href="/leistungen.php#fensterreinigung">Fensterreinigung</a></li>
                                <li><a href="/leistungen.php#shopreinigung">Shopreinigung</a></li>
                                <li><a href="/leistungen.php#treppenhausreinigung">Treppenhausreinigung</a></li>
                                <li><a href="/leistungen.php#bauendreinigung">Bauendreinigung</a></li>
                                <li><a href="/leistungen.php#fassadenreinigung">Fassadenreinigung</a></li>
                                <li><a href="/leistungen.php#glasreinigung">Glasreinigung</a></li>
                                <li><a href="/leistungen.php#photovoltaikreinigung">Photovoltaikreinigung</a></li>
                            </ul>
                        </li>
                        <li><a href="/ueber-uns.php" class="<?php echo $current_page === 'ueber-uns' ? 'active' : ''; ?>">Über uns</a></li>
                        <li><a href="/kontakt.php" class="<?php echo $current_page === 'kontakt' ? 'active' : ''; ?>">Kontakt</a></li>
                    </ul>
                    
                    <a href="/kontakt.php#angebot" class="btn btn-primary header-cta">
                        Kostenloses Angebot
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
