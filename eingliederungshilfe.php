<?php
require __DIR__ . '/includes/layout.php';
$k = daten()['kontakt'];

$jsonld = <<<'JSON'
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Startseite", "item": "https://alltagsheldengmbh.de/" },
            { "@type": "ListItem", "position": 2, "name": "Eingliederungshilfe", "item": "https://alltagsheldengmbh.de/eingliederungshilfe.html" }
        ]
    }
JSON;

seite_start([
    'datei' => 'eingliederungshilfe.html',
    'titel' => 'Eingliederungshilfe im Löwenberger Land | ALLTAGSHELDEN',
    'beschreibung' => 'Eingliederungshilfe der ALLTAGSHELDEN soziale Dienste GmbH in Teschendorf (Löwenberger Land). Kontakt: ' . $k['tel'] . ' oder ' . $k['mail_einglied'] . '.',
    // Platzhalterseite: 'robots' entfernen und in sitemap.xml eintragen, sobald Inhalte da sind.
    'robots' => 'noindex, follow',
    'og_titel' => 'Eingliederungshilfe | ALLTAGSHELDEN',
    'jsonld' => $jsonld,
]);
?>
        <section class="page-hero">
            <div class="wrap">
                <ol class="breadcrumb">
                    <li><a href="./">Startseite</a></li>
                    <li aria-current="page">Eingliederungshilfe</li>
                </ol>
                <h1>Eingliederungshilfe</h1>
                <p class="hero-lead">Dieser Bereich befindet sich derzeit im Aufbau. Wir arbeiten daran, Ihnen bald
                    ausführliche Informationen zu unseren Leistungen im Bereich Eingliederungshilfe bereitzustellen.
                    Bis dahin sind wir gern persönlich für Sie da.</p>
            </div>
        </section>

        <section class="section" style="padding-top:0" aria-labelledby="kontakt-titel">
            <div class="wrap">
                <h2 id="kontakt-titel" class="sr-only">Kontakt Eingliederungshilfe</h2>
                <div class="contact-grid">
                    <a href="<?= e($k['tel_link']) ?>" class="contact-card reveal">
                        <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                        <span class="label">Telefon</span>
                        <span class="value"><?= e($k['tel']) ?></span>
                    </a>
                    <a href="<?= e($k['mobil_einglied_link']) ?>" class="contact-card reveal">
                        <span class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="14" height="20" x="5" y="2" rx="2"/><path d="M12 18h.01"/></svg></span>
                        <span class="label">Mobil</span>
                        <span class="value"><?= e($k['mobil_einglied']) ?></span>
                    </a>
                    <a href="mailto:<?= e($k['mail_einglied']) ?>" class="contact-card reveal">
                        <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></span>
                        <span class="label">E-Mail</span>
                        <span class="value"><?= e($k['mail_einglied']) ?></span>
                    </a>
                    <div class="contact-card reveal">
                        <span class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg></span>
                        <span class="label">Postanschrift</span>
                        <span class="value"><?= e($k['strasse']) ?><br><?= e($k['plz_ort']) ?><br><?= e($k['ortsteil']) ?></span>
                    </div>
                </div>
            </div>
        </section>
<?php seite_ende();
