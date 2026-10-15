<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lehrstellenstory</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>

    </header>
    <main>
        <section class="lead">

            <div class="hero-image">
            <img src="img/Hero.svg" alt="Hero Image">
            </div>
            <div class="logo"><img src="img/logo.svg" alt="Logo"></div>
            <div class="lead-text">
                <p>Jeder Jugendliche wird im Verlauf der obligatorischen Schulzeit mit der Frage konfrontiert, was er in den nächsten Jahren für einen Weg einschlagen will. Während sich die einen für eine Berufslehre entscheiden, wählen andere das Gymnasium oder schlagen ein ganz anderen Weg ein.</p><br>

                <p>Die Ausgangslage hat sich in den letzten Jahrzehnten für junge Schweizer Bürgerinnen und Bürger stetig verändert. Seit dem Jahr 2000 ist die Schweizer Bevölkerung gewachsen. Gleichzeitig hat sich die Bildungslandschaft weiterentwickelt. Mehr Jugendliche besuchen weiterführende Schulen, neue Berufsbilder sind entstanden und die Anforderungen an die Arbeitswelt haben sich verändert. Hinter der Frage nach einer Lehrstelle steckt deshalb mehr als nur die persönliche Berufswahl.</p>

                <h3>Wie hält sich die Beliebtheit der Allgemeinbildung? Beginnen heute tatsächlich weniger Jugendliche eine Lehre oder verändert sich die Zahl vor allem im Verhältnis zu einer wachsenden Bevölkerung? Was bedeutet das für die Zukunft?</h3>

                <p>Um diesen Fragen nachzugehen, begleiten wir unsere drei Protagonisten auf ihrem Weg in die Berufswelt. Aus unterschiedlichen Jahrzehnten und Regionen der Schweiz stammend, stehen die drei vor ganz unterschiedlichen Herausforderungen.</p>
            </div>
        </section>

        <section class="clock">
            <div class="clock-parent-container">
                <div id="btn-past" class="clock_container">
                    <img src="img/clock_past.svg" alt="Vergangenheit">
                    <h5>Vergangenheit</h5>
                </div>
                <div id="btn-present" class="clock_container">
                    <img src="img/clock_present.svg" alt="Gegenwart">
                    <h5>Gegenwart</h5>
                </div>
                <div id="btn-future" class="clock_container">
                    <img src="img/clock_future.svg" alt="Zukunft">
                    <h5>Zukunft</h5>
                </div>
            </div>
        </section>

        <a class="anchor" id="time-anchor"></a>
        <section class="time-container">
            <div class="past">
                <div class="profil">
                    <img src="img/persona_past.svg" alt="Persona Past">
                    <h4>Cloé (15), wohnhaft in Genf<br>Angehende Kauffrau EFZ</h4>
                </div>

                <p> Cloé wächst in einer Zeit auf, in der viele Jobs durch die immer stärker zunehmende Digitalisierung der Arbeitsplätze starken Veränderungen ausgesetzt sind. Während gestern noch klobige Rechner in den Büros standen, laufen heute viele bereits mit ihrem eigenen Laptop umher. Auch in der Schule hat die Digitalisierung Fuss gefasst und ermöglicht den Schülern eine besseren Überblick über alle Möglichkeiten, die ihre Zukunft zu bieten hat.</p><br>

                <p>Als Einzelkind von Eltern in höheren Führungspositionen fehlte es Cloé an nichts.  Ihre Freunde leben eine paar Blöke weiter und erst letzte Weihnacht hat sie das neuste iPhone erhalten. Ihre Eltern haben erwartet, dass sie sich wie viele ihrer Klasse für ein «Maturité gymnasiale» einschreiben würde. Doch Cloé möchte möglichst schnell unabhängig von ihren Eltern werden und unterschreibt deshalb im Jahr 2010 ihren Lehrvertrag als angehende Kauffrau EFZ.</p><br>

                <div class="chart-container">
                    <canvas id="chartLearnersByCanton"></canvas>
                </div>

                <p> In Genf gehört sie mit ihrer Entscheidung zwar eher zur Minderheit, doch die Beliebtheit der Berufslehre war damals in vielen Teile der Schweiz noch unumstritten. Besonders in den ländlichen Kantonen genoss die Berufsbildung einen grosse Beliebtheit. Ein Rückgang der Berufslehre ist in den letzten Jahren besonders im Kanton Bern festgestellt worden.</p><br>
                <div class="chart-container">
                    <canvas id="chartNewApprenticeshipsByIndustry"></canvas>
                </div>

                <p>Auch bei den Berufsbilder hat sich einiges verändert. Die Lehre die Cloé anstrebt hat anfangs der 2010er Jahre einen Zuwachs von über 2'000 Lehrantritte gewonnen. Über die Jahre nahm der Zuwachs wieder etwas ab, doch Cloé kann die Lehre im Jahr 2014 in einem der beliebtesten Berufsfelder abschliessen.</p>
            </div>

            <div class="present">
                <div class="profil">
                    <img src="img/persona_present.svg" alt="Persona Present">
                    <h4>Mirko (16), wohnhaft in Aarau <br> Angehender Kanti-Schüler?</h4>
                </div>

                <p>Im Jahr 2009 geboren, gehört Mirko gerade noch zur Generation Z. Eine Generation, die bereits mit Smartphones aufgewachsen ist. Sie werden oft als Digital Natives bezeichnet und ihre Schulbildung wurde durch die Corona-Pandemie geprägt, kein einfacher Einstieg in die Berufswelt.</p><br>

                <p>Neben dem Stigma, mit dem die Generation Z zu kämpfen hat, prägte Mirko zudem noch die Thematik der Zuwanderung. Seine Eltern sind in den 90er-Jahren in die Schweiz eingewandert und seit Mirko zur Welt kam, ist dies ein stark polarisierendes Thema.</p><br>

                <div class="chart-container">
                    <canvas id="chartPopulationByBirthplace"></canvas>
                </div>

                <p>Die Statistik zeigt, dass seit 2010 ein Zuwachs von über einer Million gemessen wurde. Im Jahr 2024 wurde zudem die 9-Millionen-Marke geknackt. Diese Zahlen sind aber nicht nur auf die Zuwanderung zurück zu führen, sondern verzeichnen auch bei den Schweizeri:innen einen sichtbaren Zuwachs.</p><br>

                <p>Mirkos Eltern wünschen ihm eine Zukunft in welcher ihm alle Türen offen stehen, ohne das Vorurteile ihm den Weg versperren und ermutigen Ihne die Kantonsschule in Aarau zu besuchen. Entsprechend hat sich Mirko in der obligatorischen Schulzeit angestrengt und qualifiziert sich mit einem Notenschnitt von 5,4 ohne Probleme für die Kanti.</p><br>

                <p>Er hat sich also gegen eine Lehre entschieden, zumindest vorerst. Ob später ein Studium folgt, ist ihm noch nicht klar, doch bereits in die Arbeitswelt einsteigen steht für ihn ausserfrage. Seine Entscheidung ist kein Einzelfall.</p><br>

                <div class="chart-container">
                    <canvas id="chartGeneralEducationVsVocational"></canvas>
                </div>

                <p>Die Bevölkerung wächst zu, aber noch stärker nahm die Beliebtheit einer Allgemeinbildung zu. Die Grafik zeigt das die Beliebtheit der weiterführenden Schulen bei Schweizer:innen seit 2010 um ganze 6% zugenommen hat. Bei Zuwander:inne beträgt den Zuwachs sogar fast 9%.</p><br>
            </div>

            <div class="future">
                <div class="profil">
                    <img src="img/persona_future.svg" alt="Persona Future">
                    <h4>Xeno (15), wohnhaft in Urdorf <br> Angehender Fachmann Gesundheit EFZ</h4>
                </div>
                <p>Xeno gehört zu einer Generation, für die Smartphones, soziale Medien und künstliche Intelligenz selbstverständlich sind. Er erlebt, wie KI die Arbeitswelt verändert und gewisse Tätigkeiten zunehmend automatisiert werden. Besonders das Beispiel seines älteren Bruders, der trotz eines abgeschlossenen Bachelors in Grafikdesign nur schwer eine Stelle findet, hat ihn geprägt. </p><br>

                <p>Xeno möchte deshalb einen Beruf erlernen, bei dem der direkte Kontakt zu Menschen im Mittelpunkt steht. Statt eine Kantonsschule zu besuchen, entscheidet er sich, eine Berufslehre als Fachmann Gesundheit EFZ zu absolvieren.</p><br>

                <div class="chart-container">
                    <canvas id="chartPopulationPrognosis"></canvas>
                </div>

                <p>Auch in Zukunft wird sich die Zusammensetzung der Schweizer Bevölkerung verändern. Die Prognosen für die Jahre 2024 bis 2033 zeigen, wie sich sowohl die Schweizer Bevölkerung als auch die Bevölkerung ohne Schweizer Staatsangehörigkeit weiterentwickeln könnten. Diese Entwicklung beeinflusst unter anderem den Bedarf an Arbeitskräften und damit auch die Bedeutung verschiedener Berufsfelder.</p><br>

                <div class="chart-container">
                    <canvas id="chartFutureNewApprenticeships"></canvas>
                </div>

                <p> Xenos Entscheidung könnte sich in den kommenden Jahren in der Entwicklung der Berufsbildung widerspiegeln. Im Jahr 2025 traten 76'793 Personen eine Lehrstelle an. Für 2033 wird je nach Szenario mit 81'281 bis 88'118 Lehrantritten gerechnet. Die Prognosen deuten somit auf eine weitere Zunahme hin, wobei das tatsächliche Ausmass der Entwicklung auch von der Bevölkerungsentwicklung abhängig ist.</p>
            </div>
        </section>

        <section>
            <div class="text">
                <h2>Fazit </h2>

                <p>Die Entwicklung der letzten Jahre zeigt, dass sich sowohl die Schweizer Bevölkerung als auch die Bildungswege verändert haben. Während die Allgemeinbildung an Beliebtheit gewonnen hat, bleibt die Berufslehre ein wichtiger Bestandteil des Schweizer Bildungssystems. Auch die Prognosen zeigen, dass die Zahl der Lehrantritte in Zukunft weiter steigen könnte.</p><br>

                <p>Die Geschichten von Cloé, Mirko und Xeno veranschaulichen, wie unterschiedlich die Überlegungen bei der Berufswahl ausfallen können. Ihre Lebenssituationen stehen stellvertretend für verschiedene Herausforderungen, mit denen Jugendliche in unterschiedlichen Zeiten konfrontiert sind. Ob sich die Berufslehre langfristig im Verhältnis zur Allgemeinbildung behaupten kann, wird sich zeigen. Die Grafiken machen jedoch deutlich, dass es sich lohnt, die Entwicklung der Bildungswege gemeinsam mit dem Bevölkerungswachstum zu betrachten.</p>
            </div>
        </section>

        <section class="source">
            <span>
                Quelle: BFS | Bundesamt für Statistik. <br>
                Erhobener Zeitraum: 2010-2025 inkl. Prognose bis 2033/35
            </span>
        </section>
        
    </main>

    <footer>
        <a href="impressum.php">Impressum</a>
    </footer>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/dataVisualizer.js"></script>
</body>

</html>