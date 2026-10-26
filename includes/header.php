<?php
if (!defined('DB_HOST')) {
    require_once __DIR__ . '/../config/database.php';
}

$current_page = basename($_SERVER['SCRIPT_NAME'] ?? '', '.php');
$current_page = preg_replace('/[^a-z0-9_-]/i', '', $current_page);

// Canonical ohne Query-String, damit Parameter keine Duplicate-Content-URLs erzeugen
$requestPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
if ($requestPath === '/index.php') {
    $requestPath = '/';
}
$canonical_url = rtrim(SITE_URL, '/') . $requestPath;
$og_image_url = rtrim(SITE_URL, '/') . '/assets/images/og-image.jpg';
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
    <meta name="theme-color" content="#2A7DE1">
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
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="MDC Facility Management – Sauberkeit, Qualität, Vertrauen">
    <meta property="og:site_name" content="MDC Facility Management">
    <meta property="og:locale" content="de_DE">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($page_title_tag); ?> | MDC Facility Management">
    <meta name="twitter:description" content="<?php echo e($page_description_tag); ?>">
    <meta name="twitter:image" content="<?php echo e($og_image_url); ?>">

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    <?php
    $siteBase = rtrim(SITE_URL, '/');
    $serviceList = [
        'Büroreinigung', 'Unterhaltsreinigung', 'Fensterreinigung', 'Shopreinigung',
        'Treppenhausreinigung', 'Bauendreinigung', 'Hausmeisterservice', 'Winterdienst',
        'Grünanlagenservice', 'Umzug & Entsorgung', 'Tiefgaragenreinigung', 'Fassadenreinigung',
        'Glasreinigung', 'Photovoltaikreinigung',
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'Organization',
                '@id'         => $siteBase . '/#organization',
                'name'        => 'MDC Facility Management',
                'url'         => $siteBase . '/',
                'logo'        => [
                    '@type'  => 'ImageObject',
                    'url'    => $siteBase . '/assets/images/MDC_Facility_Management_Logo_v2.png',
                    'width'  => 1863,
                    'height' => 844,
                ],
                'image'       => $og_image_url,
                'email'       => COMPANY_EMAIL,
                'telephone'   => COMPANY_PHONE,
                'faxNumber'   => COMPANY_FAX,
                'address'     => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => COMPANY_STREET,
                    'addressLocality' => 'München',
                    'postalCode'      => '81248',
                    'addressRegion'   => 'Bayern',
                    'addressCountry'  => 'DE',
                ],
                'contactPoint' => [
                    '@type'             => 'ContactPoint',
                    'telephone'         => COMPANY_PHONE,
                    'contactType'       => 'customer service',
                    'email'             => COMPANY_EMAIL,
                    'areaServed'        => 'DE',
                    'availableLanguage' => ['German'],
                ],
            ],
            [
                '@type'           => 'WebSite',
                '@id'             => $siteBase . '/#website',
                'url'             => $siteBase . '/',
                'name'            => 'MDC Facility Management',
                'inLanguage'      => 'de-DE',
                'publisher'       => ['@id' => $siteBase . '/#organization'],
            ],
            [
                '@type'       => 'WebPage',
                '@id'         => $canonical_url . '#webpage',
                'url'         => $canonical_url,
                'name'        => $page_title_tag . ' | MDC Facility Management',
                'description' => $page_description_tag,
                'inLanguage'  => 'de-DE',
                'isPartOf'    => ['@id' => $siteBase . '/#website'],
                'about'       => ['@id' => $siteBase . '/#localbusiness'],
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $og_image_url],
            ],
            [
                '@type'       => ['LocalBusiness', 'ProfessionalService'],
                '@id'         => $siteBase . '/#localbusiness',
                'name'        => 'MDC Facility Management',
                'image'       => $siteBase . '/assets/images/MDC_Facility_Management_Logo_v2.png',
                'logo'        => $siteBase . '/assets/images/MDC_Facility_Management_Logo_v2.png',
                'description' => 'Professionelle Büroreinigung, Unterhaltsreinigung, Fensterreinigung, Treppenhausreinigung und weitere Reinigungsdienstleistungen in München und Umgebung.',
                'url'         => $siteBase . '/',
                'telephone'   => COMPANY_PHONE,
                'faxNumber'   => COMPANY_FAX,
                'email'       => COMPANY_EMAIL,
                'priceRange'  => '€€',
                'currenciesAccepted' => 'EUR',
                'paymentAccepted'    => 'Rechnung, Überweisung',
                'address'     => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => COMPANY_STREET,
                    'addressLocality' => 'München',
                    'postalCode'      => '81248',
                    'addressRegion'   => 'Bayern',
                    'addressCountry'  => 'DE',
                ],
                'geo' => [
                    '@type'     => 'GeoCoordinates',
                    'latitude'  => 48.1518,
                    'longitude' => 11.4603,
                ],
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'München'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Landkreis München'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Oberbayern'],
                ],
                'openingHoursSpecification' => [
                    [
                        '@type'     => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        'opens'     => '08:00',
                        'closes'    => '18:00',
                    ],
                ],
                'parentOrganization' => ['@id' => $siteBase . '/#organization'],
                'hasOfferCatalog'    => [
                    '@type'          => 'OfferCatalog',
                    'name'           => 'Reinigungsdienstleistungen',
                    'itemListElement' => array_map(static function ($service) {
                        return [
                            '@type' => 'Offer',
                            'itemOffered' => [
                                '@type'       => 'Service',
                                'name'        => $service,
                                'serviceType' => $service,
                                'areaServed'  => ['@type' => 'City', 'name' => 'München'],
                            ],
                        ];
                    }, $serviceList),
                ],
            ],
        ],
    ];

    if (!empty($breadcrumbs) && is_array($breadcrumbs)) {
        $items = [];
        $position = 1;
        foreach ($breadcrumbs as $label => $path) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => $label,
                'item'     => $siteBase . $path,
            ];
        }
        $schema['@graph'][] = [
            '@type'           => 'BreadcrumbList',
            '@id'             => $canonical_url . '#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP);
    ?>
    </script>

    <!-- Favicon & App-Icons -->
    <link rel="icon" href="/favicon.ico" sizes="32x32">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/favicon-192.png">
    <link rel="icon" type="image/svg+xml" href="/assets/images/logo.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon-180.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="apple-mobile-web-app-title" content="MDC">
    <meta name="application-name" content="MDC Facility Management">

    <!-- Stylesheets (lokal gehostet, keine externen Anfragen) -->
    <link rel="preload" href="/assets/fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/vendor/fontawesome/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?php echo e(asset_url('/assets/fonts/fonts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset_url('/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset_url('/assets/vendor/fontawesome/all.min.css')); ?>">
</head>
<body class="<?php echo e($current_page); ?>-page">
    
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
                        <img src="/uploads/images/MDC%20Facility%20Management%20Logo%20web%20used.png" alt="MDC Facility &amp; Cleaning Logo" width="900" height="377" fetchpriority="high" decoding="async">
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
