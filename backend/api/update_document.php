<?php
header('Content-Type: application/json');
require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE documents SET author = ?, title = ?, pages = ?, type = ?, format = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$data['author'], $data['title'], $data['pages'], $data['type'], $data['format'], $data['id']]);

echo json_encode(['success' => true]);
