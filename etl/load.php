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

    $insertNewApprenticeshipsByIndustry = "
        INSERT INTO new_apprenticeships_by_industry ( `year`, total, audiovisual_techniques_and_media_production, fashion_interior_and_industrial_design, crafts, music_and_performing_arts, library_information_and_archives, business_and_administration_unspecified, management_and_administration, office_work, wholesale_and_retail, computer_use, databases_network_design_and_administration, software_and_application_development_and_analysis, engineering_and_technical_professions_unspecified, chemical_and_process_engineering, environmental_protection_technologies, electricity_and_energy, electronics_and_automation, mechanical_and_metalworking, motor_vehicles_ships_and_aircraft, food, materials, textiles_clothing_footwear_and_leather, architecture_and_urban_planning, construction, crop_and_animal_production, horticulture, forestry, veterinary, dentistry, nursing_and_midwifery, medical_diagnostics_and_treatment_technology, therapy_and_rehabilitation, pharmacy, care_of_older_or_disabled_people, child_and_youth_work, social_work, interdisciplinary_health_and_social_programmes, domestic_services, hairdressing_and_beauty_treatment, hospitality_and_catering, sport, transport_services) VALUES ( :YEAR, :TOTAL, :AUDIOVISUAL_TECHNIQUES_AND_MEDIA_PRODUCTION, :FASHION_INTERIOR_AND_INDUSTRIAL_DESIGN, :CRAFTS, :MUSIC_AND_PERFORMING_ARTS, :LIBRARY_INFORMATION_AND_ARCHIVES, :BUSINESS_AND_ADMINISTRATION_UNSPECIFIED, :MANAGEMENT_AND_ADMINISTRATION, :OFFICE_WORK, :WHOLESALE_AND_RETAIL, :COMPUTER_USE, :DATABASES_NETWORK_DESIGN_AND_ADMINISTRATION, :SOFTWARE_AND_APPLICATION_DEVELOPMENT_AND_ANALYSIS, :ENGINEERING_AND_TECHNICAL_PROFESSIONS_UNSPECIFIED, :CHEMICAL_AND_PROCESS_ENGINEERING, :ENVIRONMENTAL_PROTECTION_TECHNOLOGIES, :ELECTRICITY_AND_ENERGY, :ELECTRONICS_AND_AUTOMATION, :MECHANICAL_AND_METALWORKING, :MOTOR_VEHICLES_SHIPS_AND_AIRCRAFT, :FOOD, :MATERIALS, :TEXTILES_CLOTHING_FOOTWEAR_AND_LEATHER, :ARCHITECTURE_AND_URBAN_PLANNING, :CONSTRUCTION, :CROP_AND_ANIMAL_PRODUCTION, :HORTICULTURE, :FORESTRY, :VETERINARY, :DENTISTRY, :NURSING_AND_MIDWIFERY, :MEDICAL_DIAGNOSTICS_AND_TREATMENT_TECHNOLOGY, :THERAPY_AND_REHABILITATION, :PHARMACY, :CARE_OF_OLDER_OR_DISABLED_PEOPLE, :CHILD_AND_YOUTH_WORK, :SOCIAL_WORK, :INTERDISCIPLINARY_HEALTH_AND_SOCIAL_PROGRAMMES, :DOMESTIC_SERVICES, :HAIRDRESSING_AND_BEAUTY_TREATMENT, :HOSPITALITY_AND_CATERING, :SPORT, :TRANSPORT_SERVICES) ON DUPLICATE KEY UPDATE `year` = `year`";

    $statement = $pdo->prepare($insertNewApprenticeshipsByIndustry);

    $columns = ['year', 'total', 'audiovisual_techniques_and_media_production', 'fashion_interior_and_industrial_design', 'crafts', 'music_and_performing_arts', 'library_information_and_archives', 'business_and_administration_unspecified', 'management_and_administration', 'office_work', 'wholesale_and_retail', 'computer_use', 'databases_network_design_and_administration', 'software_and_application_development_and_analysis', 'engineering_and_technical_professions_unspecified', 'chemical_and_process_engineering', 'environmental_protection_technologies', 'electricity_and_energy', 'electronics_and_automation', 'mechanical_and_metalworking', 'motor_vehicles_ships_and_aircraft', 'food', 'materials', 'textiles_clothing_footwear_and_leather', 'architecture_and_urban_planning', 'construction', 'crop_and_animal_production', 'horticulture', 'forestry', 'veterinary', 'dentistry', 'nursing_and_midwifery', 'medical_diagnostics_and_treatment_technology', 'therapy_and_rehabilitation', 'pharmacy', 'care_of_older_or_disabled_people', 'child_and_youth_work', 'social_work', 'interdisciplinary_health_and_social_programmes', 'domestic_services', 'hairdressing_and_beauty_treatment', 'hospitality_and_catering', 'sport', 'transport_services'];

    $params = [];

    foreach ($columns as $column) {
        $params[':' . strtoupper($column)] = $apprenticeship[$column];
    }

    $statement->execute($params);
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
