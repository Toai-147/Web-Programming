<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
try{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $questionId = $_POST['questionid'] ?? null;
        $questiontext = trim($_POST['questiontext'] ?? '');
        $userid = $_POST['userid'] ?? null;
        $moduleid = $_POST['moduleid'] ?? null;
        $currentImage = $_POST['existing_image'] ?? null;
        $imageName = $currentImage ?: null;

        if(!$questionId || $questiontext === '' || !$userid || !$moduleid){
            throw new Exception('Please provide all required fields.');
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('File upload failed with code: ' . $_FILES['image']['error']);
            }

            if ($_FILES['image']['size'] > 10 * 1024 * 1024) {
                throw new Exception('Image too large. Max 10MB.');
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
                throw new Exception('Invalid image type.');
            }

            $ext = $allowed[$mime];
            $imageName = bin2hex(random_bytes(8)) . '.' . $ext;

            $uploadDir = __DIR__ . '/image';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $destination = $uploadDir . '/' . $imageName;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                throw new Exception('Failed to move uploaded image.');
            }
        }

        updateQuestion($pdo, $questionId, $questiontext, $userid, $moduleid, $imageName);
        header('location: question.php');
        exit;
    }else{
        $question = getQuestion($pdo, $_GET['id']);
        $users = allUsers($pdo);
        $modules = allModules($pdo);
        $title = 'Edit Question';

        ob_start();
        include 'templates/editquestion.html.php';
        $output = ob_get_clean();
    }
}catch (PDOException $e){
    $title = 'An error has occurred';
    $output = 'Error editing question: ' . $e->getMessage();
}catch (Exception $e){
    $title = 'An error has occurred';
    $output = 'Error editing question: ' . $e->getMessage();
}
include 'templates/layout.html.php';