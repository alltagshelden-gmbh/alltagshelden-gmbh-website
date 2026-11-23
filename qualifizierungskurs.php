<?php
require __DIR__ . '/includes/layout.php';
$k = daten()['kontakt'];
$p = daten()['preise'];
$kurs = kurs_naechster();
$jahre = kurs_jahre('/');
$termine_ab = ($jahre !== '' ? "Termine $jahre, ab " : 'Ab ') . $p['gesamt'];
$termine_og = $jahre !== '' ? "Termine $jahre – " : '';

// Für Google: 30 UE à 45 Minuten = 22,5 Stunden je Kurs
$instanzen = json_encode(array_map(fn(array $t): array => [
    '@type' => 'CourseInstance',
    'courseMode' => 'Online',
    'startDate' => $t[0],
    'endDate' => $t[count($t) - 1],
    'courseWorkload' => 'PT22H30M',
], array_values(kurse_aktuell())), JSON_UNESCAPED_SLASHES);

$jsonld = <<<JSON
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Course",
                "@id": "https://alltagsheldengmbh.de/qualifizierungskurs.html#kurs",
                "name": "Qualifizierungskurs in alltagsunterstützenden Angeboten nach § 45a SGB XI",
                "alternateName": "Qualifizierungskurs Alltagsbegleitung",
                "description": "Qualifizierungskurs mit 30 Unterrichtseinheiten in vier Modulen für die Arbeit in alltagsunterstützenden Angeboten nach § 45a SGB XI. Live-Online-Seminar, optional ergänzt durch einen Erste-Hilfe-Kurs (9 UE, Präsenz).",
                "url": "https://alltagsheldengmbh.de/qualifizierungskurs.html",
                "inLanguage": "de",
                "educationalCredentialAwarded": "Teilnahmebescheinigung nach § 45a SGB XI",
                "provider": {
                    "@type": "Organization",
                    "@id": "https://alltagsheldengmbh.de/#organisation",
                    "name": "ALLTAGSHELDEN soziale Dienste GmbH",
                    "url": "https://alltagsheldengmbh.de/"
                },
                "offers": [
                    { "@type": "Offer", "category": "Paid", "price": "{$p['gesamt']}.00", "priceCurrency": "EUR", "description": "Gesamtkurs ohne Erste-Hilfe-Kurs" },
                    { "@type": "Offer", "category": "Paid", "price": "{$p['gesamt_erstehilfe']}.00", "priceCurrency": "EUR", "description": "Gesamtkurs inklusive Erste-Hilfe-Kurs" },
                    { "@type": "Offer", "category": "Paid", "price": "{$p['modul']}.00", "priceCurrency": "EUR", "description": "Einzelmodul" }
                ],
                "hasCourseInstance": $instanzen
            },
            {
                "@type": "BreadcrumbList",
                "itemListElement": [
                    { "@type": "ListItem", "position": 1, "name": "Startseite", "item": "https://alltagsheldengmbh.de/" },
                    { "@type": "ListItem", "position": 2, "name": "Qualifizierungskurs", "item": "https://alltagsheldengmbh.de/qualifizierungskurs.html" }
                ]
            }
        ]
    }
JSON;

seite_start([
    'datei' => 'qualifizierungskurs.html',
    'titel' => 'Qualifizierungskurs Alltagsbegleitung nach § 45a SGB XI | ALLTAGSHELDEN',
    'beschreibung' => 'Qualifizierungskurs in alltagsunterstützenden Angeboten nach § 45a SGB XI: 30 UE in 4 Modulen als Live-Online-Seminar. ' . $termine_ab . ' €. Flyer und Anmeldeformular zum Download.',
    'og_titel' => 'Qualifizierungskurs Alltagsbegleitung nach § 45a SGB XI',
    'og_beschreibung' => '30 UE in 4 Modulen, live online. ' . $termine_og . 'jetzt anmelden und Alltagsheld werden!',
    'jsonld' => $jsonld,
]);
?>
        <section class="page-hero">
            <div class="wrap">
                <ol class="breadcrumb">
                    <li><a href="./">Startseite</a></li>
                    <li aria-current="page">Qualifizierungskurs</li>
                </ol>
                <span class="eyebrow"><span class="dot"></span><?= $kurs ? 'Nächster Start: ' . datum($kurs[0]) : 'Neue Termine folgen' ?></span>
                <h1>Qualifizierungskurs – Alltagsbegleitung nach § 45a SGB XI</h1>
                <p class="hero-lead"><strong>Werden Sie ein Alltagsheld!</strong> Unterstützen Sie Menschen in ihrem
                    täglichen Leben und machen Sie den Unterschied. Unser Kurs bereitet Sie optimal auf die Aufgaben und
                    Herausforderungen in der Alltagsunterstützung vor.</p>
                <div class="hero-actions">
                    <a href="docs/Anmeldung_Qualifizierungskurs.pdf" class="btn btn-primary" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                        Anmeldeformular (PDF)
                    </a>
                    <a href="docs/Flyer_Qualifizierungskurs_2026_2027.pdf" class="btn btn-ghost" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                        Flyer (PDF)
                    </a>
                </div>
            </div>
        </section>

        <section class="wrap" aria-label="Kurs auf einen Blick">
            <div class="fact-row">
                <div class="fact reveal"><span class="num">30 UE</span><span class="txt">in 4 Modulen</span></div>
                <div class="fact reveal"><span class="num">Online</span><span class="txt">Live-Webinar, 8:30 – 16:00 Uhr</span></div>
                <div class="fact reveal"><span class="num">ab <?= $p['gesamt'] ?> €</span><span class="txt">oder <?= $p['modul'] ?> € je Einzelmodul</span></div>
                <div class="fact reveal"><span class="num">§ 45a</span><span class="txt">offizielle Teilnahmebescheinigung</span></div>
            </div>
        </section>

        <section class="section">
            <div class="wrap stack">
                <div class="two-col">
                    <div class="card reveal">
                        <h2>Für wen ist der Kurs?</h2>
                        <ul class="check-list">
                            <li><strong>(Zukünftige) Mitarbeitende</strong> von alltagsunterstützenden Dienstleistern,
                                die sich auf ihre Aufgabe vorbereiten möchten.</li>
                            <li><strong>Interessierte</strong>, die sich in das Feld der alltagsunterstützenden
                                Dienstleistungen einarbeiten möchten.</li>
                            <li><strong>Pflegedienste</strong>, die Entlastungsleistungen anbieten und ihre Mitarbeitenden
                                gezielt schulen möchten.</li>
                            <li><strong>Pflegende Angehörige</strong>, die ihr Wissen für die häusliche Pflege erweitern
                                möchten.</li>
                        </ul>
                    </div>
                    <div class="card reveal">
                        <h2>Ihre Vorteile</h2>
                        <ul class="check-list">
                            <li><strong>Praxisnah:</strong> Fallbeispiele, Rollenspiele und Gruppenarbeiten – damit Sie
                                Situationen sicher und professionell meistern.</li>
                            <li><strong>Flexibel:</strong> Dank des modularen Aufbaus gehen wir auf Ihre Vorkenntnisse
                                ein. Verpasste Inhalte können individuell nachgeholt werden.</li>
                            <li><strong>Zukunftssicher:</strong> Unsere Dozenten orientieren sich an den aktuellen
                                gesetzlichen Anforderungen.</li>
                            <li><strong>Fundiert:</strong> Lehrplan entwickelt mit dem Landesamt für Soziales und
                                Versorgung, orientiert an den Empfehlungen der FAPIQ Brandenburg.</li>
                        </ul>
                    </div>
                </div>

                <div class="reveal" style="margin-top:2rem">
                    <span class="kicker">Kursinhalte</span>
                    <h2 style="margin-bottom:1.5rem">Die vier Module</h2>
                    <ul class="module-grid">
                        <li class="module">
                            <span class="mod-no">Modul 1</span>
                            <h3>Alltagsunterstützung und Betreuung: Praxis, Recht und Notfallkompetenz</h3>
                            <p>Praxisnahes Wissen zu alltagsunterstützenden Angeboten, rechtlichen Grundlagen und Erster
                                Hilfe für die Betreuung pflegebedürftiger Menschen.</p>
                            <span class="ue">7 UE</span>
                        </li>
                        <li class="module">
                            <span class="mod-no">Modul 2</span>
                            <h3>Altern verstehen und begleiten: Gesundheit, Betreuung, Unterstützung</h3>
                            <p>Wissen über Altern, Erkrankungen und Betreuung zur ganzheitlichen Unterstützung älterer
                                Menschen.</p>
                            <span class="ue">8 UE</span>
                        </li>
                        <li class="module">
                            <span class="mod-no">Modul 3</span>
                            <h3>Professionelle Kommunikation und Biographiearbeit in der Betreuung</h3>
                            <p>Kommunikations- und Beziehungskompetenzen sowie Methoden der Biographiearbeit für eine
                                wertschätzende, individuelle Betreuung.</p>
                            <span class="ue">7 UE</span>
                        </li>
                        <li class="module">
                            <span class="mod-no">Modul 4</span>
                            <h3>Alltagsorientierte Begleitung und individuelle Förderung</h3>
                            <p>Alltags- und personenorientierte Begleitung, individuelle Förderung und Gruppenarbeit, um
                                die Lebensqualität pflegebedürftiger Menschen zu steigern.</p>
                            <span class="ue">8 UE</span>
                        </li>
                    </ul>
                    <p class="note">Optional kann als 5. Modul ein Erste-Hilfe-Kurs (9 UE) absolviert werden. Da er
                        Praxisübungen beinhaltet, findet er ausschließlich in Präsenz statt.</p>
                </div>

                <div class="two-col" style="margin-top:2rem">
                    <div class="card reveal">
                        <h2>Termine <?= kurs_jahre(' / ') ?></h2>
<?php if (!kurse_aktuell()): ?>
                        <p>Neue Termine folgen.</p>
<?php endif; ?>
                        <ul class="date-list">
<?php foreach (kurse_aktuell() as $nr => $termine): ?>
                            <li><span class="no"><?= $nr ?></span><span class="dates"><?= termine_text($termine) ?><small>jeweils 8:30 – 16:00 Uhr, online</small></span></li>
<?php endforeach; ?>
                        </ul>
                        <p class="note">Alle Module werden auf die 3 Termine pro Schulung verteilt. Melden Sie sich
                            frühzeitig an – die Plätze sind begrenzt!</p>
                    </div>
                    <div class="card reveal">
                        <h2>Kurskosten</h2>
                        <ul class="price-list">
                            <li><span>Gesamtkurs</span><strong><?= preis($p['gesamt']) ?></strong></li>
                            <li><span>Gesamtkurs inkl. Erste-Hilfe-Kurs*</span><strong><?= preis($p['gesamt_erstehilfe']) ?></strong></li>
                            <li><span>Einzelmodul</span><strong><?= preis($p['modul']) ?></strong></li>
                        </ul>
                        <p class="note">Preise pro Person. *Gerne prüfen wir eine mögliche Kostenübernahme des
                            Erste-Hilfe-Kurses durch die Berufsgenossenschaft.</p>
                        <p class="note">Nach erfolgreichem Abschluss aller Module erhalten Sie eine offizielle
                            Teilnahmebescheinigung gemäß § 45a SGB XI und § 5 Abs. 3 NBEA-Anerkennungsverordnung.</p>
                    </div>
                </div>

                <div class="card reveal" id="anmeldung" style="margin-top:2rem">
                    <h2>So melden Sie sich an</h2>
                    <ol class="steps">
                        <li>Laden Sie das <a href="docs/Anmeldung_Qualifizierungskurs.pdf" target="_blank" rel="noopener">Anmeldeformular</a>
                            herunter oder kontaktieren Sie uns unter <a href="<?= e($k['tel_link']) ?>"><?= e($k['tel']) ?></a>
                            bzw. <a href="mailto:<?= e($k['mail_bildung']) ?>"><?= e($k['mail_bildung']) ?></a>.</li>
                        <li>Füllen Sie das Formular aus und senden Sie es uns per E-Mail oder Post.</li>
                        <li>Nach Eingang Ihrer Anmeldung erhalten Sie eine Bestätigung sowie alle weiteren
                            Informationen zum Kursablauf.</li>
                    </ol>
                    <div class="download-row">
                        <a href="docs/Anmeldung_Qualifizierungskurs.pdf" class="btn btn-primary" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                            Anmeldeformular (PDF)
                        </a>
                        <a href="docs/Flyer_Qualifizierungskurs_2026_2027.pdf" class="btn btn-gold" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                            Flyer (PDF)
                        </a>
                        <a href="mailto:<?= e($k['mail_bildung']) ?>" class="btn btn-ghost">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <?= e($k['mail_bildung']) ?>
                        </a>
                    </div>
                    <p class="note">Bei Absage 21 Tage vor Seminarbeginn wird die Hälfte der Teilnehmergebühr in
                        Rechnung gestellt, bei Absage 14 Tage vor Seminarbeginn der volle Betrag.</p>
                </div>
            </div>
        </section>
<?php seite_ende();
