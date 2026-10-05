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

// === Learners ===

// = Learners by birthplace =

function normalizeYear($year) {
    return substr($year ,0,2) . substr($year ,5);
}

$vocationalTrainingsByBirthplace = [];
$generalEducationTrainingsByBirthplace = [];

foreach ($learnersByBirthplace as $learner) {

    $year = normalizeYear($learner['Jahr']);
    if ($learner['Bildungsstufe und Bildungstyp'] == "Berufliche Grundbildung") {
        $vocationalTrainingsByBirthplace[$year] = [
            'year' => $year,
            'total' => $learner['Staatsangehörigkeit - Total'],
            'swiss' => $learner['Schweiz'],
            'foreign' => $learner['Ausland']
        ];
    } elseif ($learner['Bildungsstufe und Bildungstyp'] == "Allgemeinbildende Ausbildungen") {
        $generalEducationTrainingsByBirthplace[$year] = [
            'year' => $year,
            'total' => $learner['Staatsangehörigkeit - Total'],
            'swiss' => $learner['Schweiz'],
            'foreign' => $learner['Ausland']
        ];
    }
}


// = Learners by canton =

$vocationalTrainingsByCanton = [];
$generalEducationTrainingsByCanton = [];

foreach ($learnersByCanton as $learner) {

    $year = normalizeYear($learner['Jahr']);
    if ($learner['Bildungsstufe und Bildungstyp'] == "Berufliche Grundbildung") {
        $vocationalTrainingsByCanton[$year] = [
            'total' => $learner['Schweiz'],
            'zurich' => $learner['Zürich'],
            'bern' => $learner['Bern / Berne'],
            'uri' => $learner['Uri'],
            'schwyz' => $learner['Schwyz'],
            'obwalden' => $learner['Obwalden'],
            'nidwalden' => $learner['Nidwalden'],
            'glarus' => $learner['Glarus'],
            'zug' => $learner['Zug'],
            'fribourg' => $learner['Fribourg / Freiburg'],
            'solothurn' => $learner['Solothurn'],
            'basel_stadt' => $learner['Basel-Stadt'],
            'basel_landschaft' => $learner['Basel-Landschaft'],
            'schaffhausen' => $learner['Schaffhausen'],
            'appenzell_ausserrhoden' => $learner['Appenzell Ausserrhoden'],
            'appenzell_innerrhoden' => $learner['Appenzell Innerrhoden'],
            'st_gallen' => $learner['St. Gallen'],
            'grisons' => $learner['Graubünden / Grigioni / Grischun'],
            'aargau' => $learner['Aargau'],
            'thurgau' => $learner['Thurgau'],
            'ticino' => $learner['Ticino'],
            'vaud' => $learner['Vaud'],
            'valais' => $learner['Valais / Wallis'],
            'neuchatel' => $learner['Neuchâtel'],
            'geneva' => $learner['Genève'],
            'jura' => $learner['Jura']
        ];
    } elseif ($learner['Bildungsstufe und Bildungstyp'] == "Allgemeinbildende Ausbildungen") {
        $generalEducationTrainingsByCanton[$year] = [
            'total' => $learner['Schweiz'],
            'zurich' => $learner['Zürich'],
            'bern' => $learner['Bern / Berne'],
            'uri' => $learner['Uri'],
            'schwyz' => $learner['Schwyz'],
            'obwalden' => $learner['Obwalden'],
            'nidwalden' => $learner['Nidwalden'],
            'glarus' => $learner['Glarus'],
            'zug' => $learner['Zug'],
            'fribourg' => $learner['Fribourg / Freiburg'],
            'solothurn' => $learner['Solothurn'],
            'basel_stadt' => $learner['Basel-Stadt'],
            'basel_landschaft' => $learner['Basel-Landschaft'],
            'schaffhausen' => $learner['Schaffhausen'],
            'appenzell_ausserrhoden' => $learner['Appenzell Ausserrhoden'],
            'appenzell_innerrhoden' => $learner['Appenzell Innerrhoden'],
            'st_gallen' => $learner['St. Gallen'],
            'grisons' => $learner['Graubünden / Grigioni / Grischun'],
            'aargau' => $learner['Aargau'],
            'thurgau' => $learner['Thurgau'],
            'ticino' => $learner['Ticino'],
            'vaud' => $learner['Vaud'],
            'valais' => $learner['Valais / Wallis'],
            'neuchatel' => $learner['Neuchâtel'],
            'geneva' => $learner['Genève'],
            'jura' => $learner['Jura']
        ];
    }
}



foreach ($vocationalTrainingsByBirthplace as $vocationalTraining) {
    $year = $vocationalTraining['year'];
    if (isset($vocationalTrainingsByCanton[$year]) && $vocationalTrainingsByCanton[$year]["total"] == $vocationalTraining["total"]) {
        $result['vocationalTrainings'][$year] = array_merge($vocationalTraining, $vocationalTrainingsByCanton[$year]);
    }
}

foreach ($generalEducationTrainingsByBirthplace as $generalEducationTraining) {
    $year = $generalEducationTraining['year'];
    if (isset($generalEducationTrainingsByCanton[$year]) && $generalEducationTrainingsByCanton[$year]["total"] == $generalEducationTraining["total"]) {
        $result['generalEducationTrainings'][$year] = array_merge($generalEducationTraining, $generalEducationTrainingsByCanton[$year]);
    }
}

// === New apprenticeships by industry ===
foreach ($newApprenticeshipsByIndustry as $newApprenticeship) {

    $year = $newApprenticeship['Jahr'];

    $result['newApprenticeshipsByIndustry'][$year] = [
        'year' => $year,
        'total' => $newApprenticeship['Ausbildungsfeld - Total'],
        'office_work' => $newApprenticeship['Sekretariats- und Büroarbeit'],
        'materials' => $newApprenticeship['Werkstoffe (Glas, Papier, Kunststoff und Holz)'],
        'construction' => $newApprenticeship['Baugewerbe, Hoch- und Tiefbau'],
        'social_work' => $newApprenticeship['Sozialarbeit und Beratung']
    ];
}

// === Future new apprenticeships ===
foreach ($futureNewApprenticeships as $futureNewApprenticeship) {

    $year = $futureNewApprenticeship['Jahr'];

    $result['futureNewApprenticeships'][$year] = [
        'year' => $year,
        'reference_scenario' => $futureNewApprenticeship["Referenzszenario EFZ"] + $futureNewApprenticeship["Referenzszenario EBA"],
        'high_scenario' => $futureNewApprenticeship["Szenario 'hoch' EFZ"] + $futureNewApprenticeship["Szenario 'hoch' EBA"],
        'low_Scenario' => $futureNewApprenticeship["Szenario 'tief' EFZ"] + $futureNewApprenticeship["Szenario 'tief' EBA"]
    ];
}

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

$swissPopulation = array_column(array_slice($populationByBirthplace, 0, 16), 'OBS_VALUE');
$foreignPopulation = array_column(array_slice($populationByBirthplace, 16, 16), 'OBS_VALUE');

foreach ($population as $year => $populationCount) {
    $result['populationByBirthplace'][$year] = [
        'year' => $year,
        'total' => $populationCount,
        'swiss' => $swissPopulation[$year - 2010],
        'foreign' => $foreignPopulation[$year - 2010]
    ];
}


// === Future population by birthplace ===


print_r($result);
