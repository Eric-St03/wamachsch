<?php

echo "Hallo Welt";

$data = include __DIR__ . '/transform.php';

/*print_r($data);*/

/*require_once __DIR__ . '/config.php';*/

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    echo 'Verbindung zur Datenbank erfolgreich hergestellt </br>';
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

//Population By Birthplace
$sql = "INSERT INTO populationByBirthplace (year, total, swiss, foreign) VALUES (:year, :total, :swiss, :foreign)/* ON DUPLICATE KEY UPDATE hitzetage = VALUES(hitzetage)*/";

$stmt = $pdo->prepare($sql);

foreach ($result as $row) {
    $stmt->execute($row);
}

echo "Datensatz populationByBirthplace erfolgreich in DB eingefügt. </br>";

//Future Population By Birthplace
$sql = "INSERT INTO populationByBirthplace (year, total_reference_scenario, total_high_scenario, total_low_scenario, swiss_reference_scenario, swiss_high_scenario, swiss_low_scenario, foreign_reference_scenario, foreign_high_scenario, foreign_low_scenario) VALUES (:year, :total_reference_scenario, :total_high_scenario, :total_low_scenario, :swiss_reference_scenario, :swiss_high_scenario, :swiss_low_scenario, :foreign_reference_scenario, :foreign_high_scenario, :foreign_low_scenario)/* ON DUPLICATE KEY UPDATE hitzetage = VALUES(hitzetage)*/";

$stmt = $pdo->prepare($sql);

foreach ($result as $row) {
    $stmt->execute($row);
}

echo "Datensatz futurePoulationByBirthplace erfolgreich in DB eingefügt. </br>";