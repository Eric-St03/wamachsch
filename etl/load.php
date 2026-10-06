<?php

require_once __DIR__ . '/config.php';

$data = include __DIR__ . '/transform.php';

global $pdo;

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo $e->getMessage();

}


// === Training Types ===

function insertTrainingTypes($trainingType) {
    global $pdo;

    $insertTrainingTypes = "INSERT INTO training_types (training_type) VALUES (:TRAINING_TYPE) ON DUPLICATE KEY UPDATE training_type = training_type;";
    $statement = $pdo->prepare($insertTrainingTypes);
    $statement->execute([
        ':TRAINING_TYPE' => $trainingType
    ]);
}

$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($trainingTypes as $trainingType) {

    insertTrainingTypes($trainingType);

}


// === Learners ===

function insertLearner($training, $trainingType) {
    global $pdo;

    if (!($trainingType == "vocational" || $trainingType == "generalEducation")) {
        $trainingType = "other";
    }

    $selectTrainingId = "SELECT id FROM training_types WHERE training_type = :TRAINING_TYPE";
    $statement = $pdo->prepare($selectTrainingId);
    $statement->execute([':TRAINING_TYPE' => $trainingType]);

    $trainingId = $statement->fetch();

    if ($trainingId) {
        $insertLearners = "INSERT INTO learners (`year`, training_id, total, swiss, foreigners, zurich, bern, uri, schwyz, obwalden, nidwalden, glarus, zug, fribourg, solothurn, basel_stadt, basel_landschaft, schaffhausen, appenzell_ausserrhoden, appenzell_innerrhoden, st_gallen, grisons, aargau, thurgau, ticino, vaud, valais, neuchatel, geneva, jura) VALUES (:YEAR, :TRAINING_ID, :TOTAL, :SWISS, :FOREIGNERS, :ZURICH, :BERN, :URI, :SCHWYZ, :OBWALDEN, :NIDWALDEN, :GLARUS, :ZUG, :FRIBOURG, :SOLOTHURN, :BASEL_STADT, :BASEL_LANDSCHAFT, :SCHAFFHAUSEN, :APPENZELL_AUSSERRHODEN, :APPENZELL_INNERRHODEN, :ST_GALLEN, :GRISONS, :AARGAU, :THURGAU, :TICINO, :VAUD, :VALAIS, :NEUCHATEL, :GENEVA, :JURA) ON DUPLICATE KEY UPDATE `year` = `year`";

        $statement = $pdo->prepare($insertLearners);

        // Build parameters array
        $params = [':TRAINING_ID' => $trainingId['id']];

        $columns = ['year', 'total', 'swiss', 'foreigners', 'zurich', 'bern', 'uri', 'schwyz', 'obwalden', 'nidwalden', 'glarus', 'zug', 'fribourg', 'solothurn', 'basel_stadt', 'basel_landschaft', 'schaffhausen', 'appenzell_ausserrhoden', 'appenzell_innerrhoden', 'st_gallen', 'grisons', 'aargau', 'thurgau', 'ticino', 'vaud', 'valais', 'neuchatel', 'geneva', 'jura'];

        foreach ($columns as $column) {
            $params[':' . strtoupper($column)] = $training[$column];
        }

        $statement->execute($params);
    }
}



foreach ($data['vocationalTrainings'] as $training) {

    insertLearner($training, "vocational");

}

foreach ($data['generalEducationTrainings'] as $training) {

    insertLearner($training, "generalEducation");

}

// === New apprenticeships by industry ===

function insertNewApprenticeshipsByIndustry($apprenticeship)
{
    global $pdo;

    $insertNewApprenticeshipsByIndustry = "INSERT INTO new_apprenticeships_by_industry (`year`, office_work, materials, construction, social_work) VALUES (:YEAR, :OFFICE_WORK, :MATERIALS, :CONSTRUCTION, :SOCIAL_WORK) ON DUPLICATE KEY UPDATE `year` = `year`;";
    $statement = $pdo->prepare($insertNewApprenticeshipsByIndustry);
    $statement->execute([
        ':YEAR' => $apprenticeship['year'],
        ':OFFICE_WORK' => $apprenticeship['office_work'],
        ':MATERIALS' => $apprenticeship['materials'],
        ':CONSTRUCTION' => $apprenticeship['construction'],
        ':SOCIAL_WORK' => $apprenticeship['social_work']
    ]);
}



$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($data['newApprenticeshipsByIndustry'] as $apprenticeship) {

    insertNewApprenticeshipsByIndustry($apprenticeship);

}




function insertFutureNewApprenticeships($futureApprenticeship)
{
    global $pdo;

    $insertFutureNewApprenticeships = "INSERT INTO future_new_apprenticeships (`year`, reference_scenario, high_scenario, low_scenario) VALUES (:YEAR, :REFERENCE_SCENARIO, :HIGH_SCENARIO, :LOW_SCENARIO) ON DUPLICATE KEY UPDATE `year` = `year`;";
    $statement = $pdo->prepare($insertFutureNewApprenticeships);
    $statement->execute([
        ':YEAR' => $futureApprenticeship['year'],
        ':REFERENCE_SCENARIO' => $futureApprenticeship['reference_scenario'],
        ':HIGH_SCENARIO' => $futureApprenticeship['high_scenario'],
        ':LOW_SCENARIO' => $futureApprenticeship['low_scenario']
    ]);
}


$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($data['futureNewApprenticeships'] as $futureApprenticeship) {

    insertFutureNewApprenticeships($futureApprenticeship);

}


// === Population By Birthplace ===

function insertPopulationByBirthplace($population)
{
    global $pdo;

    $insertPopulationByBirthplace = "INSERT INTO population_by_birthplace (`year`, total, swiss, foreigners) VALUES (:YEAR, :TOTAL, :SWISS, :FOREIGNERS) ON DUPLICATE KEY UPDATE `year` = `year`;";
    $statement = $pdo->prepare($insertPopulationByBirthplace);
    $statement->execute([
        ':YEAR' => $population['year'],
        ':TOTAL' => $population['total'],
        ':SWISS' => $population['swiss'],
        ':FOREIGNERS' => $population['foreigners']
    ]);
}


foreach ($data['populationByBirthplace'] as $population) {

    insertPopulationByBirthplace($population);

}

// === Future Population By Birthplace ===

function insertFuturePopulationByBirthplace($population)
{
    global $pdo;

    $insertFuturePopulationByBirthplace = "INSERT INTO future_population_by_birthplace (`year`, total_reference_scenario, total_high_scenario, total_low_scenario, swiss_reference_scenario, swiss_high_scenario, swiss_low_scenario, foreigners_reference_scenario, foreigners_high_scenario, foreigners_low_scenario) VALUES ( :YEAR, :TOTAL_REFERENCE_SCENARIO, :TOTAL_HIGH_SCENARIO, :TOTAL_LOW_SCENARIO, :SWISS_REFERENCE_SCENARIO, :SWISS_HIGH_SCENARIO, :SWISS_LOW_SCENARIO, :FOREIGNERS_REFERENCE_SCENARIO, :FOREIGNERS_HIGH_SCENARIO, :FOREIGNERS_LOW_SCENARIO) ON DUPLICATE KEY UPDATE `year` = `year`;";
    $statement = $pdo->prepare($insertFuturePopulationByBirthplace);
    $statement->execute([
        ':YEAR' => $population['year'],
        ':TOTAL_REFERENCE_SCENARIO' => $population['total_reference_scenario'],
        ':TOTAL_HIGH_SCENARIO' => $population['total_high_scenario'],
        ':TOTAL_LOW_SCENARIO' => $population['total_low_scenario'],
        ':SWISS_REFERENCE_SCENARIO' => $population['swiss_reference_scenario'],
        ':SWISS_HIGH_SCENARIO' => $population['swiss_high_scenario'],
        ':SWISS_LOW_SCENARIO' => $population['swiss_low_scenario'],
        ':FOREIGNERS_REFERENCE_SCENARIO' => $population['foreigners_reference_scenario'],
        ':FOREIGNERS_HIGH_SCENARIO' => $population['foreigners_high_scenario'],
        ':FOREIGNERS_LOW_SCENARIO' => $population['foreigners_low_scenario']
    ]);
}


foreach ($data['futurePopulationByBirthplace'] as $population) {
    insertFuturePopulationByBirthplace($population);
}
