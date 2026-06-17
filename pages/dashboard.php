<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

$statusCounts = $pdo->query("SELECT status, COUNT(*) AS amount FROM tasks GROUP BY status")->fetchAll(PDO::FETCH_ASSOC);
$latestSensor = $pdo->query("SELECT * FROM sensor_data ORDER BY created_at DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$sensorRows = $pdo->query("SELECT * FROM sensor_data ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$amounts = [];
foreach ($statusCounts as $row) {
    $labels[] = $row['status'];
    $amounts[] = (int)$row['amount'];
}
?>

<section class="card">
    <h2>Dashboard</h2>
    <p>Deze pagina leest data uit MySQL en toont die met JavaScript libraries.</p>
</section>

<div class="grid">
    <section class="card">
        <h2>Taken per status</h2>
        <canvas id="taskChart"></canvas>
    </section>

    <section class="card">
        <h2>Laatste smartphone-data</h2>
        <?php if ($latestSensor): ?>
            <p>Batterij: <?= htmlspecialchars($latestSensor['battery']) ?>%</p>
            <p>Latitude: <?= htmlspecialchars($latestSensor['latitude']) ?></p>
            <p>Longitude: <?= htmlspecialchars($latestSensor['longitude']) ?></p>
            <p>Tijdstip: <?= htmlspecialchars($latestSensor['created_at']) ?></p>
        <?php else: ?>
            <p>Nog geen sensordata ontvangen.</p>
        <?php endif; ?>
    </section>
</div>

<section class="card">
    <h2>Kaart met laatste locatie</h2>
    <div id="map"></div>
</section>

<section class="card">
    <h2>Laatste 5 sensormetingen</h2>
    <?php foreach ($sensorRows as $row): ?>
        <p><?= htmlspecialchars($row['created_at']) ?> - batterij <?= htmlspecialchars($row['battery']) ?>%</p>
    <?php endforeach; ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const taskLabels = <?= json_encode($labels) ?>;
const taskAmounts = <?= json_encode($amounts) ?>;

new Chart(document.getElementById('taskChart'), {
    type: 'bar',
    data: {
        labels: taskLabels,
        datasets: [{
            label: 'Aantal taken',
            data: taskAmounts
        }]
    }
});

const latitude = <?= $latestSensor && $latestSensor['latitude'] ? $latestSensor['latitude'] : '51.2194' ?>;
const longitude = <?= $latestSensor && $latestSensor['longitude'] ? $latestSensor['longitude'] : '4.4025' ?>;

const map = L.map('map').setView([latitude, longitude], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);
L.marker([latitude, longitude]).addTo(map).bindPopup('Laatste smartphone-locatie').openPopup();
</script>

<?php require_once '../includes/footer.php'; ?>
