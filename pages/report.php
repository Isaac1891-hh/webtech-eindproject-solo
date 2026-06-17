<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

$tasks = $pdo->query('SELECT * FROM tasks ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
$sensors = $pdo->query('SELECT * FROM sensor_data ORDER BY created_at DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="card">
    <h2>Rapport</h2>
    <p>Dit rapport kan via de browser worden afgedrukt als PDF. Dit is een eenvoudige extra functionaliteit.</p>
    <button class="no-print" onclick="window.print()">Print / opslaan als PDF</button>
</section>

<section class="card">
    <h2>Taken</h2>
    <?php foreach ($tasks as $task): ?>
        <div class="task">
            <h3><?= htmlspecialchars($task['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
            <p>Status: <?= htmlspecialchars($task['status']) ?></p>
        </div>
    <?php endforeach; ?>
</section>

<section class="card">
    <h2>Sensordata</h2>
    <?php foreach ($sensors as $sensor): ?>
        <p>
            <?= htmlspecialchars($sensor['created_at']) ?> -
            batterij <?= htmlspecialchars($sensor['battery']) ?>%,
            locatie <?= htmlspecialchars($sensor['latitude']) ?> / <?= htmlspecialchars($sensor['longitude']) ?>
        </p>
    <?php endforeach; ?>
</section>

<?php require_once '../includes/footer.php'; ?>
