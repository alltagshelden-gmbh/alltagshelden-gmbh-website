<?php
// Zentrale Daten: hier ändern, gilt auf allen Seiten.
return [
    'domain' => 'https://alltagsheldengmbh.de/',

    'kontakt' => [
        'tel'                 => '033094 / 70 24 94',
        'tel_link'            => 'tel:+4933094702494',
        'tel_schema'          => '+49 33094 702494',
        'mobil'               => '0155 / 60 49 89 10',
        'mobil_link'          => 'tel:+4915560498910',
        'mail'                => 'kontakt@alltagshelden-gmbh.de',
        'mail_bildung'        => 'bildung@alltagshelden-gmbh.de',
        'mail_einglied'       => 'eingliederung@alltagshelden-gmbh.de',
        'mobil_einglied'      => '01575 / 71 48 254',
        'mobil_einglied_link' => 'tel:+4915757148254',
        'strasse'             => 'Hauptstraße 79',
        'plz_ort'             => '16775 Löwenberger Land',
        'ortsteil'            => 'OT Teschendorf',
    ],

    // Preise in Euro
    'preise' => [
        'gesamt'            => 225,
        'gesamt_erstehilfe' => 275,
        'modul'             => 60,
    ],

    // Kurstermine, chronologisch, Format JJJJ-MM-TT. Schlüssel = Kursnummer laut Flyer.
    // Vergangene Kurse verschwinden automatisch, "Nächster Start" rückt automatisch weiter.
    'kurse' => [
        1 => ['2026-12-07', '2026-12-08', '2026-12-18'],
        2 => ['2027-03-02', '2027-03-10', '2027-03-18'],
        3 => ['2027-06-01', '2027-06-09', '2027-06-17'],
        4 => ['2027-11-02', '2027-11-10', '2027-11-18'],
    ],
];
