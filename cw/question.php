<?php
try{
    include 'includes/DatabaseConnection.php';

    $sql = 'SELECT id, questiontext, image FROM question';
    $questions = $pdo->query($sql);
    $title = 'Question list';

    ob_start();
    include 'templates/question.html.php';
    $output = ob_get_clean();
}catch (PDOException $e) {
    $title = 'An error has occured';
    $output= 'Database error:' . $e->getMessage();
}
include 'templates/layout.html.php';