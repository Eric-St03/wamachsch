const htmlMain = document.querySelector("main");
let btnVergangenheit;
let btnGegenwart;
let btnZukunft;

/**
 * @desc Buttons (neu) erstellen und Eventlistener hinzufügen (click)
 */
function initializeButtons() {

    btnVergangenheit = document.createElement("button");
    btnGegenwart = document.createElement("button");
    btnZukunft = document.createElement("button");

    btnVergangenheit.classList.add("btnZeit");
    btnGegenwart.classList.add("btnZeit");
    btnZukunft.classList.add("btnZeit");

    btnVergangenheit.addEventListener("click", (e) => {
        generateSection("vergangenheit");
    });

    btnGegenwart.addEventListener("click", (e) => {
        generateSection("gegenwart");
    });

    btnZukunft.addEventListener("click", (e) => {
        generateSection("zukunft");
    });
}

/**
 * @desc Erstellt eine neue Section am Ende des mains.
 * @param {string} sectionName - "vergangenheit", "gegenwart", "zukunft"
*/
function generateSection(sectionName) {

    for(let btn of buildSection(sectionName)) {
        htmlMain.appendChild(btn);
    }

    console.log("Erstelle Section " + sectionName);
}

/**
 * @desc Baut eine neue Section auf.
 * @param {string} sectionName - "vergangenheit", "gegenwart", "zukunft"
 * @return {Array} section - Gebaute Section
 */
function buildSection(sectionName) {
    initializeButtons();
    if(typeof sectionName === "undefined" || sectionName === "initial") {
        let section = document.createElement("section");
        section.classList.add("wahlAbschnitt");

        return Array(buildButtons());
    } else {
        //Erster Buchstabe wird grossgeschrieben, für CamelCase
        sectionName = String(sectionName).charAt(0).toUpperCase() + String(sectionName).slice(1);

        let section = document.createElement("section");
        let portrait = document.createElement("img");
        let sectionText = document.createElement("p");

        portrait.src = "img/portrait.png";
        sectionText.innerHTML = "Lorem Ipsum dolor sit amet. Hier später Abruf von Texten via PHP? \<br\> Lorem Ipsum dolor sit amet.";


        section.classList.add("gewaehlterInhalt");
        portrait.classList.add("portrait" + sectionName);
        sectionText.classList.add("text" + sectionName);

        section.appendChild(portrait);
        section.appendChild(sectionText);

        return Array(section, buildButtons());
    }
}

function buildButtons() {
    let section = document.createElement("section");
    section.classList.add("wahlAbschnitt");

    for(let i = 0; i < 3; i++) {

        let innerSection = document.createElement("div");
        switch (i) {
            case 0:
                let headerVergangenheit = document.createElement("p");
                headerVergangenheit.innerHTML = "Vergangenheit";
                innerSection.appendChild(headerVergangenheit);
                innerSection.appendChild(btnVergangenheit);
                break;
            case 1:
                let headerGegenwart = document.createElement("p");
                headerGegenwart.innerHTML = "Gegenwart";
                innerSection.appendChild(headerGegenwart);
                innerSection.appendChild(btnGegenwart);
                break;
            case 2:
                let headerZukunft = document.createElement("p");
                headerZukunft.innerHTML = "Zukunft";
                innerSection.appendChild(headerZukunft);
                innerSection.appendChild(btnZukunft);
                break;
            default:
                console.error("Da ist etwas schief gelaufen!");
        }
        section.appendChild(innerSection);
    }

    return section;
}

generateSection("initial");