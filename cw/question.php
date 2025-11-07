<?php
try{
    include 'includes/DatabaseConnection.php';

    $sql = 'SELECT question.id, questiontext, questiondate, image, user.name, user.email, Modulename FROM question 
            INNER JOIN user ON question.userid = user.id
            INNER JOIN module ON question.moduleid = module.id
            ORDER BY question.id DESC';
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