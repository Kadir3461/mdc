(function () {
    'use strict';

    var form = document.getElementById('configForm');
    if (!form) { return; }

    var step1 = document.getElementById('cfgStep1');
    var step2 = document.getElementById('cfgStep2');
    var stepLabel = document.getElementById('cfgStepLabel');
    var percent = document.getElementById('cfgPercent');
    var fill = document.getElementById('cfgProgressFill');
    var area = document.getElementById('area');
    var range = document.getElementById('areaRange');
    var summary = document.getElementById('cfgSummary');
    var err1 = document.getElementById('cfgStep1Error');
    var err2 = document.getElementById('cfgStep2Error');

    function checkedValue(name) {
        var el = form.querySelector('input[name="' + name + '"]:checked');
        return el ? el.value : '';
    }

    function showStep(n) {
        var isFirst = n === 1;
        step1.hidden = !isFirst;
        step2.hidden = isFirst;
        stepLabel.textContent = isFirst ? 'Schritt 1: Konfiguration' : 'Schritt 2: Kontaktdaten';
        var p = isFirst ? 40 : 80;
        percent.textContent = p + '%';
        fill.style.width = p + '%';
        if (!isFirst) { renderSummary(); }
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function renderSummary() {
        summary.textContent = '';
        var title = document.createElement('strong');
        title.textContent = 'Ihre Auswahl';
        summary.appendChild(title);
        var items = [
            ['Kategorie', checkedValue('service_type')],
            ['Objektgröße', area.value + ' m²'],
            ['Rhythmus', checkedValue('rhythm')]
        ];
        var ul = document.createElement('ul');
        items.forEach(function (it) {
            var li = document.createElement('li');
            li.textContent = it[0] + ': ' + it[1];
            ul.appendChild(li);
        });
        summary.appendChild(ul);
    }

    function showError(box, text) {
        box.textContent = text;
        box.hidden = false;
    }

    // Objektgröße: Zahlenfeld, Schieberegler und Schnellauswahl synchron halten
    function syncRangeFromInput() {
        var v = parseInt(area.value, 10);
        if (!isNaN(v)) {
            range.value = Math.min(Math.max(v, parseInt(range.min, 10)), parseInt(range.max, 10));
        }
    }
    area.addEventListener('input', syncRangeFromInput);
    range.addEventListener('input', function () { area.value = range.value; });
    form.querySelectorAll('.cfg-chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            area.value = chip.getAttribute('data-area');
            syncRangeFromInput();
        });
    });
    syncRangeFromInput();

    // Weiter / Zurück
    document.getElementById('cfgNext').addEventListener('click', function () {
        err1.hidden = true;
        var size = parseInt(area.value, 10);
        if (!checkedValue('service_type')) {
            return showError(err1, 'Bitte wählen Sie eine Reinigungskategorie.');
        }
        if (isNaN(size) || size < 1 || size > 1000000) {
            return showError(err1, 'Bitte geben Sie eine gültige Objektgröße in m² an.');
        }
        if (!checkedValue('rhythm')) {
            return showError(err1, 'Bitte wählen Sie einen gewünschten Rhythmus.');
        }
        area.value = size;
        showStep(2);
    });
    document.getElementById('cfgBack').addEventListener('click', function () { showStep(1); });

    // Validierung vor dem Absenden (der Versand erfolgt normal per POST)
    form.addEventListener('submit', function (e) {
        err2.hidden = true;
        var problems = [];
        var person = form.elements.contact_person;
        var email = form.elements.email;
        var phone = form.elements.phone;
        var privacy = form.elements.privacy;

        [person, email].forEach(function (f) { f.classList.remove('error'); });

        if (!person.value.trim()) { problems.push('Bitte geben Sie einen Ansprechpartner an.'); person.classList.add('error'); }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            problems.push('Bitte geben Sie eine gültige E-Mail-Adresse ein.');
            email.classList.add('error');
        }
        if (phone.value && !/^[0-9\s+\-()\/]+$/.test(phone.value)) {
            problems.push('Bitte geben Sie eine gültige Telefonnummer ein.');
        }
        if (!privacy.checked) { problems.push('Bitte akzeptieren Sie die Datenschutzerklärung.'); }

        if (problems.length) {
            e.preventDefault();
            showError(err2, problems.join(' '));
            return;
        }

        var btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Wird gesendet...';
    });

    // Nach einem Serverfehler direkt bei den Kontaktdaten starten
    if (form.getAttribute('data-start-step') === '2' && checkedValue('service_type') && checkedValue('rhythm')) {
        showStep(2);
    }
})();
