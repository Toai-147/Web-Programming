<?php
include 'include/DatabaseConnection.php';
include 'include/DatabaseFunctions.php';
try{
    if(isset($_POST['joketext'])){
        updateJoke($pdo, $_POST['jokeid'], $_POST['joketext']);
        header('location: jokes.php');
    }else{
        $joke = getJokes($pdo, $_GET['id']);
        $title = 'Edit Joke';

        ob_start();
        include 'templates/editjoke.html.php';
        $output = ob_get_clean();
    }
}catch (PDOException $e){
    $title = 'An error has occurred';
    $output = 'Error editing joke: ' . $e->getMessage();
}
include 'templates/layout.html.php';