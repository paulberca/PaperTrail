<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "INSERT INTO documents (author, title, pages, type, format) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$data['author'], $data['title'], $data['pages'], $data['type'], $data['format']]);

echo json_encode(['success' => true]);
