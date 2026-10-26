/**
 * Einwilligungsverwaltung (DSGVO / TDDDG)
 *
 * - Externe Inhalte werden ausschließlich nach aktiver Einwilligung geladen.
 * - Die Entscheidung wird in einem First-Party-Cookie gespeichert und ist jederzeit widerrufbar.
 * - Ohne Einwilligung findet keinerlei Verbindung zu Drittanbietern statt.
 */
(function () {
    'use strict';

    var COOKIE_NAME = 'mdc_consent';
    var VERSION = 1;
    var MAX_AGE_DAYS = 182; // ca. 6 Monate
    var CATEGORIES = ['karten'];

    function readConsent() {
        var match = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_NAME + '=([^;]*)'));
        if (!match) {
            return null;
        }
        try {
            var data = JSON.parse(decodeURIComponent(match[1]));
            if (!data || data.v !== VERSION) {
                return null;
            }
            return data;
        } catch (e) {
            return null;
        }
    }

    function writeConsent(state) {
        var data = { v: VERSION, ts: Date.now() };
        CATEGORIES.forEach(function (category) {
            data[category] = state[category] === true;
        });
        var value = encodeURIComponent(JSON.stringify(data));
        var secure = location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = COOKIE_NAME + '=' + value + '; Max-Age=' + (MAX_AGE_DAYS * 86400) +
            '; Path=/; SameSite=Lax' + secure;
        return data;
    }

    function deleteConsent() {
        var secure = location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = COOKIE_NAME + '=; Max-Age=0; Path=/; SameSite=Lax' + secure;
    }

    function hasConsent(category) {
        var data = readConsent();
        return !!(data && data[category] === true);
    }

    /** Platzhalter durch den echten externen Inhalt ersetzen. */
    function activateEmbed(embed) {
        if (embed.dataset.consentActive === '1') {
            return;
        }
        var template = embed.querySelector('.consent-embed-content');
        var placeholder = embed.querySelector('.consent-placeholder');
        if (!template) {
            return;
        }
        var content = template.content.cloneNode(true);
        if (placeholder) {
            placeholder.hidden = true;
        }
        embed.appendChild(content);
        embed.dataset.consentActive = '1';
    }

    /** Externen Inhalt wieder entfernen (nach Widerruf). */
    function deactivateEmbed(embed) {
        if (embed.dataset.consentActive !== '1') {
            return;
        }
        Array.prototype.slice.call(embed.querySelectorAll('iframe, script[data-consent-src]'))
            .forEach(function (node) { node.parentNode.removeChild(node); });
        var placeholder = embed.querySelector('.consent-placeholder');
        if (placeholder) {
            placeholder.hidden = false;
        }
        embed.dataset.consentActive = '0';
    }

    function syncEmbeds() {
        Array.prototype.slice.call(document.querySelectorAll('.consent-embed')).forEach(function (embed) {
            var category = embed.dataset.consentCategory;
            if (hasConsent(category)) {
                activateEmbed(embed);
            } else {
                deactivateEmbed(embed);
            }
        });
    }

    function setBannerVisible(visible) {
        var banner = document.getElementById('cookieConsent');
        if (!banner) {
            return;
        }
        banner.hidden = !visible;
        if (visible) {
            banner.setAttribute('aria-hidden', 'false');
        } else {
            banner.setAttribute('aria-hidden', 'true');
        }
    }

    function setDetailsVisible(visible) {
        var details = document.getElementById('cookieConsentDetails');
        var toggle = document.querySelector('[data-consent-action="settings"]');
        if (!details) {
            return;
        }
        details.hidden = !visible;
        if (toggle) {
            toggle.setAttribute('aria-expanded', visible ? 'true' : 'false');
        }
    }

    function applyAndClose(state) {
        writeConsent(state);
        syncEmbeds();
        setBannerVisible(false);
        setDetailsVisible(false);
    }

    function acceptAll() {
        var state = {};
        CATEGORIES.forEach(function (category) { state[category] = true; });
        applyAndClose(state);
    }

    function rejectAll() {
        var state = {};
        CATEGORIES.forEach(function (category) { state[category] = false; });
        applyAndClose(state);
    }

    function saveSelection() {
        var state = {};
        CATEGORIES.forEach(function (category) {
            var input = document.querySelector('[data-consent-option="' + category + '"]');
            state[category] = !!(input && input.checked);
        });
        applyAndClose(state);
    }

    function openSettings() {
        var data = readConsent() || {};
        CATEGORIES.forEach(function (category) {
            var input = document.querySelector('[data-consent-option="' + category + '"]');
            if (input) {
                input.checked = data[category] === true;
            }
        });
        setBannerVisible(true);
        setDetailsVisible(true);
        var banner = document.getElementById('cookieConsent');
        if (banner) {
            var focusable = banner.querySelector('button, input');
            if (focusable) { focusable.focus(); }
        }
    }

    function handleClick(event) {
        var acceptTarget = event.target.closest('[data-consent-accept]');
        if (acceptTarget) {
            event.preventDefault();
            var category = acceptTarget.dataset.consentAccept;
            var embed = acceptTarget.closest('.consent-embed');
            var remember = embed ? embed.querySelector('[data-consent-remember="' + category + '"]') : null;

            if (!remember || remember.checked) {
                var data = readConsent() || {};
                var state = {};
                CATEGORIES.forEach(function (cat) { state[cat] = data[cat] === true; });
                state[category] = true;
                writeConsent(state);
                syncEmbeds();
                setBannerVisible(false);
            } else if (embed) {
                // Nur für diesen Seitenaufruf laden, ohne Speicherung
                activateEmbed(embed);
            }
            return;
        }

        var actionTarget = event.target.closest('[data-consent-action]');
        if (!actionTarget) {
            return;
        }
        event.preventDefault();
        switch (actionTarget.dataset.consentAction) {
            case 'accept-all': acceptAll(); break;
            case 'reject-all': rejectAll(); break;
            case 'save': saveSelection(); break;
            case 'settings':
                setDetailsVisible(document.getElementById('cookieConsentDetails').hidden);
                break;
            case 'open': openSettings(); break;
            case 'revoke':
                deleteConsent();
                syncEmbeds();
                openSettings();
                break;
            default: break;
        }
    }

    function init() {
        document.addEventListener('click', handleClick);
        syncEmbeds();
        if (!readConsent()) {
            setBannerVisible(true);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Öffentliche Schnittstelle, z. B. für den Link "Cookie-Einstellungen"
    window.mdcConsent = {
        has: hasConsent,
        open: openSettings,
        acceptAll: acceptAll,
        rejectAll: rejectAll,
        revoke: function () { deleteConsent(); syncEmbeds(); }
    };
})();
