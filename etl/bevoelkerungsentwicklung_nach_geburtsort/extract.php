<?php
// 1. Datei zum Lesen öffnen
$handle = fopen('bevoelkerungsentwicklung_nach_geburtsort.csv', 'r');

// 2. Kopfzeile lesen und Leerzeichen entfernen ("Species " kommt echt so vor)
$header = array_map('trim', fgetcsv($handle, null, ',', '"', ''));

// 3. Zeile für Zeile lesen, bis die Datei zu Ende ist
$migration = [];
while (($row = fgetcsv($handle, null, ',', '"', '')) !== false) {
    if ($row[0] === '') {
        continue;   // leere Zeile überspringen
    }
    $migration[] = array_combine($header, $row);
}

$data = fclose($handle);

/*echo '<pre>';
print_r($migration);
echo '</pre>';*/

?>