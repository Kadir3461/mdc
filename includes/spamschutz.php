<?php
/**
 * Spam-Schutz für das Kontaktformular
 *
 * Kombiniert mehrere Verfahren, die ohne externe Dienste (z. B. Captcha)
 * auskommen und für Besucher unsichtbar bleiben:
 *  - Honeypot-Feld, das nur von Bots ausgefüllt wird
 *  - Mindest-Ausfülldauer des Formulars
 *  - Inhaltsprüfung (Links, typische Spam-Muster)
 *  - Begrenzung der Anfragen pro IP-Adresse
 */

require_once __DIR__ . '/../config/database.php';

// Name des Honeypot-Feldes (für Bots wie ein echtes Feld benannt)
define('SPAM_HONEYPOT_FIELD', 'website_url');

// Mindestzeit in Sekunden zwischen Formularaufruf und Absenden
define('SPAM_MIN_FORM_SECONDS', 4);

// Maximale Anfragen je IP-Adresse
define('SPAM_MAX_PER_HOUR', 5);
define('SPAM_MAX_PER_DAY', 15);

/**
 * Zeitpunkt des Formularaufrufs in der Session hinterlegen.
 */
function mdc_spam_start_form()
{
    if (session_status() === PHP_SESSION_NONE) {
        startSecureSession();
    }

    if (empty($_SESSION['contact_form_started_at'])) {
        $_SESSION['contact_form_started_at'] = time();
    }
}

/**
 * Formular-Zeitstempel nach einem erfolgreichen Versand zurücksetzen.
 */
function mdc_spam_reset_form()
{
    unset($_SESSION['contact_form_started_at']);
}

/**
 * Honeypot-Feld ausgeben. Das Feld ist visuell und für Screenreader versteckt.
 */
function mdc_spam_honeypot_html()
{
    return '<div class="hp-field" aria-hidden="true">'
        . '<label for="' . SPAM_HONEYPOT_FIELD . '">Bitte dieses Feld leer lassen</label>'
        . '<input type="text" id="' . SPAM_HONEYPOT_FIELD . '" name="' . SPAM_HONEYPOT_FIELD . '"'
        . ' value="" tabindex="-1" autocomplete="off">'
        . '</div>';
}

/**
 * IP-Adresse des Besuchers ermitteln.
 */
function mdc_spam_client_ip()
{
    return $_SERVER['REMOTE_ADDR'] ?? '';
}

/**
 * Anzahl bisheriger Anfragen einer IP-Adresse im angegebenen Zeitraum.
 */
function mdc_spam_request_count($hours)
{
    $ip = mdc_spam_client_ip();
    if ($ip === '') {
        return 0;
    }

    try {
        $stmt = getDB()->prepare(sprintf(
            'SELECT COUNT(*) FROM contact_requests WHERE ip_address = ? AND created_at > (NOW() - INTERVAL %d HOUR)',
            (int) $hours
        ));
        $stmt->execute([$ip]);

        return (int) $stmt->fetchColumn();
    } catch (Exception $e) {
        error_log('Spam-Schutz: Zählung fehlgeschlagen - ' . $e->getMessage());

        return 0;
    }
}

/**
 * Inhalt auf typische Spam-Merkmale prüfen.
 */
function mdc_spam_content_suspicious(array $fields)
{
    $all = mb_strtolower(implode(' ', $fields));

    // Mehr als zwei Links deuten auf automatisierte Werbung hin
    if (preg_match_all('#https?://|www\.#i', $all) > 2) {
        return true;
    }

    // BBCode- oder HTML-Links gehören nicht in ein Kontaktformular
    if (preg_match('#\[url=|<a\s+href=#i', $all)) {
        return true;
    }

    // Kyrillische oder chinesische Zeichen kommen bei deutschen Anfragen praktisch nicht vor
    if (preg_match('/[\x{0400}-\x{04FF}\x{4E00}-\x{9FFF}]/u', $all)) {
        return true;
    }

    $spamWords = [
        'seo service', 'backlink', 'crypto', 'bitcoin', 'casino', 'viagra',
        'cialis', 'porn', 'xxx', 'loan offer', 'make money', 'binary option',
        'followers', 'ranking garantiert', 'traffic kaufen',
    ];

    foreach ($spamWords as $word) {
        if (strpos($all, $word) !== false) {
            return true;
        }
    }

    // Name und Firma dürfen keine Links enthalten
    foreach (['contact_person', 'company_name'] as $key) {
        if (isset($fields[$key]) && preg_match('#https?://|www\.#i', $fields[$key])) {
            return true;
        }
    }

    return false;
}

/**
 * Formular auf Spam prüfen.
 *
 * @param array<string,string> $fields Bereinigte Formularwerte
 * @return array{spam:bool,silent:bool,reason:string}
 *         spam   = Anfrage nicht verarbeiten
 *         silent = Besucher erhält trotzdem die Erfolgsmeldung (Bot soll nichts lernen)
 */
function mdc_spam_check(array $fields)
{
    $ok = ['spam' => false, 'silent' => false, 'reason' => ''];

    // 1. Honeypot: von echten Besuchern nie ausgefüllt
    if (trim((string) ($_POST[SPAM_HONEYPOT_FIELD] ?? '')) !== '') {
        return ['spam' => true, 'silent' => true, 'reason' => 'honeypot'];
    }

    // 2. Formular wurde unrealistisch schnell abgeschickt
    $startedAt = $_SESSION['contact_form_started_at'] ?? 0;
    if (!$startedAt || (time() - (int) $startedAt) < SPAM_MIN_FORM_SECONDS) {
        return ['spam' => true, 'silent' => true, 'reason' => 'zu schnell abgesendet'];
    }

    // 3. Inhaltliche Spam-Merkmale
    if (mdc_spam_content_suspicious($fields)) {
        return ['spam' => true, 'silent' => true, 'reason' => 'verdächtiger Inhalt'];
    }

    // 4. Zu viele Anfragen von derselben IP-Adresse
    if (mdc_spam_request_count(1) >= SPAM_MAX_PER_HOUR) {
        return ['spam' => true, 'silent' => false, 'reason' => 'Limit pro Stunde erreicht'];
    }

    if (mdc_spam_request_count(24) >= SPAM_MAX_PER_DAY) {
        return ['spam' => true, 'silent' => false, 'reason' => 'Limit pro Tag erreicht'];
    }

    return $ok;
}
