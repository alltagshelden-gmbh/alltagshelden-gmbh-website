<?php
// Gemeinsames Grundgerüst: Kopf, Navigation, Fußzeile und Hilfsfunktionen.
date_default_timezone_set('Europe/Berlin');

function daten(): array
{
    static $d = null;
    return $d ??= require __DIR__ . '/daten.php';
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// Dateipfad mit Versionsnummer, damit nach einem Upload kein altes CSS/JS aus dem Cache kommt.
function asset(string $pfad): string
{
    $zeit = @filemtime(dirname(__DIR__) . '/' . $pfad);
    return $pfad . ($zeit ? '?v=' . $zeit : '');
}

function preis(int $euro): string
{
    return number_format($euro, 2, ',', '.') . ' €';
}

// Alle Kurse, deren letzter Tag noch nicht vorbei ist.
function kurse_aktuell(): array
{
    $heute = date('Y-m-d');
    return array_filter(daten()['kurse'], fn(array $t): bool => $t[count($t) - 1] >= $heute);
}

// Termine des nächsten Kurses, der noch nicht begonnen hat, sonst null.
function kurs_naechster(): ?array
{
    $heute = date('Y-m-d');
    foreach (daten()['kurse'] as $termine) {
        if ($termine[0] >= $heute) {
            return $termine;
        }
    }
    return null;
}

function datum(string $ymd): string
{
    return date('d.m.Y', strtotime($ymd));
}

// Beispiel: 07.12. · 08.12. · 18.12.2026
function termine_text(array $termine): string
{
    $teile = [];
    foreach ($termine as $i => $t) {
        $naechster = $termine[$i + 1] ?? null;
        $mitJahr = $naechster === null || substr($naechster, 0, 4) !== substr($t, 0, 4);
        $teile[] = date($mitJahr ? 'd.m.Y' : 'd.m.', strtotime($t));
    }
    return implode(' · ', $teile);
}

// Beispiel: 2026 / 2027 (leer, wenn keine Kurse mehr anstehen)
function kurs_jahre(string $trenner): string
{
    $jahre = [];
    foreach (kurse_aktuell() as $termine) {
        foreach ($termine as $t) {
            $jahre[substr($t, 0, 4)] = true;
        }
    }
    return implode($trenner, array_keys($jahre));
}

const ICON_TELEFON = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';

/*
 * Gibt alles bis einschließlich <main> aus.
 * Schlüssel: datei ('' = Startseite), titel, beschreibung, robots,
 *            og_titel, og_beschreibung, jsonld, preload
 */
function seite_start(array $s): void
{
    $d = daten();
    $k = $d['kontakt'];
    $datei = $s['datei'] ?? '';
    $start = $datei === '' ? '' : './';
    $url = $d['domain'] . $datei;
    $aktiv = fn(string $f): string => $f === $datei ? ' aria-current="page"' : '';
    ?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($s['titel']) ?></title>
<?php if (!empty($s['beschreibung'])): ?>
    <meta name="description" content="<?= e($s['beschreibung']) ?>">
<?php endif; ?>
    <meta name="robots" content="<?= e($s['robots'] ?? 'index, follow, max-image-preview:large') ?>">
    <link rel="canonical" href="<?= e($url) ?>">
    <meta name="theme-color" content="#f7fbfa">

<?php if (!empty($s['og_titel'])): ?>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="ALLTAGSHELDEN soziale Dienste GmbH">
    <meta property="og:title" content="<?= e($s['og_titel']) ?>">
<?php if (!empty($s['og_beschreibung'])): ?>
    <meta property="og:description" content="<?= e($s['og_beschreibung']) ?>">
<?php endif; ?>
    <meta property="og:url" content="<?= e($url) ?>">
    <meta property="og:image" content="<?= e($d['domain']) ?>img/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">

<?php endif; ?>
    <link rel="icon" href="favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="manifest" href="site.webmanifest">
<?php if (!empty($s['preload'])): ?>
    <link rel="preload" as="image" href="<?= e($s['preload']) ?>" type="image/avif">
<?php endif; ?>

    <link rel="stylesheet" href="<?= e(asset('style.css')) ?>">
    <script>document.documentElement.classList.add('js');</script>
    <script src="<?= e(asset('script.js')) ?>" defer></script>
<?php if (!empty($s['jsonld'])): ?>

    <script type="application/ld+json">
<?= $s['jsonld'] . "\n" ?>
    </script>
<?php endif; ?>
</head>

<body>
    <a class="skip-link" href="#inhalt">Zum Inhalt springen</a>

    <header class="site-header">
        <div class="wrap header-inner">
            <a href="./" class="brand" aria-label="ALLTAGSHELDEN – zur Startseite">
                <img src="img/logo.avif" alt="" width="272" height="238">
                <span class="brand-text">
                    <span class="brand-name">ALLTAGSHELDEN</span>
                    <span class="brand-sub">soziale Dienste GmbH</span>
                </span>
            </a>
            <button class="nav-toggle" aria-expanded="false" aria-controls="hauptmenue" aria-label="Menü öffnen">
                <span></span>
            </button>
            <nav class="main-nav" id="hauptmenue" aria-label="Hauptnavigation">
                <ul>
                    <li><a href="<?= $start ?>#leistungen">Leistungen</a></li>
                    <li><a href="<?= $start ?>#angebote">Angebote</a></li>
                    <li><a href="qualifizierungskurs.html"<?= $aktiv('qualifizierungskurs.html') ?>>Qualifizierungskurs</a></li>
                    <li><a href="<?= $start ?>#kontakt">Kontakt</a></li>
                    <li class="nav-call"><a href="<?= e($k['tel_link']) ?>">Anrufen: <?= e($k['tel']) ?></a></li>
                </ul>
            </nav>
            <a href="<?= e($k['tel_link']) ?>" class="btn btn-primary header-cta">
                <?= ICON_TELEFON . "\n" ?>
                <?= e($k['tel']) . "\n" ?>
            </a>
        </div>
    </header>

    <main id="inhalt">
<?php
}

// Gibt </main>, Fußzeile und Seitenende aus. $extra: HTML vor </body> (z. B. Dialog).
function seite_ende(string $extra = ''): void
{
    $k = daten()['kontakt'];
    ?>
    </main>

    <footer class="site-footer">
        <div class="wrap">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <img src="img/logo.avif" alt="" width="272" height="238" loading="lazy">
                        <div><strong>ALLTAGSHELDEN</strong><span>soziale Dienste GmbH</span></div>
                    </div>
                    <p>Entlastung und Unterstützung im Alltag – im Löwenberger Land und Umgebung.</p>
                </div>
                <div>
                    <h2>Angebote</h2>
                    <ul>
                        <li><a href="./#leistungen">Entlastungsleistungen</a></li>
                        <li><a href="qualifizierungskurs.html">Qualifizierungskurs</a></li>
                        <li><a href="eingliederungshilfe.html">Eingliederungshilfe</a></li>
                        <li><a href="https://alltagshelden-sanitaetshaus.de/" target="_blank" rel="noopener">Sanitätshaus</a></li>
                        <li><a href="https://www.erstehilfe-leichtgemacht.de/" target="_blank" rel="noopener">Erste Hilfe</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Kontakt</h2>
                    <address>
                        <ul>
                            <li><?= e($k['strasse']) ?><br><?= e($k['plz_ort']) ?></li>
                            <li><a href="<?= e($k['tel_link']) ?>"><?= e($k['tel']) ?></a></li>
                            <li><a href="mailto:<?= e($k['mail']) ?>"><?= e($k['mail']) ?></a></li>
                        </ul>
                    </address>
                </div>
                <div>
                    <h2>Rechtliches</h2>
                    <ul>
                        <li><a href="impressum.html">Impressum</a></li>
                        <li><a href="datenschutz.html">Datenschutz</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© <?= date('Y') ?> ALLTAGSHELDEN soziale Dienste GmbH</span>
                <span><?= e($k['strasse']) ?> · <?= e($k['plz_ort']) ?> <?= e($k['ortsteil']) ?></span>
            </div>
        </div>
    </footer>
<?= $extra . "\n" ?>
</body>

</html>
<?php
}
