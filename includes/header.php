<?php
if (!defined('DB_HOST')) {
    require_once __DIR__ . '/../config/database.php';
}

$current_page = basename($_SERVER['PHP_SELF'], '.php');
$canonical_url = rtrim(SITE_URL, '/') . ($_SERVER['REQUEST_URI'] ?? '/');
$og_image_url = rtrim(SITE_URL, '/') . '/assets/images/MDC_Facility_Management_Logo_v2.png';
$page_title_tag = isset($page_title) ? trim((string) $page_title) : 'MDC Facility Management';
$page_description_tag = isset($page_description) ? trim((string) $page_description) : 'Professionelle Reinigungsdienstleistungen in München für Büro-, Industrie- und Gebäudereinigung.';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title><?php echo e($page_title_tag); ?> | MDC Facility Management</title>
    <meta name="description" content="<?php echo e($page_description_tag); ?>">
    <meta name="keywords" content="Büroreinigung München, Unterhaltsreinigung München, Fensterreinigung München, Shopreinigung München, Treppenhausreinigung München, Bauendreinigung München, Fassadenreinigung München, Glasreinigung München, Photovoltaikreinigung München, Reinigungsfirma München, Facility Management München">
    <meta name="author" content="MDC Facility Management">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#0a5dbb">
    <link rel="canonical" href="<?php echo e($canonical_url); ?>">
    <link rel="alternate" hreflang="de" href="<?php echo e($canonical_url); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e($canonical_url); ?>">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo rtrim(SITE_URL, '/'); ?>/sitemap.xml">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo e($page_title_tag); ?> | MDC Facility Management">
    <meta property="og:description" content="<?php echo e($page_description_tag); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($canonical_url); ?>">
    <meta property="og:image" content="<?php echo e($og_image_url); ?>">
    <meta property="og:image:secure_url" content="<?php echo e($og_image_url); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="MDC Facility Management Logo">
    <meta property="og:site_name" content="MDC Facility Management">
    <meta property="og:locale" content="de_DE">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($page_title_tag); ?> | MDC Facility Management">
    <meta name="twitter:description" content="<?php echo e($page_description_tag); ?>">
    <meta name="twitter:image" content="<?php echo e($og_image_url); ?>">

    <!-- Schema.org LocalBusiness Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "MDC Facility Management",
        "image": "<?php echo rtrim(SITE_URL, '/'); ?>/assets/images/MDC_Facility_Management_Logo_v2.png",
        "description": "Professionelle Büroreinigung, Unterhaltsreinigung, Fensterreinigung, Treppenhausreinigung und weitere Reinigungsdienstleistungen in München.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Rosa-Kempf-Str. 23",
            "addressLocality": "München",
            "postalCode": "81248",
            "addressCountry": "DE"
        },
        "telephone": "+49 89 38043537",
        "faxNumber": "+49 89 38043538",
        "email": "Info@mdc-fm.de",
        "url": "<?php echo rtrim(SITE_URL, '/'); ?>",
        "priceRange": "€€",
        "areaServed": "München",
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
    <link rel="icon" type="image/svg+xml" href="/assets/images/logo.svg">

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
                        <a href="tel:+498938043537" class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+49 89 38043537</span>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="header-main">
            <div class="container">
                <nav class="main-nav">
                    <a href="/" class="logo" aria-label="Startseite">
                        <img src="/uploads/images/MDC%20Facility%20Management%20Logo%20web%20used.png" alt="MDC Facility &amp; Cleaning Logo">
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
                                <li><a href="/leistungen.php#hausmeisterservice">Hausmeisterservice</a></li>
                                <li><a href="/leistungen.php#winterdienst">Winterdienst</a></li>
                                <li><a href="/leistungen.php#gruenanlagenservice">Grünanlagenservice</a></li>
                                <li><a href="/leistungen.php#umzug-entsorgung">Umzug &amp; Entsorgung</a></li>
                                <li><a href="/leistungen.php#tiefgaragenreinigung">Tiefgaragenreinigung</a></li>
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
