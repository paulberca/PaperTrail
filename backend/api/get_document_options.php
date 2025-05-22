<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$data = [
    "types" => ["Report", "Invoice", "Letter", "Research Paper", "Memo"],
    "formats" => ["PDF", "DOCX", "TXT", "ODT"]
];

echo json_encode($data);
