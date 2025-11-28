<?php
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    deleteContact($pdo, $_POST['id']);
    header('Location: contact.php');
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete contact: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';

