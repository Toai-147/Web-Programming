<?php
try{
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    deleteQuestion($pdo, $_POST['id']);
    header('Location: question.php');
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete question: ' . $e->getMessage();
}
include 'templates/layout.html.php';