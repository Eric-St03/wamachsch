<?php
header('Content-type: text/plain; charset=utf8');

// Define main variables with extracted data
$data = include __DIR__ . '/extract.php';
$result = [];

// Define each dataset as a variable
$learnersByBirthplace = $data['learnersByBirthplace'];
$learnersByCanton = $data['learnersByCanton'];
$newApprenticeshipsByIndustry = $data['newApprenticeshipsByIndustry'];
$futureNewApprenticeships = $data['futureNewApprenticeships'];
$populationByBirthplace = $data['populationByBirthplace'];
$futurePopulationByBirthplace = $data['futurePopulationByBirthplace'];


// === Learners by birthplace ===


// === Learners by canton ===


// === New apprenticeships by industry ===


// === Future new apprenticeships ===


// === Population by birthplace ===
$populationByBirthplaceTable = array_slice($populationByBirthplace, 0, 32);

$population = [];

foreach ($populationByBirthplaceTable as $row) {
    $year = $row['TIME_PERIOD'];
    $populationCount = $row['OBS_VALUE'];

    if (!isset($population[$year])) {
        $population[$year] = 0;
    }

    $population[$year] += $populationCount;
}

$swissPopulation = array_column(
    array_slice($populationByBirthplace, 0, 16),
    'OBS_VALUE'
);

$foreignPopulation = array_column(
    array_slice($populationByBirthplace, 16, 16),
    'OBS_VALUE'
);

$result['populationByBirthplace'] = [
    'year' => $year,
    'totalPopulation' => $populationCount,
    'swiss' => $swissPopulation[$year - 2010],
    'foreign' => $foreignPopulation[$year - 2010],
];



// === Future population by birthplace ===


print_r($result);
