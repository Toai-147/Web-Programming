<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../question.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <header id = "admin">
        <h1>Question Management System - Admin</h1>
        <nav>
            <ul>
                <li><a href="question.php">Question</a></li>
                <li><a href="addquestion.php">Add Question</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="modules.php">Modules</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="../index.php">Public Site/Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; Question Management System <?=date('Y')?></footer>
</body>
</html>