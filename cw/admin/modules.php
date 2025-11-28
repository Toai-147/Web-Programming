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

    try {
        if ($mode === 'create') {
            if ($name === '') {
                $errors[] = 'Module name is required.';
            } else {
                addModule($pdo, $name);
                $messages[] = 'Module added successfully.';
            }
        } elseif ($mode === 'update') {
            if (!$id) {
                $errors[] = 'Missing module ID for update.';
            } elseif ($name === '') {
                $errors[] = 'Module name is required.';
            } else {
                if (!getModule($pdo, $id)) {
                    $errors[] = 'The selected module could not be found.';
                } else {
                    updateModuleRecord($pdo, $id, $name);
                    $messages[] = 'Module updated successfully.';
                }
            }
        } elseif ($mode === 'delete') {
            if (!$id) {
                $errors[] = 'Missing module ID for delete.';
            } else {
                $questionCount = moduleQuestionCount($pdo, $id);
                if ($questionCount > 0) {
                    $errors[] = 'Cannot delete a module that is still used by questions.';
                } else {
                    deleteModuleRecord($pdo, $id);
                    $messages[] = 'Module deleted successfully.';
                }
            }
        }
    } catch (PDOException $e) {
        $errors[] = 'Database error: ' . $e->getMessage();
    }
}

$editingModule = null;
if (isset($_GET['edit'])) {
    $editId = (int) $_GET['edit'];
    if ($editId > 0) {
        $editingModule = getModule($pdo, $editId);
        if (!$editingModule) {
            $errors[] = 'The requested module was not found.';
        }
    }
}

$modules = allModulesWithStats($pdo);
$title = 'Manage Modules';

ob_start();
include '../templates/admin_modules.html.php';
$output = ob_get_clean();

include '../templates/admin_layout.html.php';

