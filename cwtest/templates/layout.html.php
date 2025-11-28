<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <header>
        <h1>Question Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="question.php">Questions</a></li>
                <li><a href="addquestion.php">Add Questions</a></li>
                <li><a href="admin/login/Login.html">Admin Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; Question Management System <?=date('Y')?></footer>
</body>
</html>