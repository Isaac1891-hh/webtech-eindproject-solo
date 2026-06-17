<?php
require_once '../includes/db.php';
header('Content-Type: application/json');

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$status = $_POST['status'] ?? 'open';

$allowedStatuses = ['open', 'bezig', 'klaar'];

if ($title === '' || !in_array($status, $allowedStatuses)) {
    echo json_encode(['success' => false, 'message' => 'Ongeldige invoer.']);
    exit;
}

$stmt = $pdo->prepare('INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)');
$stmt->execute([$title, $description, $status]);

$id = $pdo->lastInsertId();

echo json_encode([
    'success' => true,
    'task' => [
        'id' => $id,
        'title' => htmlspecialchars($title),
        'description' => htmlspecialchars($description),
        'status' => htmlspecialchars($status)
    ]
]);
?>
