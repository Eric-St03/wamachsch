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
            'foreigners' => $learner['Ausland']
        ];
    } elseif ($learner['Bildungsstufe und Bildungstyp'] == "Allgemeinbildende Ausbildungen") {
        $generalEducationTrainingsByBirthplace[$year] = [
            'year' => $year,
            'total' => $learner['Staatsangehörigkeit - Total'],
            'swiss' => $learner['Schweiz'],
            'foreigners' => $learner['Ausland']
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
        'audiovisual_techniques_and_media_production' => $newApprenticeship['Audiovisuelle Techniken und Medienproduktion'],
        'fashion_interior_and_industrial_design' => $newApprenticeship['Mode, Innenarchitektur und industrielles Design'],
        'crafts' => $newApprenticeship['Kunsthandwerk'],
        'music_and_performing_arts' => $newApprenticeship['Musik und darstellende Kunst'],
        'library_information_and_archives' => $newApprenticeship['Bibliothek, Informationswesen, Archiv'],
        'business_and_administration_unspecified' => $newApprenticeship['Wirtschaft und Verwaltung nicht näher definiert'],
        'management_and_administration' => $newApprenticeship['Management und Verwaltung'],
        'office_work' => $newApprenticeship['Sekretariats- und Büroarbeit'],
        'wholesale_and_retail' => $newApprenticeship['Gross- und Einzelhandel'],
        'computer_use' => $newApprenticeship['Computeranwendung'],
        'databases_network_design_and_administration' => $newApprenticeship['Datenbanken, Netzwerkdesign und -administration'],
        'software_and_application_development_and_analysis' => $newApprenticeship['Software- und Applikationsentwicklung und -analyse'],
        'engineering_and_technical_professions_unspecified' => $newApprenticeship['Ingenieurwesen und Technische Berufe nicht näher definiert'],
        'chemical_and_process_engineering' => $newApprenticeship['Chemie und Verfahrenstechnik'],
        'environmental_protection_technologies' => $newApprenticeship['Umweltschutztechnologien'],
        'electricity_and_energy' => $newApprenticeship['Elektrizität und Energie'],
        'electronics_and_automation' => $newApprenticeship['Elektronik und Automation'],
        'mechanical_and_metalworking' => $newApprenticeship['Maschinenbau und Metallverarbeitung'],
        'motor_vehicles_ships_and_aircraft' => $newApprenticeship['Kraftfahrzeuge, Schiffe und Flugzeuge'],
        'food' => $newApprenticeship['Nahrungsmittel'],
        'materials' => $newApprenticeship['Werkstoffe (Glas, Papier, Kunststoff und Holz)'],
        'textiles_clothing_footwear_and_leather' => $newApprenticeship['Textilien (Kleidung, Schuhwerk und Leder)'],
        'architecture_and_urban_planning' => $newApprenticeship['Architektur und Städteplanung'],
        'construction' => $newApprenticeship['Baugewerbe, Hoch- und Tiefbau'],
        'crop_and_animal_production' => $newApprenticeship['Pflanzenbau und Tierzucht'],
        'horticulture' => $newApprenticeship['Gartenbau'],
        'forestry' => $newApprenticeship['Forstwirtschaft'],
        'veterinary' => $newApprenticeship['Tiermedizin'],
        'dentistry' => $newApprenticeship['Zahnmedizin'],
        'nursing_and_midwifery' => $newApprenticeship['Krankenpflege und Geburtshilfe'],
        'medical_diagnostics_and_treatment_technology' => $newApprenticeship['Medizinische Diagnostik und Behandlungstechnik'],
        'therapy_and_rehabilitation' => $newApprenticeship['Therapie und Rehabilitation'],
        'pharmacy' => $newApprenticeship['Pharmazie'],
        'care_of_older_or_disabled_people' => $newApprenticeship['Pflege von alten oder behinderten Personen'],
        'child_and_youth_work' => $newApprenticeship['Kinder- und Jugendarbeit'],
        'social_work' => $newApprenticeship['Sozialarbeit und Beratung'],
        'interdisciplinary_health_and_social_programmes' => $newApprenticeship['Interdisziplinäre Programme und Qualifikationen mit Gesundheit und Sozialwesen'],
        'domestic_services' => $newApprenticeship['Hauswirtschaftliche Dienste'],
        'hairdressing_and_beauty_treatment' => $newApprenticeship['Friseurgewerbe und Schönheitspflege'],
        'hospitality_and_catering' => $newApprenticeship['Gastgewerbe und Catering'],
        'sport' => $newApprenticeship['Sport'],
        'transport_services' => $newApprenticeship['Verkehrsdienstleistungen']
    ];
}

// === Future new apprenticeships ===
foreach ($futureNewApprenticeships as $futureNewApprenticeship) {

    $year = $futureNewApprenticeship['Jahr'];

    $result['futureNewApprenticeships'][$year] = [
        'year' => $year,
        'reference_scenario' => $futureNewApprenticeship["Referenzszenario EFZ"] + $futureNewApprenticeship["Referenzszenario EBA"],
        'high_scenario' => $futureNewApprenticeship["Szenario 'hoch' EFZ"] + $futureNewApprenticeship["Szenario 'hoch' EBA"],
        'low_scenario' => $futureNewApprenticeship["Szenario 'tief' EFZ"] + $futureNewApprenticeship["Szenario 'tief' EBA"]
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
        'foreigners' => $foreignPopulation[$year - 2010]
    ];
}


// === Future population by birthplace ===
foreach ($futurePopulationByBirthplace as $futurePopulation) {

    $year = $futurePopulation['Jahr'];

    $result['futurePopulationByBirthplace'][$year] = [
        'year' => $year,
        'total_reference_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Staatsangehörigkeit - Total Referenzszenario A-00-2025"],
        'total_high_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Staatsangehörigkeit - Total 'hohes' Szenario B-00-2025"],
        'total_low_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Staatsangehörigkeit - Total 'tiefes' Szenario C-00-2025"],
        'swiss_reference_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Schweiz Referenzszenario A-00-2025"],
        'swiss_high_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Schweiz 'hohes' Szenario B-00-2025"],
        'swiss_low_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Schweiz 'tiefes' Szenario C-00-2025"],
        'foreigners_reference_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland EWR Referenzszenario A-00-2025"] + $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland Nicht-EWR Referenzszenario A-00-2025"],
        'foreigners_high_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland EWR 'hohes' Szenario B-00-2025"] + $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland Nicht-EWR 'hohes' Szenario B-00-2025"],
        'foreigners_low_scenario' => $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland Nicht-EWR 'tiefes' Szenario C-00-2025"] + $futurePopulation["Bevölkerungsstand am 31. Dezember Ausland Nicht-EWR 'tiefes' Szenario C-00-2025"]
    ];
}

return $result;
