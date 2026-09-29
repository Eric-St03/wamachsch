<?php

header('Content-Type: text/plain; charset=utf-8');


// function to get the csv content from a defined file
function getCsvContent($filename, $separator = ','): array
{
    $handle = fopen('data/' . $filename, 'r');

    $header = array_map('trim', fgetcsv($handle, null, $separator, '"', ''));

    $extractedData = [];
    while (($row = fgetcsv($handle, null, $separator, '"', '')) !== false) {
        if ($row[0] === '') {
            continue;
        }
        $extractedData[] = array_combine($header, $row);
    }
    fclose($handle);
    return $extractedData;
}

$lernendeNachGeburtsort = getCsvContent('lernende_nach_geburtsort.csv');
$lernendeNachKanton = getCsvContent('lernende_nach_kanton.csv');
$lehrstellenNeueintritteNachBranche = getCsvContent('lehrstellen_neueintritte_nach_branche.csv');
$lehrstellenNeueintritteZukunft = getCsvContent('lehrstellen_neueintritte_zukunft.csv');
$bevoelkerungNachGeburtsort = getCsvContent('bevoelkerungsentwicklung_nach_geburtsort.csv');
$bevoelkerungZukunftNachGeburtsort = getCsvContent('bevoelkerung_zukunft_nach_geburtsort.csv');

var_dump($lernendeNachGeburtsort);