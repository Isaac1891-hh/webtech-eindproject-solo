# Webtech Eindproject Solo - StudyTask Dashboard

Dit project is bewust eenvoudig gehouden omdat het individueel verdedigd moet worden. Het bevat wel alle belangrijke vereisten van de opdracht.

## Projectidee
StudyTask Dashboard is een kleine website waarop een student:
- taken kan toevoegen, bekijken en verwijderen;
- statistieken over taken kan bekijken;
- sensordata van een smartphone kan ontvangen via een REST API;
- data opslaat en uitleest uit een MySQL database;
- een eenvoudig PDF/print-rapport kan maken.

## Waarom solo?
De opdracht was oorspronkelijk bedoeld als groepswerk. Mijn groepsgenoot is gestopt met de richting. Daarom heb ik mijn eigen deel volledig uitgewerkt. De GitHub repository is wel zodanig gestructureerd dat een tweede persoon later gemakkelijk zou kunnen meewerken.

## Gebruikte technieken
- HTML en CSS voor structuur en lay-out
- PHP voor server-side functionaliteit
- MySQL voor opslag van taken en sensordata
- JavaScript voor client-side functionaliteit
- jQuery + Ajax voor taken toevoegen zonder pagina-refresh
- Chart.js voor grafieken
- Leaflet voor kaartweergave van smartphone-locatie
- REST API endpoint voor externe smartphone-data
- Git en GitHub voor versiebeheer en samenwerking

## Installatie met XAMPP
1. Plaats deze map in `C:/xampp/htdocs/`.
2. Start Apache en MySQL in XAMPP.
3. Open `http://localhost/phpmyadmin`.
4. Maak een database met de naam `webtech_solo`.
5. Importeer `database/schema.sql`.
6. Open in de browser:
   `http://localhost/webtech-eindproject-solo/`

## Databasegegevens
De verbinding staat in:
`includes/db.php`

Standaard:
- host: localhost
- database: webtech_solo
- user: root
- password: leeg

## Pagina's
### 1. Home / Takenbeheer
Bestand: `index.php`

Hier kan je taken toevoegen en verwijderen. De taken worden opgeslagen in MySQL. Toevoegen gebeurt via Ajax.

### 2. Dashboard
Bestand: `pages/dashboard.php`

Deze pagina toont statistieken over taken en sensordata. Chart.js wordt gebruikt voor een grafiek. Leaflet toont de laatst ontvangen locatie op een kaart.

### 3. Smartphone sensor
Bestand: `pages/sensor.php`

Deze pagina wordt geopend op een smartphone. De telefoon stuurt batterijpercentage en locatie naar de REST API.

### 4. Rapport
Bestand: `pages/report.php`

Deze pagina toont een rapport dat geprint kan worden naar PDF via de browser.

## REST API
Endpoint:
`api/save_sensor.php`

Deze API ontvangt JSON via POST.

Voorbeeld JSON:
```json
{
  "battery": 82,
  "latitude": 51.2194,
  "longitude": 4.4025
}
```

De data wordt opgeslagen in de tabel `sensor_data`.

## Git workflow
Voorbeeldbranches:
- `main`: stabiele versie
- `develop`: werkversie
- `feature/tasks`: takenbeheer
- `feature/dashboard`: grafieken en dashboard
- `feature/sensor-api`: REST API voor smartphone

Voorbeeldcommits:
```bash
git add .
git commit -m "Add database connection"
git commit -m "Create task overview page"
git commit -m "Add Ajax task creation"
git commit -m "Implement sensor REST endpoint"
git commit -m "Add dashboard chart"
```

## Wat ik tijdens de presentatie uitleg
- Git wordt gebruikt om elke stap op te slaan.
- GitHub dient als online backup en samenwerkingsplaats.
- PHP verwerkt de serverlogica en communiceert met MySQL.
- MySQL bewaart taken en sensordata.
- Ajax laat mij taken toevoegen zonder de volledige pagina te vernieuwen.
- REST wordt gebruikt omdat een smartphone data naar mijn server stuurt via HTTP POST.
- Chart.js en Leaflet zijn externe JavaScript libraries.
- Mijn smartphone werkt als extern apparaat en sensor door batterij en locatie door te sturen.

## Presentatiescript kort
Ik heb dit project alleen gemaakt omdat mijn groepsgenoot gestopt is met de richting. Ik heb wel gewerkt met een duidelijke GitHub-structuur zodat iemand later zou kunnen aansluiten.

Mijn website heet StudyTask Dashboard. Op de eerste pagina kan ik taken beheren. De taken worden via PHP opgeslagen in een MySQL database. Het toevoegen gebeurt met jQuery en Ajax, waardoor de pagina niet opnieuw moet laden.

Op het dashboard toon ik statistieken. Chart.js maakt een grafiek van het aantal taken per status. Leaflet toont de laatste locatie die mijn smartphone heeft doorgestuurd.

Mijn smartphone gebruikt de sensorpagina. Die pagina leest batterijpercentage en locatie uit en stuurt die via een REST API naar PHP. PHP slaat deze data op in de database.

Als extra functionaliteit heb ik een rapportpagina gemaakt die geprint kan worden als PDF.
