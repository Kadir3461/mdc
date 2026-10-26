<?php
/**
 * Einwilligungsabhängige Einbindung externer Inhalte (DSGVO)
 *
 * Externe Dienste werden erst geladen, nachdem die Besucherin oder der Besucher
 * ausdrücklich zugestimmt hat ("Zwei-Klick-Lösung"). Bis dahin wird nur ein
 * lokaler Platzhalter ausgeliefert – es findet keinerlei Verbindung zum
 * Drittanbieter statt.
 */

/**
 * Google-Maps-Karte mit Einwilligungs-Platzhalter ausgeben.
 *
 * @param int    $height Höhe der Karte in Pixeln
 * @param string $style  Zusätzliche CSS-Regeln für den Container
 */
function mdc_consent_map($height = 450, $style = '')
{
    $query = rawurlencode(COMPANY_STREET . ', ' . COMPANY_CITY);
    $src   = 'https://maps.google.com/maps?q=' . $query . '&t=&z=15&ie=UTF8&iwloc=&output=embed';
    $link  = 'https://www.google.com/maps/search/?api=1&query=' . $query;
    ?>
    <div class="consent-embed" data-consent-category="karten" style="<?php echo e($style); ?>">
        <div class="consent-placeholder" style="min-height: <?php echo (int) $height; ?>px;">
            <i class="fas fa-map-location-dot consent-placeholder-icon" aria-hidden="true"></i>
            <h3>Google Maps ist deaktiviert</h3>
            <p>
                Um die Karte anzuzeigen, wird eine Verbindung zu Google Maps hergestellt.
                Dabei werden Ihre IP-Adresse und weitere Daten an Google übertragen.
                Mehr dazu in unserer <a href="/datenschutz.php">Datenschutzerklärung</a>.
            </p>
            <div class="consent-placeholder-actions">
                <button type="button" class="btn btn-primary btn-sm" data-consent-accept="karten">
                    <i class="fas fa-check" aria-hidden="true"></i> Karte laden
                </button>
                <a class="btn btn-outline btn-sm" href="<?php echo e($link); ?>" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i> In Google Maps öffnen
                </a>
            </div>
            <label class="consent-placeholder-remember">
                <input type="checkbox" data-consent-remember="karten" checked>
                <span>Entscheidung merken</span>
            </label>
        </div>
        <template class="consent-embed-content">
            <iframe
                src="<?php echo e($src); ?>"
                title="Standort von <?php echo e(COMPANY_NAME); ?> auf Google Maps"
                width="100%"
                height="<?php echo (int) $height; ?>"
                style="border:0; display:block;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </template>
    </div>
    <?php
}
