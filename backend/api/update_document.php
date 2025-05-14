<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Document ID is required']);
    exit;
}

$sql = "UPDATE documents SET author = ?, title = ?, pages = ?, type = ?, format = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $data['author'],
    $data['title'],
    $data['pages'],
    $data['type'],
    $data['format'],
    $data['id']
]);

echo json_encode(['success' => true]);
