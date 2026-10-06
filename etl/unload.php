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

    $sql = 'SELECT year';

    // Filter: Industry

    if (!isset($_GET['industry'])) {
        $sql .= ', office_work, materials, construction, social_work';
    } elseif (isset($_GET['industry']) && !empty($_GET['industry'])) {
        $allowedIndustries = ['office_work', 'materials', 'construction', 'social_work'];

        foreach ($_GET['industry'] as $industry) {
            if (in_array($industry, $allowedIndustries)) {
                $sql .= ", " . $industry;
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

if (isset($sql)) {
    $statement = $pdo->prepare($sql);
    $statement->execute($params);

    $data = $statement->fetchAll();

    echo json_encode($data);
}

