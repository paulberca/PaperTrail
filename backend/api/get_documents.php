<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

header('Content-Type: application/json');

require_once '../db/connection.php';

$type = $_GET['type'] ?? '';
$format = $_GET['format'] ?? '';

$sql = "SELECT * FROM documents WHERE 1=1";
$params = [];

if ($type) {
    $sql .= " AND type = ?";
    $params[] = $type;
}
if ($format) {
    $sql .= " AND format = ?";
    $params[] = $format;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
