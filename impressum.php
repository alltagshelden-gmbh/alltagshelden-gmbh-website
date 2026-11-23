<?php
require __DIR__ . '/includes/layout.php';
$k = daten()['kontakt'];

seite_start([
    'datei' => 'impressum.html',
    'titel' => 'Impressum | ALLTAGSHELDEN soziale Dienste GmbH',
    'robots' => 'noindex, follow',
]);
?>
        <section class="page-hero">
            <div class="wrap">
                <ol class="breadcrumb">
                    <li><a href="./">Startseite</a></li>
                    <li aria-current="page">Impressum</li>
                </ol>
                <h1>Impressum</h1>
            </div>
        </section>

        <section class="section" style="padding-top:0">
            <div class="wrap">
                <div class="card legal">
                    <dl>
                        <dt>Firma</dt>
                        <dd>ALLTAGSHELDEN soziale Dienste GmbH</dd>
                        <dt>Geschäftsführer</dt>
                        <dd>Dirk Schwedt</dd>
                        <dt>Adresse</dt>
                        <dd><?= e($k['strasse']) ?><br><?= e($k['plz_ort']) ?><br><?= e($k['ortsteil']) ?></dd>
                        <dt>Telefon</dt>
                        <dd><a href="<?= e($k['tel_link']) ?>"><?= e($k['tel']) ?></a></dd>
                        <dt>Mobil</dt>
                        <dd><a href="<?= e($k['mobil_link']) ?>"><?= e($k['mobil']) ?></a></dd>
                        <dt>E-Mail</dt>
                        <dd><a href="mailto:<?= e($k['mail']) ?>"><?= e($k['mail']) ?></a></dd>
                        <dt>Registergericht</dt>
                        <dd>Amtsgericht Neuruppin</dd>
                        <dt>Registernummer</dt>
                        <dd>HRB 14979</dd>
                    </dl>
                    <p class="note" style="margin-top:2rem">Diese Website dient Informationszwecken. Angaben ohne Gewähr.</p>
                </div>
            </div>
        </section>
<?php seite_ende();
