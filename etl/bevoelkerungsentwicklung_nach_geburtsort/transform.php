<?php
$migrationBoard = array_slice($migration, 0, 32);

$population = [];

foreach ($migrationBoard as $row) {

    $jahr = $row["TIME_PERIOD"];
    $bevoelkerung = $row["OBS_VALUE"];

    if (!isset($population[$jahr])) {
        $population[$jahr] = 0;
    }

    $population[$jahr] += $bevoelkerung;
}

$schweizer = array_column(array_slice($migration, 0, 16), "OBS_VALUE");
$auslaender = array_column(array_slice($migration, 16, 16), "OBS_VALUE");

$result = [];

foreach ($population as $jahr => $bevoelkerung) {
    $result[] = [
        "jahr" => $jahr,
        "gesamtbevoelkerung" => $bevoelkerung,
        "schweizer" => $schweizer[$jahr - 2010],
        "auslaender" => $auslaender[$jahr - 2010],
    ];
}

echo '<pre>';
print_r($result);
echo '</pre>';

?>