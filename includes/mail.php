<?php
/**
 * E-Mail-Versand für MDC Facility Management
 *
 * Erzeugt gestaltete HTML-Mails (mit Text-Alternative) und versendet sie
 * als MIME-Nachricht inklusive eingebettetem Logo.
 */

require_once __DIR__ . '/../config/database.php';

if (!function_exists('e')) {
    function e($string)
    {
        return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Kopfzeilen-Werte gegen Header-Injection absichern.
 */
function mdc_mail_sanitize_header($value)
{
    return trim(preg_replace('/[\r\n]+/', ' ', (string) $value));
}

/**
 * Betreff bzw. Anzeigenamen UTF-8-konform kodieren.
 */
function mdc_mail_encode_header($value)
{
    $value = mdc_mail_sanitize_header($value);

    return '=?UTF-8?B?' . base64_encode($value) . '?=';
}

/**
 * Absenderadresse mit Anzeigename aufbauen.
 */
function mdc_mail_from_header()
{
    return mdc_mail_encode_header(COMPANY_NAME) . ' <' . MAIL_FROM . '>';
}

/**
 * Erste Empfängeradresse aus einer kommaseparierten Liste holen.
 */
function mdc_mail_primary_address($list)
{
    $parts = explode(',', (string) $list);

    return mdc_mail_sanitize_header($parts[0]);
}

/**
 * MIME-Nachricht mit HTML-Teil, Text-Alternative und Inline-Logo versenden.
 *
 * @param string      $to      Empfänger (kommasepariert möglich)
 * @param string      $subject Betreff (unkodiert)
 * @param string      $html    HTML-Inhalt
 * @param string      $text    Text-Alternative
 * @param string|null $replyTo Optionale Reply-To-Adresse
 * @return bool
 */
function mdc_send_mail($to, $subject, $html, $text, $replyTo = null)
{
    $to = mdc_mail_sanitize_header($to);
    if ($to === '') {
        return false;
    }

    $boundaryAlt = 'mdc-alt-' . bin2hex(random_bytes(12));
    $boundaryRel = 'mdc-rel-' . bin2hex(random_bytes(12));

    $logoPath = __DIR__ . '/../assets/images/email-logo.png';
    $logoData = is_readable($logoPath) ? chunk_split(base64_encode((string) file_get_contents($logoPath)), 76, "\r\n") : '';

    $headers = [];
    $headers[] = 'From: ' . mdc_mail_from_header();
    if ($replyTo) {
        $headers[] = 'Reply-To: ' . mdc_mail_sanitize_header($replyTo);
    }
    $headers[] = 'Return-Path: ' . MAIL_FROM;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'X-Mailer: MDC Website';
    $headers[] = 'Content-Type: multipart/related; boundary="' . $boundaryRel . '"';

    $body = "Dies ist eine mehrteilige Nachricht im MIME-Format.\r\n\r\n";

    $body .= '--' . $boundaryRel . "\r\n";
    $body .= 'Content-Type: multipart/alternative; boundary="' . $boundaryAlt . '"' . "\r\n\r\n";

    $body .= '--' . $boundaryAlt . "\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($text), 76, "\r\n") . "\r\n";

    $body .= '--' . $boundaryAlt . "\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($html), 76, "\r\n") . "\r\n";

    $body .= '--' . $boundaryAlt . "--\r\n\r\n";

    if ($logoData !== '') {
        $body .= '--' . $boundaryRel . "\r\n";
        $body .= "Content-Type: image/png; name=\"mdc-logo.png\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-ID: <mdclogo>\r\n";
        $body .= "Content-Disposition: inline; filename=\"mdc-logo.png\"\r\n\r\n";
        $body .= $logoData . "\r\n";
    }

    $body .= '--' . $boundaryRel . "--\r\n";

    return mail(
        $to,
        mdc_mail_encode_header($subject),
        $body,
        implode("\r\n", $headers),
        '-f' . MAIL_FROM
    );
}

/**
 * Signaturblock (HTML) mit Firmendaten.
 */
function mdc_mail_signature_html()
{
    $siteUrl  = rtrim(SITE_URL, '/');
    $siteHost = preg_replace('#^https?://#', '', $siteUrl);

    return '
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-top:1px solid #e3e9f2;margin-top:8px;">
      <tr>
        <td style="padding:24px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:22px;color:#4a5568;">
          <p style="margin:0 0 14px 0;font-size:15px;color:#1f2a37;">Mit freundlichen Grüßen<br><strong style="color:#2A7DE1;">Ihr Team von ' . e(COMPANY_NAME) . '</strong></p>
          <img src="cid:mdclogo" alt="' . e(COMPANY_NAME) . '" width="180" style="display:block;width:180px;max-width:180px;height:auto;border:0;margin:0 0 14px 0;">
          <p style="margin:0 0 4px 0;font-weight:bold;color:#1f2a37;font-size:14px;">' . e(COMPANY_NAME) . '</p>
          <p style="margin:0 0 10px 0;color:#6b7684;">' . e(COMPANY_STREET) . '<br>' . e(COMPANY_CITY) . '</p>
          <p style="margin:0 0 2px 0;">Telefon: <a href="tel:' . e(COMPANY_PHONE_LINK) . '" style="color:#2A7DE1;text-decoration:none;">' . e(COMPANY_PHONE) . '</a></p>
          <p style="margin:0 0 2px 0;">Fax: <span style="color:#4a5568;">' . e(COMPANY_FAX) . '</span></p>
          <p style="margin:0 0 2px 0;">E-Mail: <a href="mailto:' . e(COMPANY_EMAIL) . '" style="color:#2A7DE1;text-decoration:none;">' . e(COMPANY_EMAIL) . '</a></p>
          <p style="margin:0;">Web: <a href="' . e($siteUrl) . '" style="color:#2A7DE1;text-decoration:none;">' . e($siteHost) . '</a></p>
        </td>
      </tr>
    </table>';
}

/**
 * Signaturblock (Text) mit Firmendaten.
 */
function mdc_mail_signature_text()
{
    $siteUrl = rtrim(SITE_URL, '/');

    $text  = "Mit freundlichen Grüßen\n";
    $text .= 'Ihr Team von ' . COMPANY_NAME . "\n\n";
    $text .= "--------------------------------------------------\n";
    $text .= COMPANY_NAME . "\n";
    $text .= COMPANY_STREET . "\n";
    $text .= COMPANY_CITY . "\n";
    $text .= 'Telefon: ' . COMPANY_PHONE . "\n";
    $text .= 'Fax: ' . COMPANY_FAX . "\n";
    $text .= 'E-Mail: ' . COMPANY_EMAIL . "\n";
    $text .= 'Web: ' . $siteUrl . "\n";

    return $text;
}

/**
 * Gemeinsames HTML-Grundgerüst für alle Mails.
 *
 * @param string $title      Überschrift im Kopfbereich
 * @param string $subtitle   Zeile unter der Überschrift
 * @param string $content    HTML-Inhalt des Hauptbereichs
 * @param string $preheader  Vorschautext im Postfach
 * @param bool   $withSignature Signatur anhängen
 */
function mdc_mail_layout($title, $subtitle, $content, $preheader = '', $withSignature = true)
{
    $siteUrl   = rtrim(SITE_URL, '/');
    $year      = date('Y');
    $signature = $withSignature ? mdc_mail_signature_html() : '';

    return '<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="x-apple-disable-message-reformatting">
<title>' . e($title) . '</title>
</head>
<body style="margin:0;padding:0;background-color:#eef3f9;">
<div style="display:none;font-size:1px;color:#eef3f9;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">' . e($preheader) . '</div>
<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#eef3f9;padding:24px 12px;">
  <tr>
    <td align="center">
      <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" style="width:600px;max-width:100%;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 6px 24px rgba(31,42,55,0.08);">
        <tr>
          <td align="center" style="background-color:#2A7DE1;background-image:linear-gradient(135deg,#2A7DE1 0%,#2BB5E8 100%);padding:32px 24px;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" style="background-color:#ffffff;border-radius:10px;padding:16px 22px;">
                  <img src="cid:mdclogo" alt="' . e(COMPANY_NAME) . '" width="200" style="display:block;width:200px;max-width:200px;height:auto;border:0;">
                </td>
              </tr>
            </table>
            <p style="margin:22px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:23px;line-height:30px;font-weight:bold;color:#ffffff;">' . e($title) . '</p>
            <p style="margin:8px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:22px;color:#e4f1ff;">' . e($subtitle) . '</p>
          </td>
        </tr>
        <tr>
          <td style="padding:32px 32px 28px 32px;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:24px;color:#374151;">
            ' . $content . '
            ' . $signature . '
          </td>
        </tr>
        <tr>
          <td style="background-color:#1f2a37;padding:22px 32px;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:20px;color:#9aa5b1;" align="center">
            <p style="margin:0 0 8px 0;">
              <a href="' . e($siteUrl) . '" style="color:#7fc4f5;text-decoration:none;">Website</a>
              &nbsp;&middot;&nbsp;
              <a href="' . e($siteUrl) . '/leistungen.php" style="color:#7fc4f5;text-decoration:none;">Leistungen</a>
              &nbsp;&middot;&nbsp;
              <a href="' . e($siteUrl) . '/impressum.php" style="color:#7fc4f5;text-decoration:none;">Impressum</a>
              &nbsp;&middot;&nbsp;
              <a href="' . e($siteUrl) . '/datenschutz.php" style="color:#7fc4f5;text-decoration:none;">Datenschutz</a>
            </p>
            <p style="margin:0;">&copy; ' . $year . ' ' . e(COMPANY_NAME) . ' &middot; ' . e(COMPANY_STREET) . ', ' . e(COMPANY_CITY) . '</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>';
}

/**
 * Übersichtstabelle der Anfragedaten rendern.
 *
 * @param array<string,string> $rows
 */
function mdc_mail_detail_table(array $rows, $heading = 'Ihre Anfrage im Überblick')
{
    $html = '
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f5f8fc;border:1px solid #e3e9f2;border-radius:10px;margin:0 0 24px 0;">
      <tr>
        <td style="padding:20px 22px;font-family:Arial,Helvetica,sans-serif;">
          <p style="margin:0 0 14px 0;font-size:13px;font-weight:bold;letter-spacing:0.6px;text-transform:uppercase;color:#2A7DE1;">' . e($heading) . '</p>
          <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:22px;color:#374151;">';

    foreach ($rows as $label => $value) {
        $html .= '
            <tr>
              <td width="40%" style="padding:5px 12px 5px 0;color:#6b7684;vertical-align:top;">' . e($label) . '</td>
              <td style="padding:5px 0;color:#1f2a37;font-weight:bold;vertical-align:top;">' . nl2br(e($value)) . '</td>
            </tr>';
    }

    $html .= '
          </table>
        </td>
      </tr>
    </table>';

    return $html;
}

/**
 * Bestätigungsmail ("Danke-Mail") an den Interessenten aufbauen.
 *
 * @param array{contact_person:string,company_name:string,email:string,phone:string,service_type:string,area:int|false,rhythm:string,notes:string} $data
 * @return array{subject:string,html:string,text:string}
 */
function mdc_build_customer_confirmation(array $data)
{
    $name = trim((string) ($data['contact_person'] ?? ''));

    $salutation = $name !== '' ? 'Guten Tag ' . $name . ',' : 'Guten Tag,';

    $steps = [
        ['1', 'Wir prüfen Ihre Anfrage', 'Unser Team sichtet Ihre Angaben und bereitet eine passende Lösung für Sie vor.'],
        ['2', 'Wir melden uns persönlich', 'Einer unserer Ansprechpartner nimmt zeitnah telefonisch oder per E-Mail Kontakt mit Ihnen auf.'],
        ['3', 'Sie erhalten Ihr Angebot', 'Auf Wunsch vereinbaren wir einen kostenlosen Vor-Ort-Termin und erstellen Ihnen ein unverbindliches Angebot.'],
    ];

    $stepsHtml = '
    <p style="margin:0 0 16px 0;font-size:16px;font-weight:bold;color:#1f2a37;">Wie geht es jetzt weiter?</p>
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin:0 0 26px 0;font-family:Arial,Helvetica,sans-serif;">';

    foreach ($steps as $step) {
        $stepsHtml .= '
      <tr>
        <td width="44" valign="top" style="padding:0 14px 16px 0;">
          <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="34">
            <tr>
              <td align="center" valign="middle" height="34" style="width:34px;height:34px;background-color:#2A7DE1;border-radius:17px;color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:bold;">' . e($step[0]) . '</td>
            </tr>
          </table>
        </td>
        <td valign="top" style="padding:0 0 16px 0;font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:22px;color:#4a5568;">
          <strong style="display:block;color:#1f2a37;font-size:15px;margin-bottom:2px;">' . e($step[1]) . '</strong>
          ' . e($step[2]) . '
        </td>
      </tr>';
    }

    $stepsHtml .= '
    </table>';

    $content  = '<p style="margin:0 0 16px 0;font-size:16px;color:#1f2a37;">' . e($salutation) . '</p>';
    $content .= '<p style="margin:0 0 16px 0;">vielen Dank für Ihre Anfrage und Ihr Interesse an ' . e(COMPANY_NAME) . '. Ihre Nachricht ist bei uns eingegangen – wir haben sie bereits an die zuständigen Kolleginnen und Kollegen weitergeleitet.</p>';
    $content .= '<p style="margin:0 0 24px 0;">Sie müssen nichts weiter tun: <strong>Wir melden uns so schnell wie möglich persönlich bei Ihnen</strong>, um alle Details in Ruhe mit Ihnen zu besprechen.</p>';
    $content .= $stepsHtml;

    $content .= '
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f5f8fc;border-radius:10px;margin:0 0 24px 0;">
      <tr>
        <td align="center" style="padding:22px;font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:22px;color:#4a5568;">
          <p style="margin:0 0 14px 0;">Sie möchten uns direkt erreichen? Rufen Sie uns einfach an – wir sind gerne für Sie da.</p>
          <table role="presentation" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="center" style="background-color:#2A7DE1;border-radius:8px;">
                <a href="tel:' . e(COMPANY_PHONE_LINK) . '" style="display:inline-block;padding:13px 28px;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:bold;color:#ffffff;text-decoration:none;">' . e(COMPANY_PHONE) . '</a>
              </td>
            </tr>
          </table>
          <p style="margin:14px 0 0 0;font-size:13px;color:#6b7684;">Montag bis Freitag von 08:00 bis 18:00 Uhr</p>
        </td>
      </tr>
    </table>';

    $content .= '<p style="margin:0 0 4px 0;">Wir freuen uns auf die Zusammenarbeit mit Ihnen!</p>';

    $html = mdc_mail_layout(
        'Vielen Dank für Ihre Anfrage!',
        'Wir haben Ihre Nachricht erhalten und melden uns in Kürze bei Ihnen.',
        $content,
        'Ihre Anfrage ist bei uns eingegangen – wir melden uns so schnell wie möglich bei Ihnen.'
    );

    $text  = $salutation . "\n\n";
    $text .= 'vielen Dank für Ihre Anfrage und Ihr Interesse an ' . COMPANY_NAME . ". Ihre Nachricht ist bei uns eingegangen.\n\n";
    $text .= "Sie müssen nichts weiter tun: Wir melden uns so schnell wie möglich persönlich bei Ihnen.\n\n";
    $text .= "WIE GEHT ES WEITER?\n";
    foreach ($steps as $step) {
        $text .= $step[0] . '. ' . $step[1] . ' – ' . $step[2] . "\n";
    }
    $text .= "\nSie erreichen uns direkt unter " . COMPANY_PHONE . " (Mo-Fr 08:00-18:00 Uhr).\n\n";
    $text .= "Wir freuen uns auf die Zusammenarbeit mit Ihnen!\n\n";
    $text .= mdc_mail_signature_text();

    return [
        'subject' => 'Vielen Dank für Ihre Anfrage bei ' . COMPANY_NAME,
        'html'    => $html,
        'text'    => $text,
    ];
}

/**
 * Bestätigungsmail an den Interessenten senden.
 */
function mdc_send_customer_confirmation(array $data)
{
    $email = trim((string) ($data['email'] ?? ''));
    if ($email === '') {
        return false;
    }

    $mail = mdc_build_customer_confirmation($data);

    return mdc_send_mail(
        $email,
        $mail['subject'],
        $mail['html'],
        $mail['text'],
        mdc_mail_primary_address(CONTACT_EMAIL)
    );
}

/**
 * Benachrichtigung über eine neue Anfrage aufbauen.
 *
 * @param array{contact_person:string,company_name:string,email:string,phone:string,service_type:string,area:int|false,rhythm:string,notes:string} $data
 * @return array{subject:string,html:string,text:string,reply_to:string}
 */
function mdc_build_team_notification(array $data)
{
    $name        = trim((string) ($data['contact_person'] ?? ''));
    $company     = trim((string) ($data['company_name'] ?? ''));
    $email       = trim((string) ($data['email'] ?? ''));
    $phone       = trim((string) ($data['phone'] ?? ''));
    $serviceType = trim((string) ($data['service_type'] ?? ''));
    $area        = $data['area'] ?? 0;
    $rhythm      = trim((string) ($data['rhythm'] ?? ''));
    $notes       = trim((string) ($data['notes'] ?? ''));

    $rows = [
        'Ansprechpartner' => $name !== '' ? $name : '-',
        'Unternehmen'     => $company !== '' ? $company : '-',
        'E-Mail'          => $email !== '' ? $email : '-',
        'Telefon'         => $phone !== '' ? $phone : '-',
        'Leistung'        => $serviceType !== '' ? $serviceType : '-',
        'Objektgröße'     => $area ? number_format((int) $area, 0, ',', '.') . ' m²' : '-',
        'Rhythmus'        => $rhythm !== '' ? $rhythm : '-',
        'Nachricht'       => $notes !== '' ? $notes : '(keine zusätzlichen Hinweise)',
        'Eingegangen am'  => date('d.m.Y \u\m H:i \U\h\r'),
    ];

    $content  = '<p style="margin:0 0 20px 0;">Über das Kontaktformular auf ' . e(preg_replace('#^https?://#', '', rtrim(SITE_URL, '/'))) . ' ist eine neue Anfrage eingegangen.</p>';
    $content .= mdc_mail_detail_table($rows, 'Details der Anfrage');

    if ($email !== '') {
        $content .= '
        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td align="center" style="background-color:#2A7DE1;border-radius:8px;">
              <a href="mailto:' . e($email) . '" style="display:inline-block;padding:13px 28px;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:bold;color:#ffffff;text-decoration:none;">Direkt antworten</a>
            </td>
          </tr>
        </table>';
    }

    $html = mdc_mail_layout(
        'Neue Kontaktanfrage',
        $serviceType !== '' ? 'Leistung: ' . $serviceType : 'Über das Kontaktformular der Website',
        $content,
        'Neue Anfrage von ' . ($company !== '' ? $company : $name),
        false
    );

    $text = "Neue Kontaktanfrage über die Website\n\n";
    foreach ($rows as $label => $value) {
        $text .= $label . ': ' . $value . "\n";
    }

    $subject = 'Neue Kontaktanfrage (' . ($serviceType !== '' ? $serviceType : 'Allgemein') . ') von ' . ($company !== '' ? $company : $name);

    return [
        'subject'  => $subject,
        'html'     => $html,
        'text'     => $text,
        'reply_to' => $email,
    ];
}

/**
 * Benachrichtigung über eine neue Anfrage an das MDC-Team senden.
 */
function mdc_send_team_notification(array $data)
{
    $mail = mdc_build_team_notification($data);

    return mdc_send_mail(
        CONTACT_EMAIL,
        $mail['subject'],
        $mail['html'],
        $mail['text'],
        $mail['reply_to'] ?: null
    );
}
