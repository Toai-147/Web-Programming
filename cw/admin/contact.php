<?php
require "login/Check.php";
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    $contacts = allContacts($pdo);
    $title = 'Contact Messages';
    $totalContacts = totalContacts($pdo);

    ob_start();
    include '../templates/admin_contact.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';

