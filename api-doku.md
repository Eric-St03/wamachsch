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

year | total | office_work | materials | construction | social_work audiovisual_techniques_and_media_production | fashion_interior_and_industrial_design | crafts | music_and_performing_arts | library_information_and_archives | business_and_administration_unspecified | management_and_administration | wholesale_and_retail | computer_use | databases_network_design_and_administration | software_and_application_development_and_analysis | engineering_and_technical_professions_unspecified | chemical_and_process_engineering | environmental_protection_technologies | electricity_and_energy | electronics_and_automation | mechanical_and_metalworking | motor_vehicles_ships_and_aircraft | food | textiles_clothing_footwear_and_leather | architecture_and_urban_planning | crop_and_animal_production | horticulture | forestry | veterinary | dentistry | nursing_and_midwifery | medical_diagnostics_and_treatment_technology | therapy_and_rehabilitation | pharmacy | care_of_older_or_disabled_people | child_and_youth_work | interdisciplinary_health_and_social_programmes | domestic_services | hairdressing_and_beauty_treatment | hospitality_and_catering | sport | transport_services

### Base query:

unload.php?new_apprenticeships_by_industry=true

### Filters:

industry[] | start_year | end_year

industry[] kann mehrfach angegeben werden. Zulässige Branchen: 

office_work, materials, construction, social_work

Sekundär:

audiovisual_techniques_and_media_production, fashion_interior_and_industrial_design, crafts, music_and_performing_arts, library_information_and_archives, business_and_administration_unspecified, management_and_administration, wholesale_and_retail, computer_use, databases_network_design_and_administration, software_and_application_development_and_analysis, engineering_and_technical_professions_unspecified, chemical_and_process_engineering, environmental_protection_technologies, electricity_and_energy, electronics_and_automation, mechanical_and_metalworking, motor_vehicles_ships_and_aircraft, food, textiles_clothing_footwear_and_leather, architecture_and_urban_planning, crop_and_animal_production, horticulture, forestry, veterinary, dentistry, nursing_and_midwifery, medical_diagnostics_and_treatment_technology, therapy_and_rehabilitation, pharmacy, care_of_older_or_disabled_people, child_and_youth_work, interdisciplinary_health_and_social_programmes, domestic_services, hairdressing_and_beauty_treatment, hospitality_and_catering, sport, transport_services.

Ohne industry[] werden alle Branchen zurückgegeben.


**Example:** unload.php?new_apprenticeships_by_industry=true&industry[]=office_work&industry[]=materials&industry[]=construction&industry[]=social_work&start_year=2010&end_year=2025



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



