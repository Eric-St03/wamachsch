## Learners



### Datapoints:

year | training\_type | total | swiss | foreigners

Optional: Kantonsfelder, wenn sie mit canton\[] ausgewählt werden.



### Base query:

unload.php?learners=true



### Filters:

training\_type | canton\[] | start\_year | end\_year



canton\[] kann mehrfach angegeben werden. Zulässige Werte:

zurich, bern, uri, schwyz, obwalden, nidwalden, glarus, zug, fribourg, solothurn, basel\_stadt, basel\_landschaft, schaffhausen, appenzell\_ausserrhoden, appenzell\_innerrhoden, st\_gallen, grisons, aargau, thurgau, ticino, vaud, valais, neuchatel, geneva, jura



Ohne canton\[] werden keine einzelnen Kantonsfelder zurückgegeben.







## New apprenticeships by industry



### Datapoints:

year | office\_work | materials | construction | social\_work



### Base query:

unload.php?new\_apprenticeships\_by\_industry=true



### Filters:

industry\[] | start\_year | end\_year



industry\[] kann mehrfach angegeben werden. Zulässige Werte: office\_work, materials, construction, social\_work



Ohne industry\[] werden alle vier Branchen zurückgegeben.







## Future new apprenticeships



### Datapoints:

year | reference\_scenario | high\_scenario | low\_scenario



### Base query:

unload.php?future\_new\_apprenticeships=true



### Filters:

scenario\[] | start\_year | end\_year



scenario\[] kann mehrfach angegeben werden. Zulässige Werte:

reference, high, low



Ohne scenario\[] werden alle drei Szenarien zurückgegeben.



## Population by birthplace



### Datapoints:

year | total | swiss | foreigners



### Base query:

unload.php?population\_by\_birthplace=true



### Filters:

start\_year | end\_year

Beide Jahresgrenzen sind inklusive. Ohne Filter werden alle verfügbaren Jahre zurückgegeben.







## Future population by birthplace



### Datapoints:

year | total\_reference\_scenario | total\_high\_scenario | total\_low\_scenario | swiss\_reference\_scenario | swiss\_high\_scenario | swiss\_low\_scenario | foreigners\_reference\_scenario | foreigners\_high\_scenario | foreigners\_low\_scenario



### Base query:

unload.php?future\_population\_by\_birthplace=true



### Filters:

scenario\[] | start\_year | end\_year



scenario\[] kann mehrfach angegeben werden. Zulässige Werte:

reference, high, low



Ohne scenario\[] werden alle Szenarien für total, swiss und foreigners zurückgegeben.

Mit scenario\[] werden nur die gewählten Szenarien zurückgegeben; für jedes davon erscheinen die Werte für alle drei Gruppen.







## Allgemeine Hinweise



\- start\_year und end\_year sind inklusive.

\- Filter für mehrere Werte werden wiederholt angegeben, zum Beispiel:

&#x20; unload.php?future\_new\_apprenticeships=true\&scenario\[]=reference\&scenario\[]=high

\- Pro Anfrage sollte nur ein Datensatzparameter auf true gesetzt werden.

\- Die Antwort ist ein JSON-Array.



