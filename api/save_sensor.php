<?php
require_once '../includes/db.php';
header('Content-Type: application/json');

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Geen geldige JSON ontvangen.']);
    exit;
}

$battery = isset($data['battery']) ? (int)$data['battery'] : null;
$latitude = isset($data['latitude']) ? (float)$data['latitude'] : null;
$longitude = isset($data['longitude']) ? (float)$data['longitude'] : null;

$stmt = $pdo->prepare('INSERT INTO sensor_data (battery, latitude, longitude) VALUES (?, ?, ?)');
$stmt->execute([$battery, $latitude, $longitude]);

echo json_encode(['success' => true, 'message' => 'Sensordata opgeslagen.']);
?>
