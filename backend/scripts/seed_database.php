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
    ],
    [
        'author' => 'Emma Thompson',
        'title' => 'User Interface Design Document',
        'pages' => 19,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Lucas Rodriguez',
        'title' => 'Sales Forecast Q2 2024',
        'pages' => 11,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Ava Wilson',
        'title' => 'Employee Training Manual',
        'pages' => 42,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Mason Brown',
        'title' => 'Vendor Agreement',
        'pages' => 7,
        'type' => 'Legal Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Charlotte Davis',
        'title' => 'Project Status Update',
        'pages' => 4,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Elijah Taylor',
        'title' => 'System Architecture Overview',
        'pages' => 31,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Amelia White',
        'title' => 'Marketing Campaign Brief',
        'pages' => 13,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Benjamin Clark',
        'title' => 'Code Review Guidelines',
        'pages' => 8,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Mia Garcia',
        'title' => 'Customer Support Protocol',
        'pages' => 6,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Henry Martinez',
        'title' => 'Financial Audit Report',
        'pages' => 29,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Evelyn Robinson',
        'title' => 'Product Requirements Document',
        'pages' => 23,
        'type' => 'Technical Document',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Alexander Wright',
        'title' => 'Database Migration Plan',
        'pages' => 17,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Victoria Chen',
        'title' => 'Customer Onboarding Guide',
        'pages' => 25,
        'type' => 'Technical Document',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Sebastian Lee',
        'title' => 'API Documentation v2.0',
        'pages' => 38,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Grace Taylor',
        'title' => 'Monthly Newsletter',
        'pages' => 3,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Owen Martinez',
        'title' => 'Server Maintenance Schedule',
        'pages' => 9,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Lily Anderson',
        'title' => 'Brand Guidelines 2024',
        'pages' => 21,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Gabriel White',
        'title' => 'Security Incident Report',
        'pages' => 12,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Chloe Brown',
        'title' => 'Employee Handbook Update',
        'pages' => 33,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Nathan Clark',
        'title' => 'Software Release Notes',
        'pages' => 5,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Zoe Garcia',
        'title' => 'Data Privacy Policy',
        'pages' => 14,
        'type' => 'Legal Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Caleb Wilson',
        'title' => 'Infrastructure Upgrade Plan',
        'pages' => 27,
        'type' => 'Technical Document',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Hannah Moore',
        'title' => 'Customer Survey Results',
        'pages' => 8,
        'type' => 'Report',
        'format' => 'PDF'
    ],
    [
        'author' => 'Isaac Thompson',
        'title' => 'Development Roadmap',
        'pages' => 19,
        'type' => 'Technical Document',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Aria Rodriguez',
        'title' => 'Team Building Event Plan',
        'pages' => 4,
        'type' => 'Memo',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Leo Davis',
        'title' => 'Cloud Migration Strategy',
        'pages' => 31,
        'type' => 'Technical Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Nora Taylor',
        'title' => 'Quality Assurance Report',
        'pages' => 16,
        'type' => 'Report',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Max Wilson',
        'title' => 'Service Level Agreement',
        'pages' => 11,
        'type' => 'Legal Document',
        'format' => 'PDF'
    ],
    [
        'author' => 'Ruby Anderson',
        'title' => 'User Research Findings',
        'pages' => 24,
        'type' => 'Research Paper',
        'format' => 'DOCX'
    ],
    [
        'author' => 'Felix Brown',
        'title' => 'System Performance Analysis',
        'pages' => 29,
        'type' => 'Technical Document',
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