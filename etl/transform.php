<?php
header('Content-type: text/plain; charset=utf8');

// define main variables with extracted data
$data = include __DIR__ . '/extract.php';
$result = [];

// define each dataset as variable
$lernendeNachGeburtsort = $data['lernendeNachGeburtsort'];
$lernendeNachKanton = $data['lernendeNachKanton'];
$lehrstellenNeueintritteNachBranche = $data['lehrstellenNeueintritteNachBranche'];
$lehrstellenNeueintritteZukunft = $data['lehrstellenNeueintritteZukunft'];
$bevoelkerungNachGeburtsort = $data['bevoelkerungNachGeburtsort'];
$bevoelkerungZukunftNachGeburtsort = $data['bevoelkerungZukunftNachGeburtsort'];


// === Lernende nach Geburtsort ===


// === Lernende nach Kanton ===


// === Lehrstellen Neueintritte nach Branche ===


// === Lehrstellen Neueintritte in Zukunft ===


// === Bevölkerung nach Geburtsort ===
$bevoelkerungNachGeburtsortTabelle = array_slice($bevoelkerungNachGeburtsort, 0, 32);

$bevoelkerung = [];

foreach ($bevoelkerungNachGeburtsortTabelle as $zeile) {

    $jahr = $zeile["TIME_PERIOD"];
    $bevoelkerungsZahl = $zeile["OBS_VALUE"];

    if (!isset($bevoelkerung[$jahr])) {
        $bevoelkerung[$jahr] = 0;
    }

    $bevoelkerung[$jahr] += $bevoelkerungsZahl;
}

$schweizer = array_column(array_slice($bevoelkerungNachGeburtsort, 0, 16), "OBS_VALUE");
$auslaender = array_column(array_slice($bevoelkerungNachGeburtsort, 16, 16), "OBS_VALUE");

foreach ($bevoelkerung as $jahr => $bevoelkerungsZahl) {
    $result['bevoelkerungNachGeburtsort'] = [
        "jahr" => $jahr,
        "gesamtbevoelkerung" => $bevoelkerungsZahl,
        "schweizer" => $schweizer[$jahr - 2010],
        "auslaender" => $auslaender[$jahr - 2010],
    ];
}


// === Bevölkerung in Zukunft nach Geburtsort ===


print_r($result);
