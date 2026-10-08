<?php

header('Content-type: application/json');

require_once __DIR__ . '/config.php';

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$params = [];


// === Learners ===

if (isset($_GET['learners']) && $_GET['learners'] === "true") {

    $sql = 'SELECT learners.year, training_types.training_type, learners.total, learners.swiss, learners.foreigners';

    // Filter: Cantons

    if (isset($_GET['canton']) && !empty($_GET['canton'])) {
        $allowedCantons = ['zurich', 'bern', 'uri', 'schwyz', 'obwalden', 'nidwalden', 'glarus', 'zug', 'fribourg', 'solothurn', 'basel_stadt', 'basel_landschaft', 'schaffhausen', 'appenzell_ausserrhoden', 'appenzell_innerrhoden', 'st_gallen', 'grisons', 'aargau', 'thurgau', 'ticino', 'vaud', 'valais', 'neuchatel', 'geneva', 'jura'];

        foreach ($_GET['canton'] as $canton) {
            if (in_array($canton, $allowedCantons)) {
                $sql .= ", learners." . $canton;
            }
        }
    }

    $sql .= ' FROM learners
    INNER JOIN training_types 
    ON learners.training_id = training_types.id
    WHERE 1 = 1';

    // Filter: training type
    if (isset($_GET['training_type']) && !empty($_GET['training_type'])) {
        $sql .= " AND training_types.training_type = :TRAINING_TYPE";
        $params[':TRAINING_TYPE'] = $_GET['training_type'];
    }

    // Filter: year
    if (isset($_GET['start_year']) && !empty($_GET['start_year'])) {
        $sql .= " AND learners.year >= :START_YEAR";
        $params[':START_YEAR'] = $_GET['start_year'];
    }
    if (isset($_GET['end_year']) && !empty($_GET['end_year'])) {
        $sql .= " AND learners.year <= :END_YEAR";
        $params[':END_YEAR'] = $_GET['end_year'];
    }

}

// === New apprenticeships by industry ===

if (isset($_GET['new_apprenticeships_by_industry']) && $_GET['new_apprenticeships_by_industry'] === "true") {

    $sql = 'SELECT year, total';

    // Filter: Industry

    if (!isset($_GET['industry'])) {
        $sql .= ', audiovisual_techniques_and_media_production, fashion_interior_and_industrial_design, crafts, music_and_performing_arts, library_information_and_archives, business_and_administration_unspecified, management_and_administration, office_work, wholesale_and_retail, computer_use, databases_network_design_and_administration, software_and_application_development_and_analysis, engineering_and_technical_professions_unspecified, chemical_and_process_engineering, environmental_protection_technologies, electricity_and_energy, electronics_and_automation, mechanical_and_metalworking, motor_vehicles_ships_and_aircraft, food, materials, textiles_clothing_footwear_and_leather, architecture_and_urban_planning, construction, crop_and_animal_production, horticulture, forestry, veterinary, dentistry, nursing_and_midwifery, medical_diagnostics_and_treatment_technology, therapy_and_rehabilitation, pharmacy, care_of_older_or_disabled_people, child_and_youth_work, social_work, interdisciplinary_health_and_social_programmes, domestic_services, hairdressing_and_beauty_treatment, hospitality_and_catering, sport, transport_services';
    } elseif (!empty($_GET['industry'])) {
        $allowedIndustries = ['total', 'audiovisual_techniques_and_media_production', 'fashion_interior_and_industrial_design', 'crafts', 'music_and_performing_arts', 'library_information_and_archives', 'business_and_administration_unspecified', 'management_and_administration', 'office_work', 'wholesale_and_retail', 'computer_use', 'databases_network_design_and_administration', 'software_and_application_development_and_analysis', 'engineering_and_technical_professions_unspecified', 'chemical_and_process_engineering', 'environmental_protection_technologies', 'electricity_and_energy', 'electronics_and_automation', 'mechanical_and_metalworking', 'motor_vehicles_ships_and_aircraft', 'food', 'materials', 'textiles_clothing_footwear_and_leather', 'architecture_and_urban_planning', 'construction', 'crop_and_animal_production', 'horticulture', 'forestry', 'veterinary', 'dentistry', 'nursing_and_midwifery', 'medical_diagnostics_and_treatment_technology', 'therapy_and_rehabilitation', 'pharmacy', 'care_of_older_or_disabled_people', 'child_and_youth_work', 'social_work', 'interdisciplinary_health_and_social_programmes', 'domestic_services', 'hairdressing_and_beauty_treatment', 'hospitality_and_catering', 'sport', 'transport_services'];

        foreach ($_GET['industry'] as $industry) {
            if (in_array($industry, $allowedIndustries, true)) {
                $sql .= ', ' . $industry;
            }
        }
    }


    $sql .= ' FROM new_apprenticeships_by_industry WHERE 1 = 1';

    // Filter: year
    if (isset($_GET['start_year']) && !empty($_GET['start_year'])) {
        $sql .= " AND year >= :START_YEAR";
        $params[':START_YEAR'] = $_GET['start_year'];
    }
    if (isset($_GET['end_year']) && !empty($_GET['end_year'])) {
        $sql .= " AND year <= :END_YEAR";
        $params[':END_YEAR'] = $_GET['end_year'];
    }
}

// === Future new apprenticeships ===

if (isset($_GET['future_new_apprenticeships']) && $_GET['future_new_apprenticeships'] === "true") {

    $sql = 'SELECT year';

    // Filter: scenario

    if (!isset($_GET['scenario'])) {
        $sql .= ', reference_scenario, high_scenario, low_scenario';
    } elseif (isset($_GET['scenario']) && !empty($_GET['scenario'])) {
        $allowedScenario = ['reference', 'high', 'low'];

        foreach ($_GET['scenario'] as $scenario) {
            if (in_array($scenario, $allowedScenario)) {
                $sql .= ", " . $scenario . "_scenario";
            }
        }
    }

    $sql .= ' FROM future_new_apprenticeships WHERE 1 = 1';

    // Filter: year
    if (isset($_GET['start_year']) && !empty($_GET['start_year'])) {
        $sql .= " AND year >= :START_YEAR";
        $params[':START_YEAR'] = $_GET['start_year'];
    }
    if (isset($_GET['end_year']) && !empty($_GET['end_year'])) {
        $sql .= " AND year <= :END_YEAR";
        $params[':END_YEAR'] = $_GET['end_year'];
    }
}

// === Population By Birthplace ===

if (isset($_GET['population_by_birthplace']) && $_GET['population_by_birthplace'] === "true") {

    $sql = 'SELECT `year`, total, swiss, foreigners FROM population_by_birthplace WHERE 1 = 1';

    // Filter: year
    if (isset($_GET['start_year']) && !empty($_GET['start_year'])) {
        $sql .= " AND year >= :START_YEAR";
        $params[':START_YEAR'] = $_GET['start_year'];
    }
    if (isset($_GET['end_year']) && !empty($_GET['end_year'])) {
        $sql .= " AND year <= :END_YEAR";
        $params[':END_YEAR'] = $_GET['end_year'];
    }
}

// === Future Population By Birthplace ===

if (isset($_GET['future_population_by_birthplace']) && $_GET['future_population_by_birthplace'] === "true") {

    $sql = 'SELECT year';

    // Filter: scenario

    if (!isset($_GET['scenario'])) {
        $sql .= ', total_reference_scenario, total_high_scenario, total_low_scenario, swiss_reference_scenario, swiss_high_scenario, swiss_low_scenario, foreigners_reference_scenario, foreigners_high_scenario, foreigners_low_scenario';
    } elseif (isset($_GET['scenario']) && !empty($_GET['scenario'])) {
        $allowedScenario = ['reference', 'high', 'low'];

        foreach ($_GET['scenario'] as $scenario) {
            if (in_array($scenario, $allowedScenario)) {
                $sql .= ", total_" . $scenario . "_scenario, swiss_" . $scenario . "_scenario, foreigners_" . $scenario . "_scenario";
            }
        }
    }

    $sql .= ' FROM future_population_by_birthplace WHERE 1 = 1';

    // Filter: year
    if (isset($_GET['start_year']) && !empty($_GET['start_year'])) {
        $sql .= " AND year >= :START_YEAR";
        $params[':START_YEAR'] = $_GET['start_year'];
    }
    if (isset($_GET['end_year']) && !empty($_GET['end_year'])) {
        $sql .= " AND year <= :END_YEAR";
        $params[':END_YEAR'] = $_GET['end_year'];
    }
}

if (isset($sql)) {
    $statement = $pdo->prepare($sql);
    $statement->execute($params);

    $data = $statement->fetchAll();

    echo json_encode($data);
}

