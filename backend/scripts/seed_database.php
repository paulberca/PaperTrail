<?php
require_once __DIR__ . '/../db/connection.php';

// Sample document data
$documents = [
    [
        'author' => 'John Smith',
        'title' => 'Q1 Financial Report',
        'pages' => 45,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Sarah Johnson',
        'title' => 'Client Meeting Notes',
        'pages' => 3,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Michael Brown',
        'title' => 'Research on Market Trends',
        'pages' => 28,
        'type' => 'Research Paper',
        'format' => 'PDF'
    ],
    [
        'author' => 'Emily Davis',
        'title' => 'Invoice #2024-001',
        'pages' => 2,
        'type' => 'Invoice',
        'format' => 'PDF'
    ],
    [
        'author' => 'Robert Wilson',
        'title' => 'Project Proposal',
        'pages' => 15,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Lisa Anderson',
        'title' => 'Client Contract',
        'pages' => 8,
        'type' => 'Letter',
        'format' => 'PDF'
    ],
    [
        'author' => 'David Miller',
        'title' => 'Technical Documentation',
        'pages' => 32,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Jennifer Taylor',
        'title' => 'Meeting Agenda',
        'pages' => 1,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'James Wilson',
        'title' => 'Academic Research Paper',
        'pages' => 24,
        'type' => 'Research Paper',
        'format' => 'PDF'
    ],
    [
        'author' => 'Patricia Moore',
        'title' => 'Business Proposal',
        'pages' => 12,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Thomas Wright',
        'title' => 'Annual Performance Review',
        'pages' => 6,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Rachel Green',
        'title' => 'Marketing Strategy 2024',
        'pages' => 18,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Daniel Lee',
        'title' => 'Software Architecture Design',
        'pages' => 35,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Sophia Chen',
        'title' => 'Customer Feedback Analysis',
        'pages' => 9,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'William Turner',
        'title' => 'Legal Brief - Case #2024-15',
        'pages' => 22,
        'type' => 'Legal Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Olivia Martinez',
        'title' => 'Product Launch Plan',
        'pages' => 14,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Ethan Parker',
        'title' => 'Network Security Audit',
        'pages' => 27,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Isabella Kim',
        'title' => 'HR Policy Update',
        'pages' => 5,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Noah Anderson',
        'title' => 'Quarterly Budget Review',
        'pages' => 16,
        'type' => 'Report',
        'format' => 'PDF'
    ]
];

// Clear existing data
$pdo->exec("TRUNCATE TABLE documents");

// Insert new data
$sql = "INSERT INTO documents (author, title, pages, type, format) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$inserted = 0;
foreach ($documents as $doc) {
    try {
        $stmt->execute([
            $doc['author'],
            $doc['title'],
            $doc['pages'],
            $doc['type'],
            $doc['format']
        ]);
        $inserted++;
    } catch (PDOException $e) {
        echo "Error inserting document: " . $e->getMessage() . "\n";
    }
}

echo "Successfully inserted $inserted documents into the database.\n"; 