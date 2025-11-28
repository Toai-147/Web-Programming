<?php
try{
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    $jokes = allJokes($pdo);
    $title = 'Joke List';
    $totalJokes = totalJokes($pdo);

    ob_start();
    include '../templates/admin_joke.html.php';
    $output = ob_get_clean();
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
    include '../templates/admin_layout.html.php';