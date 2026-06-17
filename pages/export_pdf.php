<?php

require_once '../includes/db.php';
require_once '../includes/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, 'StudyTask Dashboard Rapport', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Webtechnologie Eindproject', 0, 1);
$pdf->Ln(10);

// TAKEN
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Takenoverzicht', 0, 1);

$stmt = $pdo->query("
    SELECT title, description, status
    FROM tasks
    ORDER BY id DESC
");

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tasks as $task) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 8, $task['title'], 0, 1);

    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, $task['description']);

    $pdf->Cell(0, 8, 'Status: ' . $task['status'], 0, 1);
    $pdf->Ln(4);
}

// SENSOR DATA
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laatste smartphone-data', 0, 1);

$stmt = $pdo->query("
    SELECT battery, latitude, longitude, created_at
    FROM sensor_data
    ORDER BY id DESC
    LIMIT 1
");

$sensor = $stmt->fetch(PDO::FETCH_ASSOC);

$pdf->SetFont('Arial', '', 11);

if ($sensor) {
    $pdf->Cell(0, 8, 'Batterij: ' . $sensor['battery'], 0, 1);
    $pdf->Cell(0, 8, 'Latitude: ' . $sensor['latitude'], 0, 1);
    $pdf->Cell(0, 8, 'Longitude: ' . $sensor['longitude'], 0, 1);
    $pdf->Cell(0, 8, 'Tijdstip: ' . $sensor['created_at'], 0, 1);
} else {
    $pdf->Cell(0, 8, 'Er is nog geen smartphone-data ontvangen.', 0, 1);
}

$pdf->Output('I', 'studytask-rapport.pdf');