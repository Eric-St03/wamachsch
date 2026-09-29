<?php

header('Content-Type: text/plain; charset=utf-8');

$data = [];

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

$data['learnersByBirthplace'] = getCsvContent('lernende_nach_geburtsort.csv');
$data['learnersByCanton'] = getCsvContent('lernende_nach_kanton.csv');
$data['newApprenticeshipsByIndustry'] = getCsvContent('lehrstellen_neueintritte_nach_branche.csv');
$data['futureNewApprenticeships'] = getCsvContent('lehrstellen_neueintritte_zukunft.csv');
$data['populationByBirthplace'] = getCsvContent('bevoelkerungsentwicklung_nach_geburtsort.csv');
$data['futurePopulationByBirthplace'] = getCsvContent('bevoelkerung_zukunft_nach_geburtsort.csv');

return $data;