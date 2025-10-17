<?php
if(isset($_POST['joketext'])){
    try{
        include 'includes/DatabaseConnection.php';

        $filename = null;
        if (!empty($_FILES['image']['name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $safe = bin2hex(random_bytes(8)) . '.' . strtolower($ext);
            $imgDir = __DIR__ . '/images';
            if (!is_dir($imgDir)) { mkdir($imgDir, 0777, true); }
            move_uploaded_file($_FILES['image']['tmp_name'], $imgDir . '/' . $safe);
            $filename = $safe;
        }

        $sql = 'INSERT INTO joke SET
            joketext = :joketext,
            jokedate = CURDATE()';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':joketext', $_POST['joketext']);
            $stmt->execute();
            header('location: jokes.php');
    }catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error:' . $e->getMessage();
    }
}else{
    $title = 'Add a new joke';
    ob_start();
    include 'templates/addjoke.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';