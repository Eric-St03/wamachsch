<?php

header('Content-type: application/json');

require_once __DIR__ . '/config.php';

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$sql = "SELECT city, year, hitzetage FROM hitzesommer WHERE 1=1";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$data =$stmt->fetchAll();

echo json_encode($data);