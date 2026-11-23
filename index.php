<?php
require __DIR__ . '/includes/layout.php';
$k = daten()['kontakt'];
$p = daten()['preise'];
$kurs = kurs_naechster();

$jsonld = <<<JSON
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "LocalBusiness",
                "@id": "https://alltagsheldengmbh.de/#organisation",
                "name": "ALLTAGSHELDEN soziale Dienste GmbH",
                "alternateName": "Alltagshelden",
                "description": "Entlastungsleistungen nach § 45b SGB XI für Menschen mit Pflegegrad: Haushaltsunterstützung, Betreuung, Gartenpflege, Begleitservice und Transportservice. Außerdem Eingliederungshilfe und Qualifizierungskurse nach § 45a SGB XI.",
                "url": "https://alltagsheldengmbh.de/",
                "logo": "https://alltagsheldengmbh.de/img/android-chrome-512x512.png",
                "image": "https://alltagsheldengmbh.de/img/og-image.png",
                "telephone": "{$k['tel_schema']}",
                "email": "{$k['mail']}",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "Hauptstraße 79",
                    "postalCode": "16775",
                    "addressLocality": "Löwenberger Land OT Teschendorf",
                    "addressRegion": "Brandenburg",
                    "addressCountry": "DE"
                },
                "areaServed": "Löwenberger Land und Umgebung",
                "contactPoint": [
                    {
                        "@type": "ContactPoint",
                        "telephone": "{$k['tel_schema']}",
                        "contactType": "customer service",
                        "email": "{$k['mail']}",
                        "availableLanguage": "de"
                    }
                ],
                "makesOffer": [
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Haushaltsunterstützung" } },
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Betreuung" } },
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Gartenpflege" } },
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Begleitservice" } },
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Transportservice" } },
                    { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Eingliederungshilfe" } }
                ]
            },
            {
                "@type": "WebSite",
                "@id": "https://alltagsheldengmbh.de/#website",
                "url": "https://alltagsheldengmbh.de/",
                "name": "ALLTAGSHELDEN soziale Dienste GmbH",
                "inLanguage": "de-DE",
                "publisher": { "@id": "https://alltagsheldengmbh.de/#organisation" }
            }
        ]
    }
JSON;

$dialog = <<<'HTML'
    <!-- Pflegegrad-Flyer -->
    <dialog id="flyerDialog" class="flyer-dialog" aria-label="Flyer: Sie haben einen Pflegegrad?">
        <div class="dialog-body">
            <div class="dialog-tools">
                <a href="img/pflegegrad.jpg" download class="icon-btn" aria-label="Flyer herunterladen">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                </a>
                <button type="button" class="icon-btn" data-close aria-label="Schließen">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <img src="img/pflegegrad.jpg" alt="Flyer: Sie haben einen Pflegegrad? Wir kümmern uns! Entlastungsleistungen: Haushaltsunterstützung, Betreuung, Gartenpflege, Begleitservice, Transportservice. Abrechnung über alle Pflegekassen möglich." width="660" height="1600" loading="lazy">
        </div>
    </dialog>
HTML;

seite_start([
    'datei' => '',
    'titel' => 'Alltagshilfe & Entlastungsleistungen im Löwenberger Land | ALLTAGSHELDEN',
    'beschreibung' => 'ALLTAGSHELDEN soziale Dienste GmbH aus Teschendorf (Löwenberger Land): Haushaltshilfe, Betreuung, Begleit- und Transportservice für Menschen mit Pflegegrad – Abrechnung über alle Pflegekassen. Außerdem: Qualifizierungskurs nach § 45a SGB XI.',
    'og_titel' => 'ALLTAGSHELDEN – Alltagshilfe & Entlastungsleistungen im Löwenberger Land',
    'og_beschreibung' => 'Haushaltshilfe, Betreuung, Begleit- und Transportservice für Menschen mit Pflegegrad – Abrechnung über alle Pflegekassen.',
    'jsonld' => $jsonld,
    'preload' => 'img/logo.avif',
]);
?>

        <!-- HERO -->
        <section class="hero">
            <div class="wrap hero-grid">
                <div>
                    <span class="eyebrow"><span class="dot"></span>Teschendorf · Löwenberger Land</span>
                    <h1>Ihre <span class="accent">Alltagshelden</span> für mehr Leichtigkeit im Alltag</h1>
                    <p class="hero-lead">Haushaltshilfe, Betreuung, Begleit- und Transportservice für Menschen mit
                        Pflegegrad – persönlich, zuverlässig und aus der Region.</p>
                    <div class="hero-actions">
                        <a href="<?= e($k['tel_link']) ?>" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            Jetzt beraten lassen
                        </a>
                        <a href="#leistungen" class="btn btn-ghost">Unsere Leistungen</a>
                    </div>
                    <ul class="hero-trust">
                        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>Abrechnung über alle Pflegekassen</li>
                        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>Ab Pflegegrad 1</li>
                        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>Persönliche Ansprechpartner</li>
                    </ul>
                </div>
                <div class="hero-visual" aria-hidden="true">
                    <div class="hero-disc">
                        <img src="img/logo.avif" alt="" width="272" height="238">
                    </div>
                    <div class="float-chip chip-a">
                        <span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg></span>
                        <span>Alle Pflegekassen<small>Entlastungsbetrag § 45b</small></span>
                    </div>
                    <div class="float-chip chip-b">
                        <span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></span>
                        <span>Mit Herz dabei<small>aus der Region</small></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- LEISTUNGEN -->
        <section class="section section-alt" id="leistungen" aria-labelledby="leistungen-titel">
            <div class="wrap">
                <div class="section-head reveal">
                    <span class="kicker">Entlastungsleistungen</span>
                    <h2 id="leistungen-titel">Wir kümmern uns – damit Sie entlastet sind</h2>
                    <p>Als ALLTAGSHELDEN stehen wir an Ihrer Seite – von der Beratung bis zur Unterstützung vor Ort.</p>
                </div>

                <div class="services-layout">
                    <ul class="service-grid">
                        <li class="service reveal">
                            <div class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg></div>
                            <h3>Haushaltsunterstützung</h3>
                            <p>Hilfe bei Einkauf, Wäsche, Reinigung und allem, was im Haushalt anfällt.</p>
                        </li>
                        <li class="service reveal">
                            <div class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></div>
                            <h3>Betreuung</h3>
                            <p>Gesellschaft, Gespräche und gemeinsame Aktivitäten für mehr Lebensfreude.</p>
                        </li>
                        <li class="service reveal">
                            <div class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg></div>
                            <h3>Gartenpflege</h3>
                            <p>Rasen, Hecke und Beete – wir halten Ihren Garten in Schuss.</p>
                        </li>
                        <li class="service reveal">
                            <div class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                            <h3>Begleitservice</h3>
                            <p>Wir begleiten Sie zu Arztterminen, Behörden oder beim Spaziergang.</p>
                        </li>
                        <li class="service reveal">
                            <div class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg></div>
                            <h3>Transportservice</h3>
                            <p>Sicher und bequem ans Ziel – wir bringen Sie hin.</p>
                        </li>
                        <li class="service service-more reveal">
                            <h3>Etwas anderes?</h3>
                            <p>Sprechen Sie uns an – gemeinsam finden wir die passende Unterstützung.</p>
                            <p style="margin-top:0.75rem"><a href="#kontakt">Kontakt aufnehmen →</a></p>
                        </li>
                    </ul>

                    <aside class="info-panel reveal" aria-labelledby="pflegegrad-titel">
                        <span class="badge-stamp">Abrechnung über alle Pflegekassen</span>
                        <h3 id="pflegegrad-titel">Sie haben einen Pflegegrad?</h3>
                        <p>Pflegebedürftige mit Pflegegrad 1 bis 5, die zu Hause leben, haben Anspruch auf den
                            Entlastungsbetrag nach § 45b SGB XI. Wir beraten Sie gern, welche Unterstützung für Sie
                            infrage kommt.</p>
                        <div class="panel-actions">
                            <a href="<?= e($k['tel_link']) ?>" class="btn btn-gold">Jetzt beraten lassen</a>
                            <a href="img/pflegegrad.jpg" class="btn btn-outline-light" data-open-flyer>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                Flyer ansehen
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- ANGEBOTE -->
        <section class="section" id="angebote" aria-labelledby="angebote-titel">
            <div class="wrap">
                <div class="section-head reveal">
                    <span class="kicker">Mehr von uns</span>
                    <h2 id="angebote-titel">Unsere weiteren Angebote</h2>
                </div>

                <div class="offer-grid">
                    <a href="qualifizierungskurs.html" class="offer-card reveal">
                        <div class="card-top">
                            <div class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg></div>
                            <?php if ($kurs): ?><span class="tag highlight">Start: <?= datum($kurs[0]) ?></span><?php endif; ?>
                        </div>
                        <h3>Qualifizierungskurs Alltagsbegleitung</h3>
                        <p>Qualifizierung für alltagsunterstützende Angebote nach § 45a SGB XI – 30 Unterrichtseinheiten
                            als Live-Online-Seminar.</p>
                        <span class="card-link">Zum Kurs<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    </a>

                    <a href="eingliederungshilfe.html" class="offer-card reveal">
                        <div class="card-top">
                            <div class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/></svg></div>
                        </div>
                        <h3>Eingliederungshilfe</h3>
                        <p>Unterstützung für Menschen mit Behinderung – für mehr Teilhabe und Selbstbestimmung im
                            Alltag.</p>
                        <span class="card-link">Mehr erfahren<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    </a>

                    <a href="https://alltagshelden-sanitaetshaus.de/" class="offer-card reveal" target="_blank" rel="noopener">
                        <div class="card-top">
                            <div class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><path d="M12 8v8M8 12h8"/></svg></div>
                            <span class="tag">eigene Website</span>
                        </div>
                        <h3>Alltagshelden Sanitätshaus</h3>
                        <p>Hilfsmittel und Produkte rund um Gesundheit, Pflege und Alltag.</p>
                        <span class="card-link">Zum Sanitätshaus<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg></span>
                    </a>

                    <a href="https://www.erstehilfe-leichtgemacht.de/" class="offer-card reveal" target="_blank" rel="noopener">
                        <div class="card-top">
                            <div class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 11v4"/><path d="M14 13h-4"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M18 6v14"/><path d="M6 6v14"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg></div>
                            <span class="tag">eigene Website</span>
                        </div>
                        <h3>Erste Hilfe leicht gemacht!</h3>
                        <p>Erste-Hilfe-Kurse – praxisnah und verständlich erklärt.</p>
                        <span class="card-link">Zu den Kursen<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg></span>
                    </a>
                </div>
            </div>
        </section>

        <!-- KURS -->
        <section class="section" style="padding-top:0" aria-labelledby="kurs-titel">
            <div class="wrap">
                <div class="course-band reveal">
                    <div>
                        <span class="kicker">Qualifizierungskurs nach § 45a SGB XI</span>
                        <h2 id="kurs-titel">Werden Sie ein Alltagsheld!</h2>
                        <p class="lead">Unser Kurs bereitet Sie optimal auf die Arbeit in alltagsunterstützenden
                            Angeboten vor – entwickelt in Zusammenarbeit mit dem Landesamt für Soziales und Versorgung.</p>
                        <div class="hero-actions">
                            <a href="qualifizierungskurs.html" class="btn btn-primary">Alle Infos zum Kurs</a>
                            <a href="docs/Anmeldung_Qualifizierungskurs.pdf" class="btn btn-light" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                                Anmeldeformular
                            </a>
                        </div>
                    </div>
                    <ul class="course-facts">
                        <li>
                            <span class="fact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></span>
                            <span><strong>Nächster Termin</strong><?= $kurs ? termine_text($kurs) : 'Neue Termine folgen' ?></span>
                        </li>
                        <li>
                            <span class="fact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8M12 17v4"/></svg></span>
                            <span><strong>30 UE in 4 Modulen</strong>Live-Online-Seminar, 8:30 – 16:00 Uhr</span>
                        </li>
                        <li>
                            <span class="fact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg></span>
                            <span><strong>Ab <?= $p['gesamt'] ?> €</strong>oder <?= $p['modul'] ?> € je Einzelmodul</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- KONTAKT -->
        <section class="section section-alt" id="kontakt" aria-labelledby="kontakt-titel">
            <div class="wrap">
                <div class="section-head center reveal">
                    <span class="kicker">Kontakt</span>
                    <h2 id="kontakt-titel">Wir beraten Sie gern</h2>
                    <p>Rufen Sie uns an oder schreiben Sie uns – wir melden uns schnellstmöglich bei Ihnen.</p>
                </div>
                <div class="contact-grid">
                    <a href="<?= e($k['tel_link']) ?>" class="contact-card reveal">
                        <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                        <span class="label">Telefon</span>
                        <span class="value"><?= e($k['tel']) ?></span>
                    </a>
                    <a href="<?= e($k['mobil_link']) ?>" class="contact-card reveal">
                        <span class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="14" height="20" x="5" y="2" rx="2"/><path d="M12 18h.01"/></svg></span>
                        <span class="label">Mobil</span>
                        <span class="value"><?= e($k['mobil']) ?></span>
                    </a>
                    <a href="mailto:<?= e($k['mail']) ?>" class="contact-card reveal">
                        <span class="icon-badge"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></span>
                        <span class="label">E-Mail</span>
                        <span class="value"><?= e($k['mail']) ?></span>
                    </a>
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Hauptstra%C3%9Fe+79%2C+16775+L%C3%B6wenberger+Land" class="contact-card reveal" target="_blank" rel="noopener">
                        <span class="icon-badge gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg></span>
                        <span class="label">Adresse</span>
                        <span class="value"><?= e($k['strasse']) ?><br><?= e($k['plz_ort']) ?><br><?= e($k['ortsteil']) ?></span>
                    </a>
                </div>
            </div>
        </section>
<?php seite_ende($dialog);
