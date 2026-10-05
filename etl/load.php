<?php

$config = require __DIR__ . '/config.php';

$data = include __DIR__ . '/transform.php';

global $pdo;

try {
    $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo $e->getMessage();

}


// === Training Types ===

function insertTrainingTypes($trainingType)
{
    global $pdo;

    $insertTrainingTypes = "INSERT INTO training_types (training_type) VALUES (:TRAINING_TYPE)";
    $statement = $pdo->prepare($insertTrainingTypes);
    $statement->bindParam(':TRAINING_TYPE', $trainingType, PDO::PARAM_STR);
    $statement->execute();
}

$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($trainingTypes as $trainingType) {

    insertTrainingTypes($trainingType);

    echo "training type $trainingType <br>";

}


// === Learners ===

function insertLearner($training, $trainingType)
{
    global $pdo;

    if ($trainingType == "vocational") {

        $trainingId = 1;

    } elseif ($trainingType == "generalEducation") {

        $trainingId = 2;

    } else {

        $trainingId = 3;

    }

    $insertLearners = "INSERT INTO learners (`year`, training_id, total, swiss, foreigners, zurich, bern, uri, schwyz, obwalden, nidwalden, glarus, zug, fribourg, solothurn, basel_stadt, basel_landschaft, schaffhausen, appenzell_ausserrhoden, appenzell_innerrhoden, st_gallen, grisons, aargau, thurgau, ticino, vaud, valais, neuchatel, geneva, jura) VALUES (:YEAR, :TRAINING_ID, :TOTAL, :SWISS, :FOREIGNERS, :ZURICH, :BERN, :URI, :SCHWYZ, :OBWALDEN, :NIDWALDEN, :GLARUS, :ZUG, :FRIBOURG, :SOLOTHURN, :BASEL_STADT, :BASEL_LANDSCHAFT, :SCHAFFHAUSEN, :APPENZELL_AUSSERRHODEN, :APPENZELL_INNERRHODEN, :ST_GALLEN, :GRISONS, :AARGAU, :THURGAU, :TICINO, :VAUD, :VALAIS, :NEUCHATEL, :GENEVA, :JURA);";

    $statement = $pdo->prepare($insertLearners);

    $statement->bindParam(':TRAINING_ID', $trainingId, PDO::PARAM_INT);

    $columns = ['year', 'total', 'swiss', 'foreigners', 'zurich', 'bern', 'uri', 'schwyz', 'obwalden', 'nidwalden', 'glarus', 'zug', 'fribourg', 'solothurn', 'basel_stadt', 'basel_landschaft', 'schaffhausen', 'appenzell_ausserrhoden', 'appenzell_innerrhoden', 'st_gallen', 'grisons', 'aargau', 'thurgau', 'ticino', 'vaud', 'valais', 'neuchatel', 'geneva', 'jura'];

    foreach ($columns as $column) {

        $statement->bindParam(':' . strtoupper($column), $training[$column], PDO::PARAM_INT);

    }

    $statement->execute();

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

    $insertNewApprenticeshipsByIndustry = "INSERT INTO new_apprenticeships_by_industry (`year`, office_work, materials, construction, social_work) VALUES (:YEAR, :OFFICE_WORK, :MATERIALS, :CONSTRUCTION, :SOCIAL_WORK)";
    $statement = $pdo->prepare($insertNewApprenticeshipsByIndustry);
    $statement->bindParam(':YEAR', $apprenticeship['year'], PDO::PARAM_INT);
    $statement->bindParam(':OFFICE_WORK', $apprenticeship['office_work'], PDO::PARAM_INT);
    $statement->bindParam(':MATERIALS', $apprenticeship['materials'], PDO::PARAM_INT);
    $statement->bindParam(':CONSTRUCTION', $apprenticeship['construction'], PDO::PARAM_INT);
    $statement->bindParam(':SOCIAL_WORK', $apprenticeship['social_work'], PDO::PARAM_INT);
    $statement->execute();
}


$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($data['newApprenticeshipsByIndustry'] as $apprenticeship) {

    insertNewApprenticeshipsByIndustry($apprenticeship);

}




function insertFutureNewApprenticeships($futureApprenticeship)
{
    global $pdo;

    $insertFutureNewApprenticeships = "INSERT INTO future_new_apprenticeships (`year`, reference_scenario, high_scenario, low_scenario) VALUES (:YEAR, :REFERENCE_SCENARIO, :HIGH_SCENARIO, :LOW_SCENARIO);";
    $statement = $pdo->prepare($insertFutureNewApprenticeships);
    $statement->bindParam(':YEAR', $futureApprenticeship['year'], PDO::PARAM_INT);
    $statement->bindParam(':REFERENCE_SCENARIO', $futureApprenticeship['reference_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':HIGH_SCENARIO', $futureApprenticeship['high_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':LOW_SCENARIO', $futureApprenticeship['low_scenario'], PDO::PARAM_INT);
    $statement->execute();

}


$trainingTypes = ["vocational", "generalEducation", "other"];

foreach ($data['futureNewApprenticeships'] as $futureApprenticeship) {

    insertFutureNewApprenticeships($futureApprenticeship);

}


// === Population By Birthplace ===

function insertPopulationByBirthplace($population)
{
    global $pdo;

    $insertPopulationByBirthplace = "INSERT INTO population_by_birthplace (`year`, total, swiss, foreigners) VALUES (:YEAR, :TOTAL, :SWISS, :FOREIGNERS);";
    $statement = $pdo->prepare($insertPopulationByBirthplace);
    $statement->bindParam(':YEAR', $population['year'], PDO::PARAM_INT);
    $statement->bindParam(':TOTAL', $population['total'], PDO::PARAM_INT);
    $statement->bindParam(':SWISS', $population['swiss'], PDO::PARAM_INT);
    $statement->bindParam(':FOREIGNERS', $population['foreigners'], PDO::PARAM_INT);
    $statement->execute();

}


foreach ($data['populationByBirthplace'] as $population) {

    insertPopulationByBirthplace($population);

}

// === Future Population By Birthplace ===

function insertFuturePopulationByBirthplace($population)
{
    global $pdo;

    $insertFuturePopulationByBirthplace = "INSERT INTO future_population_by_birthplace (`year`, total_reference_scenario, total_high_scenario, total_low_scenario, swiss_reference_scenario, swiss_high_scenario, swiss_low_scenario, foreigners_reference_scenario, foreigners_high_scenario, foreigners_low_scenario) VALUES ( :YEAR, :TOTAL_REFERENCE_SCENARIO, :TOTAL_HIGH_SCENARIO, :TOTAL_LOW_SCENARIO, :SWISS_REFERENCE_SCENARIO, :SWISS_HIGH_SCENARIO, :SWISS_LOW_SCENARIO, :FOREIGNERS_REFERENCE_SCENARIO, :FOREIGNERS_HIGH_SCENARIO, :FOREIGNERS_LOW_SCENARIO)";

    $statement = $pdo->prepare($insertFuturePopulationByBirthplace);

    $statement->bindParam(':YEAR', $population['year'], PDO::PARAM_INT);
    $statement->bindParam(':TOTAL_REFERENCE_SCENARIO', $population['total_reference_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':TOTAL_HIGH_SCENARIO', $population['total_high_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':TOTAL_LOW_SCENARIO', $population['total_low_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':SWISS_REFERENCE_SCENARIO', $population['swiss_reference_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':SWISS_HIGH_SCENARIO', $population['swiss_high_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':SWISS_LOW_SCENARIO', $population['swiss_low_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':FOREIGNERS_REFERENCE_SCENARIO', $population['foreigners_reference_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':FOREIGNERS_HIGH_SCENARIO', $population['foreigners_high_scenario'], PDO::PARAM_INT);
    $statement->bindParam(':FOREIGNERS_LOW_SCENARIO', $population['foreigners_low_scenario'], PDO::PARAM_INT);

    $statement->execute();
}


foreach ($data['futurePopulationByBirthplace'] as $population) {
    insertFuturePopulationByBirthplace($population);
}
