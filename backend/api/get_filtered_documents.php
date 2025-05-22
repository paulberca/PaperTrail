<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

require_once '../db/connection.php';

$type = isset($_GET['type']) ? $_GET['type'] : null;
$format = isset($_GET['format']) ? $_GET['format'] : null;

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
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($documents); 