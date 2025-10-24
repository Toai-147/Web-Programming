<?php
try{
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM question WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', $_POST['id']);
    $stmt->execute();
    header('location: question.php');
}catch(PDOException $e) {
    $title = 'An error has occured';
    $output = 'Unable to delete question: ' . $e->getMessage();
}
include 'templates/layout.html.php';