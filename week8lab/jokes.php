<?php
require "login/Check.php";
try{
    include 'include/DatabaseConnection.php';
    include 'include/DatabaseFunctions.php';

    $jokes = allJokes($pdo);
    $title = 'Joke List';
    $totalJokes = totalJokes($pdo);

    ob_start();
    include 'templates/jokes.html.php';
    $output = ob_get_clean();
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
    include 'templates/layout.html.php';