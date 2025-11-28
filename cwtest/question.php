<?php
try{
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    $title = 'Question List';
    $totalQuestions = totalQuestions($pdo);
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $sortParam = isset($_GET['sort']) ? strtolower($_GET['sort']) : 'desc';
    $sortDirection = $sortParam === 'asc' ? 'ASC' : 'DESC';
    $currentSort = strtolower($sortDirection);

    if ($keyword !== '') {
        $questions = searchQuestions($pdo, $keyword, $sortDirection);
    } else {
        $questions = allQuestions($pdo, $sortDirection);
    }

    ob_start();
    include 'templates/question.html.php';
    $output = ob_get_clean();
}catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';