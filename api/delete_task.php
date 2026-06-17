<?php
require_once '../includes/db.php';
header('Content-Type: application/json');

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false]);
    exit;
}

$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
$stmt->execute([$id]);

echo json_encode(['success' => true]);
?>
