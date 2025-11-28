<?php
try{
    include 'include/DatabaseConnection.php';
    include 'include/DatabaseFunctions.php';

    deleteJoke($pdo, $_POST['id']);
    header('Location: jokes.php');
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to delete joke: ' . $e->getMessage();
}
    include 'templates/layout.html.php';
