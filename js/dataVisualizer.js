//Arrays

//Arrays Apprenticeships by Industry
const listIndustryApprentices = [];
const listIndustryYearsApprenticeshipsByIndustry = [];
const listIndustryOfficeWork = [];
const listIndustrySocialWork = [];
const listIndustryMaterials = [];
const listIndustryConstruction = [];

//Arrays Learners by Canton
const listLearnersYear = [];
const listLearnersGenevaGeneralEducation = [];
const listLearnersGenevaVocational = [];
const listLearnersGrisonsGeneralEducation = [];
const listLearnersGrisonsVocational = [];
const listLearnersBernGeneralEducation = [];
const listLearnersBernVocational = [];

//Arrays Population by Birthplace
const listPopulationYear = [];
const listPopulationSwiss = [];
const listPopulationForeigners = [];
const listPopulationTotal = [];

//Arrays general Education vs Vocational
const listGeneralEducationVsVocationalYear = [];
const listAmountGeneralEducationSwiss = [];
const listAmountGeneralEducationForeigners = [];
const listAmountGeneralEducationTotal = [];
const listAmountVocationalSwiss = [];
const listAmountVocationalForeigners = [];
const listAmountVocationalTotal = [];
const listAmountRatioSwiss = [];
const listAmountRatioForeigners = [];

//TODO: Komplette Umsetzung. Momentan noch nichts gemacht
//Arrays population Prognosis
const listPopulationPrognosis = [];

//Arrays future new apprenticeships

//TODO Komplette Umsetzung.


//DOM-Elemente
const chartLearnersByCanton = document.getElementById("chartLearnersByCanton");
const chartNewApprenticeshipsByIndustry = document.getElementById('chartNewApprenticeshipsByIndustry');
const chartPopulationByBirthplace = document.getElementById('chartPopulationByBirthplace');
const chartGeneralEducationVsVocational = document.getElementById('chartGeneralEducationVsVocational');
const chartPopulationPrognosis = document.getElementById('chartPopulationPrognosis');
const chartFutureNewApprenticeships = document.getElementById('chartFutureNewApprenticeships');

//Domain
//TODO: DOMAIN ANPASSEN
const domain = "https://im3.esabusev.myhostpoint.ch/etl/"

/**
 * Fetch-Funktion um die Listen aus New Apprenticeships zu erstellen. Vorfilterung siehe unten
 *
 * Vorsicht async: Muss mit funktion ".then()" verwendet werden.
 */
async function getNewApprenticeshipsByIndustry() {

    /*
        Vorfilterung via URL. Dokumentation siehe https://github.com/Eric-St03/wamachsch/blob/master/api-doku.md
        Ausgabe:
            year            STRING: Jahreszahl
            total           INT: Gesamtzahl abgeschlossener Lehrverträge
            office_work     INT: Anzahl abgeschlossener Lehrverträge in dieser Branche
            materials       INT: Anzahl abgeschlossener Lehrverträge in dieser Branche
            social_work     INT: Anzahl abgeschlossener Lehrverträge in dieser Branche
    */
    const url = `${domain}unload.php?new_apprenticeships_by_industry=true&industry[]=office_work&industry[]=materials&industry[]=social_work&industry[]=construction`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const newApprenticeshipsByIndustry = await response.json();

        //Nur alle 3 Jahre werden in die Liste abgespeichert. Counter beginnt bei 3
        let counter = 3;
        for (let numberOfApprentices of newApprenticeshipsByIndustry) {
            if(counter % 3 == 0) {
                listIndustryApprentices.push(numberOfApprentices.total);
                //Jahreszahlen werden theoretisch gesehen von der API als Strings wiedergegeben. Vorsicht bei der Verwendung.
                listIndustryYearsApprenticeshipsByIndustry.push(numberOfApprentices.year);
                listIndustryConstruction.push(numberOfApprentices.construction);
                listIndustryMaterials.push(numberOfApprentices.materials);
                listIndustrySocialWork.push(numberOfApprentices.social_work);
                listIndustryOfficeWork.push(numberOfApprentices.office_work);
            }
            counter++;
        }
    } catch (error) {
        console.error(error.message);
    }
}

async function getLearnersByCanton() {

    /*
        Vorfilterung via URL. Dokumentation siehe https://github.com/Eric-St03/wamachsch/blob/master/api-doku.md
        Ausgabe:
            year            STRING: Jahreszahl
            training_type   STRING: Vocational oder generalEducation
            canton[]        INT: Anzahl Lernenden in diesem Kanton (Achtung: Nicht alle Kantone zulässig! Siehe Dokumentation: https://github.com/Eric-St03/wamachsch/blob/master/api-doku.md
    */
    const url = `${domain}unload.php?learners=true&canton[]=geneva&canton[]=grisons&canton[]=bern`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const learnersByCanton = await response.json();

        for (let numberOfApprentices of learnersByCanton) {

            let checklistYear = ["2010", "2013", "2016", "2019", "2022", "2025"];

            if(checklistYear.includes(numberOfApprentices.year)) {
                //Wenn noch kein Eintrag mit der gleichen Jahreszahl besteht, mache einen Eintrag.
                if(!listLearnersYear.includes(numberOfApprentices.year)) {
                    //Jahreszahlen werden theoretisch gesehen von der API als Strings wiedergegeben. Vorsicht bei der Verwendung.
                    listLearnersYear.push(numberOfApprentices.year);
                }

                if(numberOfApprentices.training_type === "generalEducation") {
                    listLearnersBernGeneralEducation.push(numberOfApprentices.bern);
                    listLearnersGenevaGeneralEducation.push(numberOfApprentices.geneva);
                    listLearnersGrisonsGeneralEducation.push(numberOfApprentices.grisons);
                } else {
                    listLearnersBernVocational.push(numberOfApprentices.bern);
                    listLearnersGenevaVocational.push(numberOfApprentices.geneva);
                    listLearnersGrisonsVocational.push(numberOfApprentices.grisons);
                }
            }
        }

    } catch (error) {
        console.error(error.message);
    }
}

async function getPopulationByBirthplace() {

    /*
        Vorfilterung via URL. Dokumentation siehe https://github.com/Eric-St03/wamachsch/blob/master/api-doku.md
        Ausgabe:
            year            STRING: Jahreszahl
            total           INT: Gesamtpopulation
            swiss           INT: Schweizer Wohnbevölkerung
            foreigners      INT: Ausländische Wohnbevölkerung in der Schweiz
    */
    const url = `${domain}unload.php?population_by_birthplace=true`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const populationByBirthplace = await response.json();

        //Nur alle 3 Jahre werden in die Liste abgespeichert. Counter beginnt bei 3
        let counter = 3;
        for (let populationDataset of populationByBirthplace) {
            if(counter % 3 === 0) {
                //Jahreszahlen werden theoretisch gesehen von der API als Strings wiedergegeben. Vorsicht bei der Verwendung.
                listPopulationYear.push(populationDataset.year);

                listPopulationSwiss.push(populationDataset.swiss);
                listPopulationForeigners.push(populationDataset.foreigners);
                listPopulationTotal.push(populationDataset.total);
            }
            counter++;
        }
    } catch (error) {
        console.error(error.message);
    }
}

async function getGeneralEducationVsVocational() {

    /*
        Vorfilterung via URL. Dokumentation siehe https://github.com/Eric-St03/wamachsch/blob/master/api-doku.md
        Ausgabe:
            year            STRING: Jahreszahl
            training_type   STRING: Vocational oder generalEducation
            swiss           INT: Anzahl schweizerischen Lernenden in diesem Bildungsbereich
            foreigners      INT: Anzahl Ausländischer Lernenden in diesem Bildungsbereich
    */
    const url = `${domain}unload.php?learners=true`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const learners = await response.json();

        for (let learnersAmount of learners) {

            let checklistYear = ["2010", "2013", "2016", "2019", "2022", "2025"];

            if(checklistYear.includes(learnersAmount.year)) {
                //Wenn noch kein Eintrag mit der gleichen Jahreszahl besteht, mache einen Eintrag.
                if(!listGeneralEducationVsVocationalYear.includes(learnersAmount.year)) {
                    //Jahreszahlen werden theoretisch gesehen von der API als Strings wiedergegeben. Vorsicht bei der Verwendung.
                    listGeneralEducationVsVocationalYear.push(learnersAmount.year);
                }

                if(learnersAmount.training_type === "generalEducation") {
                    listAmountGeneralEducationSwiss.push(learnersAmount.swiss);
                    listAmountGeneralEducationForeigners.push(learnersAmount.foreigners);
                    listAmountGeneralEducationTotal.push(learnersAmount.total);
                } else {
                    listAmountVocationalSwiss.push(learnersAmount.swiss);
                    listAmountVocationalForeigners.push(learnersAmount.foreigners);
                    listAmountVocationalTotal.push(learnersAmount.total);
                }
            }
        }


        //TODO: BERECHNUNGSFORMEL ÜBERPRÜFEN

        //Berechnet den Prozentualen Anteil von Allgemeinbildung in % für Schweizerinnen und Ausländerinnen
        for(let i = 0; i <= listAmountGeneralEducationTotal.length; i++) {
            listAmountRatioSwiss[i] = listAmountGeneralEducationSwiss[i] / (listAmountGeneralEducationSwiss[i] + listAmountVocationalSwiss[i]) * 100;
            listAmountRatioForeigners[i] = listAmountGeneralEducationForeigners[i] / (listAmountGeneralEducationForeigners[i] + listAmountVocationalForeigners[i]) * 100;
        }


    } catch (error) {
        console.error(error.message);
    }
}

/*
* Ausführung der Funktion, erstellt einen neuen Chart nachdem die Fetch-Request erfolgreich durchgeführt wurde
* */
getNewApprenticeshipsByIndustry().then(e => {

    new Chart(chartNewApprenticeshipsByIndustry, {
        type: 'line',
        data:
            {
                labels: listIndustryYearsApprenticeshipsByIndustry,
                datasets: [
                    {
                        label: 'Branche Materials',
                        data: listIndustryMaterials,
                        backgroundColor: 'rgba(235, 54, 226, 1)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true
                    },
                    {
                        label: 'Branche Social Work',
                        data: listIndustrySocialWork,
                        backgroundColor: 'rgba(69, 235, 54, 1)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true
                    },
                    {
                        label: 'Baubranche',
                        data: listIndustryConstruction,
                        backgroundColor: 'rgb(114 50 44)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true
                    },
                    {
                        label: 'Branche Office Work',
                        data: listIndustryOfficeWork,
                        backgroundColor: 'rgb(153 166 232)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true
                    }
                ]
            },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Diagramm 2: Menge an abgeschlossenen Lehrverträgen nach Branchen"
                },
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    min: 0
                }
            }
        }
    });
});

getLearnersByCanton().then(e => {
    new Chart(chartLearnersByCanton, {
        type: 'bar',
        data:
            {
                labels: listLearnersYear,
                datasets: [
                    {
                        label: 'Bern Allgemeinbildung',
                        data: listLearnersBernGeneralEducation,
                        backgroundColor: 'rgb(227 13 13)',
                        borderWidth: 1,
                        fill: true,
                        order: 2 //Niedrigere Zahl = wird weiter vorne gezeichnet, vergleichbar mit z-index, nur umgekehrt
                    },
                    {
                        label: 'Bern Berufsbildung',
                        data: listLearnersBernVocational,
                        backgroundColor: 'rgb(156 32 32)',
                        borderWidth: 1,
                        fill: true,
                        order: 2 //Niedrigere Zahl = wird weiter vorne gezeichnet, vergleichbar mit z-index, nur umgekehrt
                    },
                    {
                        label: 'Genf Allgemeinbildung',
                        data: listLearnersGenevaGeneralEducation,
                        backgroundColor: 'rgb(255 213 0)',
                        borderWidth: 1,
                        fill: true,
                        order: 3

                    },
                    {
                        label: 'Genf Berufsbildung',
                        data: listLearnersGenevaVocational,
                        backgroundColor: 'rgb(129 112 31)',
                        borderWidth: 1,
                        fill: true,
                        order: 3

                    },
                    {
                        label: 'Graubünden Allgemeinbildung',
                        data: listLearnersGrisonsGeneralEducation,
                        backgroundColor: 'rgb(23 98 188)',
                        borderWidth: 1,
                        fill: true,
                        order: 1
                    },
                    {
                        label: 'Graubünden Berufsbildung',
                        data: listLearnersGrisonsVocational,
                        backgroundColor: 'rgb(26 60 101)',
                        borderWidth: 1,
                        fill: true,
                        order: 1
                    }
                ]
            },
        options: {
            indexAxis: "x",
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Diagramm 1: Anteil Berufsbildung in % im Vergleich zu Allgemeinbildung"
                },
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 35000
                }
            }
        }
    });
});

//Chart Wohnbevölkerung
getPopulationByBirthplace().then(e => {
    new Chart(chartPopulationByBirthplace, {
        type: 'bar',
        data:
            {
                labels: listPopulationYear,
                datasets: [
                    {
                        label: 'Schweizer:innen',
                        data: listPopulationSwiss,
                        backgroundColor: 'rgb(227 13 13)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true,
                        order: 1 //Niedrigere Zahl = wird weiter vorne gezeichnet, vergleichbar mit z-index, nur umgekehrt
                    },
                    {
                        label: 'Ausländisch',
                        data: listPopulationForeigners,
                        backgroundColor: 'rgb(36 46 135)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true,
                        order: 2
                    }/*,
                    {
                        label: 'Gesamt',
                        data: listPopulationTotal,
                        backgroundColor: 'rgb(70 70 74 / 0.43)',
                        borderColor: 'rgb(11, 11, 14)',
                        borderWidth: 1,
                        fill: true,
                        order: 3
                    }*/
                ]
            },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Diagramm 3: Wohnbevölkerung der Schweiz"
                },
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    min: 0
                }
            }
        }
    });
});

//Chart General Education vs Vocational

//TODO: ANPASSEN
getGeneralEducationVsVocational().then(e => {
    new Chart(chartGeneralEducationVsVocational, {
        type: 'line',
        data:
            {
                labels: listGeneralEducationVsVocationalYear,
                datasets: [
                    {
                        label: 'Schweizer:innen',
                        data: listAmountRatioSwiss,
                        borderColor: 'rgb(0 0 255)',
                        borderWidth: 1,
                        order: 2 //Niedrigere Zahl = wird weiter vorne gezeichnet, vergleichbar mit z-index, nur umgekehrt
                    },
                    {
                        label: 'Zuwanderer:innen',
                        data: listAmountRatioForeigners,
                        borderColor: 'rgb(128 94 26)',
                        borderWidth: 1,
                        order: 1
                    }
                ]
            },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Diagramm 4: Wahl für Allgemeinbildung in %"
                },
                legend: {
                    display: true
                }
            },
            scales: {
                x: {

                },
                y: {
                    max: 45,
                    min: 20
                }
            }
        }
    });
});