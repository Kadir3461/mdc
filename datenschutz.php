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
                Verantwortlich für die Datenverarbeitung auf dieser Website ist:
            </p>
            <p>
                <strong>MDC Facility &amp; Cleaning</strong><br>
                Can Durmaz<br>
                Rosa-Kempf-Str. 23<br>
                81248 München<br>
                Deutschland<br>
                E-Mail: <a href="mailto:Info@mdc-fm.de">Info@mdc-fm.de</a><br>
                Telefon: +49 89 38043537<br>
                Fax: +49 89 38043538
            </p>

            <h2>2. Datenschutz auf einen Blick</h2>
            <p>
                Wir verarbeiten personenbezogene Daten nur insoweit, wie dies zur Bereitstellung unserer Website, zur Bearbeitung Ihrer Anfragen
                und zur Durchführung unserer Dienstleistungen erforderlich ist. Personenbezogene Daten sind alle Informationen, die Sie persönlich identifizieren.
            </p>

            <h2>3. Erhebung und Verarbeitung personenbezogener Daten</h2>
            <h3>3.1 Kontaktformular</h3>
            <p>
                Wenn Sie über das Kontaktformular auf der Website einen Antrag, eine Anfrage oder eine Bestellung senden, erfassen wir die von Ihnen
                im Formular eingegebenen Daten, insbesondere:
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
                Diese Daten nutzen wir ausschließlich zur Bearbeitung Ihrer Anfrage, zur Rückmeldung und zur Angebotsvorbereitung.
                Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO (Vertrag bzw. vorvertragliche Maßnahmen) und in Einzelfällen
                auch auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einer effizienten Bearbeitung der Anfragen).
            </p>

            <h3>3.2 Automatische Eingangsbestätigung</h3>
            <p>
                Nach dem Absenden des Kontaktformulars senden wir Ihnen an die von Ihnen angegebene E-Mail-Adresse automatisch eine
                Eingangsbestätigung. Diese dient ausschließlich dazu, Sie über den Eingang Ihrer Anfrage zu informieren, und enthält keine Werbung.
                Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO.
            </p>

            <h3>3.3 Anfrage per E-Mail oder Telefon</h3>
            <p>
                Wenn Sie uns per E-Mail, Telefon oder auf andere Weise kontaktieren, speichern wir Ihre Anfrage einschließlich der dabei übermittelten
                Kontaktdaten, um Ihr Anliegen zu beantworten und für den Fall von Rückfragen zu dokumentieren. Die Verarbeitung erfolgt gemäß Art. 6 Abs. 1 lit. b
                oder lit. f DSGVO.
            </p>

            <h3>3.4 Server- und Logdateien</h3>
            <p>
                Bei jedem Aufruf unserer Website werden technische Daten automatisch verarbeitet, insbesondere IP-Adresse, Datum, Uhrzeit, aufgerufene Seite,
                Browsertyp, Betriebssystem und ggf. Referrer-URL. Diese Daten dienen der Sicherstellung der technischen Funktionsfähigkeit, der Sicherheit
                sowie der Stabilität der Website und werden auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO verarbeitet.
            </p>

            <h2>4. Weitergabe an Dritte</h2>
            <p>
                Wir geben personenbezogene Daten nur dann an Dritte weiter, wenn dies für die Bearbeitung Ihrer Anfrage, für die Vertragserfüllung,
                aus rechtlichen Gründen oder zur Gewährleistung der Sicherheit unserer Systeme erforderlich ist. Eine Weitergabe zu Werbezwecken erfolgt nicht.
            </p>
            <p>
                Im Rahmen der technischen Bereitstellung der Website kann es zu einer Verarbeitung durch den Webhosting-Anbieter oder andere technisch
                notwendige Dienstleister kommen. Diese verarbeiten die Daten ausschließlich im Auftrag und nach unseren Weisungen.
            </p>

            <h2>5. Cookies und Einwilligungsverwaltung</h2>
            <p>
                Unsere Website setzt ausschließlich technisch notwendige Cookies ein. Dazu gehören das Sitzungscookie (<code>PHPSESSID</code>) für die
                Sessionverwaltung, den Login-Bereich, die CSRF-Sicherung und den Spam-Schutz des Kontaktformulars sowie das Cookie <code>mdc_consent</code>,
                in dem Ihre Datenschutz-Auswahl für rund sechs Monate gespeichert wird. Rechtsgrundlage ist § 25 Abs. 2 Nr. 2 TDDDG in Verbindung mit
                Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einem sicheren, funktionsfähigen Webauftritt).
            </p>
            <p>
                Tracking-, Analyse- oder Werbe-Cookies setzen wir nicht ein. Es findet kein Profiling und keine automatisierte Entscheidungsfindung statt.
            </p>
            <p>
                Ihre Auswahl können Sie jederzeit mit Wirkung für die Zukunft ändern oder widerrufen:
                <a href="#" data-consent-action="open">Datenschutz-Einstellungen öffnen</a>.
            </p>

            <h2>6. Externe Inhalte – Google Maps</h2>
            <p>
                Auf der Startseite und der Kontaktseite bieten wir eine Kartendarstellung von Google Maps an, einem Dienst der Google Ireland Limited,
                Gordon House, Barrow Street, Dublin 4, Irland.
            </p>
            <p>
                Die Karte wird <strong>nicht automatisch geladen</strong>. Sie sehen zunächst nur einen lokal gespeicherten Platzhalter; dabei werden keine
                Daten an Google übertragen. Erst wenn Sie aktiv auf „Karte laden“ klicken oder Google Maps in den Datenschutz-Einstellungen aktivieren,
                wird eine Verbindung zu Google hergestellt. Dabei werden Ihre IP-Adresse, Angaben zu Browser und Gerät sowie das Datum des Zugriffs an
                Google übermittelt; eine Übermittlung in die USA kann nicht ausgeschlossen werden.
            </p>
            <p>
                Rechtsgrundlage ist Ihre Einwilligung gemäß Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1 TDDDG. Sie können die Einwilligung jederzeit über die
                <a href="#" data-consent-action="open">Datenschutz-Einstellungen</a> widerrufen; die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung
                bleibt davon unberührt. Weitere Informationen finden Sie in der Datenschutzerklärung von Google:
                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">policies.google.com/privacy</a>.
            </p>

            <h2>7. Schriften, Symbole und Bilder</h2>
            <p>
                Alle auf dieser Website verwendeten Schriftarten (Inter, Poppins), Symbole (Font Awesome) und Bilder werden ausschließlich von unserem eigenen
                Server ausgeliefert. Es besteht dadurch keine Verbindung zu Google Fonts, Content-Delivery-Netzwerken oder anderen Drittanbietern, und es
                werden keine Daten an solche Anbieter übertragen.
            </p>

            <h2>8. Speicherdauer</h2>
            <p>
                Wir speichern Ihre personenbezogenen Daten nur so lange, wie es für den jeweiligen Zweck erforderlich ist oder eine gesetzliche Aufbewahrungspflicht
                besteht. Kontaktanfragen werden in der Regel nach Abschluss der Bearbeitung und Ablauf der gesetzlichen Aufbewahrungsfristen gelöscht, soweit keine
                weitergehenden rechtlichen Anforderungen bestehen.
            </p>

            <h2>9. Ihre Rechte</h2>
            <p>Sie haben gemäß der DSGVO folgende Rechte:</p>
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
                Wenn Sie eines dieser Rechte ausüben möchten, kontaktieren Sie uns bitte über die oben angegebene E-Mail-Adresse.
            </p>

            <h2>10. Kontakt zum Datenschutz</h2>
            <p>
                Bei Fragen zum Datenschutz oder zur Verarbeitung Ihrer personenbezogenen Daten können Sie sich gerne an uns wenden:
            </p>
            <p>
                <strong>MDC Facility &amp; Cleaning</strong><br>
                Kadir Kaya<br>
                Rosa-Kempf-Str. 23, 81248 München<br>
                E-Mail: <a href="mailto:Info@mdc-fm.de">Info@mdc-fm.de</a><br>
                Telefon: +49 89 38043537<br>
                Fax: +49 89 38043538
            </p>

            <div style="margin-top: var(--spacing-2xl); padding: var(--spacing-md); background-color: var(--bg-light); border-radius: var(--radius-md);">
                <p style="margin: 0; font-size: 0.875rem;">
                    <strong>Stand:</strong> 26.10.2026. Bei Änderungen unserer Leistungen oder der eingesetzten Technik passen wir diese Datenschutzerklärung an.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
