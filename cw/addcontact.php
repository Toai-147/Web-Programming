<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contacttext = trim($_POST['contacttext'] ?? '');
    
    if ($contacttext === '') {
        $title = 'Error';
        $output = 'Contact message cannot be empty.';
    } else {
        try {
            addContact($pdo, $contacttext);
            header('Location: index.php?contact=success');
            exit;
        } catch (PDOException $e) {
            $title = 'Error';
            $output = 'Error submitting contact: ' . $e->getMessage();
        }
    }
} else {
    header('Location: index.php');
    exit;
}

include 'templates/layout.html.php';
?>

