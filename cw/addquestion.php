<?php
require 'includes/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questiontext = trim($_POST['text'] ?? '');
    if ($questiontext === '') {
        die('Question text cannot be empty.');
    }

    // Validate POST data
    $userid = $_POST['userid'] ?? null;
    $moduleid = $_POST['moduleid'] ?? null;
    
    if (!$userid || !$moduleid) {
        die('Please select both a user and module');
    }

    $imageName = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            die('File upload failed with code: ' . $_FILES['image']['error']);
        }

        if ($_FILES['image']['size'] > 10 * 1024 * 1024) {
            die('Image too large. Max 10MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['image']['tmp_name']);
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp'
        ];
        if (!isset($allowed[$mime])) {
            die('Invalid image type.');
        }

        $ext = $allowed[$mime];
        $imageName = bin2hex(random_bytes(8)) . '.' . $ext;

        $uploadDir = __DIR__ . '/image';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destination = $uploadDir . '/' . $imageName;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            die('Failed to move uploaded image.');
        }
    }

    $sql = 'INSERT INTO question (questiontext, questiondate, image, userid, moduleid) 
            VALUES (:questiontext, CURDATE(), :image, :userid, :moduleid)';
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':questiontext' => $questiontext,
            ':image' => $imageName,
            ':userid' => $userid,
            ':moduleid' => $moduleid
        ]);

        header('Location: question.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Error adding question: ' . $e->getMessage();
    }
} else {
    $title = 'Add a new Question';
    $sql_u = 'SELECT * FROM user';
    $users = $pdo->query($sql_u);
    $sql_m = 'SELECT * FROM module';
    $modules = $pdo->query($sql_m);
    
    ob_start();
    include 'templates/addquestion.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
?>