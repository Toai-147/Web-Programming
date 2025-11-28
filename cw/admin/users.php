<?php
require 'login/Check.php';

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$errors = [];
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode = $_POST['mode'] ?? '';
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    try {
        if ($mode === 'create') {
            if ($name === '' || $email === '') {
                $errors[] = 'Name and email are required to add a user.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please provide a valid email address.';
            } else {
                addUser($pdo, $name, $email);
                $messages[] = 'User added successfully.';
            }
        } elseif ($mode === 'update') {
            if (!$id) {
                $errors[] = 'Missing user ID for update.';
            } elseif ($name === '' || $email === '') {
                $errors[] = 'Name and email are required to update a user.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please provide a valid email address.';
            } else {
                if (!getUser($pdo, $id)) {
                    $errors[] = 'The selected user could not be found.';
                } else {
                    updateUserRecord($pdo, $id, $name, $email);
                    $messages[] = 'User updated successfully.';
                }
            }
        } elseif ($mode === 'delete') {
            if (!$id) {
                $errors[] = 'Missing user ID for delete.';
            } else {
                $questionCount = userQuestionCount($pdo, $id);
                if ($questionCount > 0) {
                    $errors[] = 'Cannot delete a user who still has questions assigned.';
                } else {
                    deleteUserRecord($pdo, $id);
                    $messages[] = 'User deleted successfully.';
                }
            }
        }
    } catch (PDOException $e) {
        $errors[] = 'Database error: ' . $e->getMessage();
    }
}

$editingUser = null;
if (isset($_GET['edit'])) {
    $editId = (int) $_GET['edit'];
    if ($editId > 0) {
        $editingUser = getUser($pdo, $editId);
        if (!$editingUser) {
            $errors[] = 'The requested user was not found.';
        }
    }
}

$users = allUsersWithStats($pdo);
$title = 'Manage Users';

ob_start();
include '../templates/admin_users.html.php';
$output = ob_get_clean();

include '../templates/admin_layout.html.php';

