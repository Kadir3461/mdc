<?php
require_once 'config/database.php';

$page_title = 'Datenschutzerklärung';
$page_description = 'Datenschutzerklärung von MDC Facility Management - Informationen zum Datenschutz und zur Verarbeitung Ihrer Daten gemäß DSGVO.';

include 'includes/header.php';
?>

<section style="padding: var(--spacing-2xl) 0;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <h1>Datenschutzerklärung</h1>
            <p><em>Stand: <?php echo date('d.m.Y'); ?></em></p>

            <h2>1. Verantwortlicher</h2>
            <p>
                Für die Verarbeitung personenbezogener Daten auf dieser Website sind wir verantwortlich:
            </p>
            <p>
                <strong>MDC Facility Management</strong><br>
                Mine Durmaz<br>
                Rosa-Kempf-Str. 23<br>
                81248 München<br>
                Deutschland<br>
                E-Mail: <a href="mailto:Info@mdc-fm.de">Info@mdc-fm.de</a><br>
                Telefon: +49 89 38043537<br>
                Fax: +49 89 38043538
            </p>

            <h2>2. Datenschutz auf einen Blick</h2>
            <p>
                Wir verarbeiten Ihre Daten nur, soweit wir sie für den Betrieb dieser Website, die Bearbeitung Ihrer Anfragen und die Erbringung
                unserer Leistungen benötigen. Personenbezogene Daten sind alle Angaben, mit denen Sie direkt oder indirekt identifiziert werden können.
            </p>

            <h2>3. Erhebung und Verarbeitung personenbezogener Daten</h2>
            <h3>3.1 Kontaktformular</h3>
            <p>
                Wenn Sie uns über das Kontaktformular eine Anfrage oder einen Auftrag senden, speichern wir die Angaben, die Sie im Formular machen.
                Dazu gehören insbesondere:
            </p>
            <ul>
                <li>Firmenname</li>
                <li>Ansprechpartner</li>
                <li>E-Mail-Adresse</li>
                <li>Telefonnummer</li>
                <li>Gewünschte Leistung</li>
                <li>Nachricht</li>
                <li>IP-Adresse</li>
                <li>Browser-/Geräte-Informationen (User-Agent)</li>
            </ul>
            <p>
                Wir verwenden diese Daten nur, um Ihre Anfrage zu bearbeiten, Ihnen zu antworten und ein Angebot für Sie zu erstellen.
                Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO (Vertrag bzw. vorvertragliche Maßnahmen). In einzelnen Fällen stützen wir uns zusätzlich auf
                Art. 6 Abs. 1 lit. f DSGVO, also unser berechtigtes Interesse an einer zügigen und geordneten Bearbeitung von Anfragen.
            </p>

            <h3>3.2 Automatische Eingangsbestätigung</h3>
            <p>
                Sobald Sie das Kontaktformular abgeschickt haben, erhalten Sie automatisch eine Bestätigung an die von Ihnen angegebene
                E-Mail-Adresse. Sie informiert Sie lediglich darüber, dass Ihre Anfrage bei uns eingegangen ist, und enthält keine Werbung.
                Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO.
            </p>

            <h3>3.3 Anfrage per E-Mail oder Telefon</h3>
            <p>
                Nehmen Sie per E-Mail, Telefon oder auf anderem Weg Kontakt mit uns auf, speichern wir Ihre Anfrage samt den mitgeteilten Kontaktdaten.
                So können wir Ihr Anliegen beantworten und bei Rückfragen darauf zurückgreifen. Rechtsgrundlage ist Art. 6 Abs. 1 lit. b oder lit. f DSGVO.
            </p>

            <h3>3.4 Server- und Logdateien</h3>
            <p>
                Beim Besuch unserer Website werden automatisch technische Daten verarbeitet, vor allem IP-Adresse, Datum und Uhrzeit, aufgerufene Seite,
                Browsertyp, Betriebssystem und gegebenenfalls die Referrer-URL. Wir benötigen sie, um die Website sicher und stabil zu betreiben.
                Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO.
            </p>

            <h2>4. Weitergabe an Dritte</h2>
            <p>
                Ihre Daten geben wir nur an Dritte weiter, wenn das zur Bearbeitung Ihrer Anfrage, zur Vertragserfüllung, aufgrund gesetzlicher
                Vorgaben oder für die Sicherheit unserer Systeme notwendig ist. Zu Werbezwecken geben wir keine Daten weiter.
            </p>
            <p>
                Für den technischen Betrieb der Website setzen wir einen Webhosting-Anbieter und gegebenenfalls weitere technische Dienstleister ein.
                Diese verarbeiten Daten nur in unserem Auftrag und nach unseren Weisungen.
            </p>

            <h2>5. Cookies und Einwilligungsverwaltung</h2>
            <p>
                Wir verwenden ausschließlich technisch notwendige Cookies. Das sind das Sitzungscookie (<code>PHPSESSID</code>), das für die
                Sitzungsverwaltung, den Login-Bereich, die CSRF-Absicherung und den Spam-Schutz des Kontaktformulars gebraucht wird, sowie das Cookie
                <code>mdc_consent</code>, in dem wir Ihre Datenschutz-Auswahl rund sechs Monate lang speichern. Rechtsgrundlage ist § 25 Abs. 2 Nr. 2 TDDDG
                in Verbindung mit Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einem sicheren und funktionierenden Webauftritt).
            </p>
            <p>
                Cookies zu Tracking-, Analyse- oder Werbezwecken kommen bei uns nicht zum Einsatz. Ein Profiling oder eine automatisierte
                Entscheidungsfindung findet nicht statt.
            </p>
            <p>
                Ihre Auswahl können Sie jederzeit mit Wirkung für die Zukunft ändern oder widerrufen:
                <a href="#" data-consent-action="open">Datenschutz-Einstellungen öffnen</a>.
            </p>

            <h2>6. Externe Inhalte – Google Maps</h2>
            <p>
                Auf der Startseite und auf der Kontaktseite können Sie eine Karte von Google Maps anzeigen lassen. Der Dienst wird von der
                Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, betrieben.
            </p>
            <p>
                Die Karte wird <strong>nicht automatisch geladen</strong>. Zunächst sehen Sie nur einen Platzhalter, der von unserem eigenen Server stammt;
                dabei fließen keine Daten an Google. Erst wenn Sie auf „Karte laden“ klicken oder Google Maps in den Datenschutz-Einstellungen freigeben,
                wird eine Verbindung zu Google aufgebaut. Dann werden Ihre IP-Adresse, Browser- und Geräteangaben sowie der Zeitpunkt des Zugriffs an Google
                übertragen. Eine Übermittlung in die USA ist dabei nicht ausgeschlossen.
            </p>
            <p>
                Rechtsgrundlage ist Ihre Einwilligung nach Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1 TDDDG. Sie können sie jederzeit in den
                <a href="#" data-consent-action="open">Datenschutz-Einstellungen</a> widerrufen; bis dahin bleibt die Verarbeitung rechtmäßig.
                Mehr dazu finden Sie in der Datenschutzerklärung von Google:
                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">policies.google.com/privacy</a>.
            </p>

            <h2>7. Schriften, Symbole und Bilder</h2>
            <p>
                Die Schriftarten (Inter, Poppins), Symbole (Font Awesome) und Bilder dieser Website liefern wir ausschließlich von unserem eigenen
                Server aus. Es gibt daher keine Verbindung zu Google Fonts, Content-Delivery-Netzwerken oder anderen Drittanbietern, und es werden keine
                Daten an diese übermittelt.
            </p>

            <h2>8. Speicherdauer</h2>
            <p>
                Wir speichern Ihre Daten nur so lange, wie es der jeweilige Zweck erfordert oder gesetzliche Aufbewahrungspflichten es vorschreiben.
                Kontaktanfragen löschen wir in der Regel, sobald sie abschließend bearbeitet sind und die gesetzlichen Aufbewahrungsfristen abgelaufen
                sind, sofern keine weitergehenden rechtlichen Anforderungen bestehen.
            </p>

            <h2>9. Ihre Rechte</h2>
            <p>Nach der DSGVO stehen Ihnen folgende Rechte zu:</p>
            <ul>
                <li>Recht auf Auskunft über die zu Ihrer Person gespeicherten Daten (Art. 15 DSGVO)</li>
                <li>Recht auf Berichtigung unrichtiger Daten (Art. 16 DSGVO)</li>
                <li>Recht auf Löschung (Art. 17 DSGVO)</li>
                <li>Recht auf Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
                <li>Recht auf Datenübertragbarkeit (Art. 20 DSGVO)</li>
                <li>Widerspruchsrecht gegen die Verarbeitung (Art. 21 DSGVO)</li>
                <li>Beschwerderecht bei einer zuständigen Aufsichtsbehörde (Art. 77 DSGVO)</li>
            </ul>
            <p>
                Um eines dieser Rechte geltend zu machen, schreiben Sie uns bitte an die oben genannte E-Mail-Adresse.
            </p>

            <h2>10. Kontakt zum Datenschutz</h2>
            <p>
                Haben Sie Fragen zum Datenschutz oder zur Verarbeitung Ihrer Daten? Dann wenden Sie sich gerne an uns:
            </p>
            <p>
                <strong>MDC Facility Management</strong><br>
                Mine Durmaz<br>
                Rosa-Kempf-Str. 23, 81248 München<br>
                E-Mail: <a href="mailto:Info@mdc-fm.de">Info@mdc-fm.de</a><br>
                Telefon: +49 89 38043537<br>
                Fax: +49 89 38043538
            </p>

            <div style="margin-top: var(--spacing-2xl); padding: var(--spacing-md); background-color: var(--bg-light); border-radius: var(--radius-md);">
                <p style="margin: 0; font-size: 0.875rem;">
                    <strong>Stand:</strong> 26.10.2026. Ändern sich unsere Leistungen oder die eingesetzte Technik, passen wir diese Datenschutzerklärung entsprechend an.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
