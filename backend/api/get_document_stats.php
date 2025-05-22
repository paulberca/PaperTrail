<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

require_once '../db/connection.php';

$sql = "SELECT 
    type,
    COUNT(*) as total_documents,
    SUM(pages) as total_pages,
    AVG(pages) as avg_pages,
    MIN(pages) as min_pages,
    MAX(pages) as max_pages,
    COUNT(DISTINCT author) as unique_authors,
    COUNT(DISTINCT format) as unique_formats
FROM documents 
GROUP BY type
ORDER BY total_documents DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stats); 