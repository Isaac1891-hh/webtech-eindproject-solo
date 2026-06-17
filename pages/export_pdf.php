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

$pdf->Output();