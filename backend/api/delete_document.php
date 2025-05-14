<?php
header('Content-Type: application/json');
require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "DELETE FROM documents WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$data['id']]);

echo json_encode(['success' => true]);
