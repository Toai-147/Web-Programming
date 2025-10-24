<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="question.css">
    <title><?=$title?></title>
</head>
<body>
    <header><h1>Student Forum</h1></header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="question.php">question List</a></li>
            <li><a href="addquestion.php">Add a new question</a></li>
        </ul>
    </nav>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; IJDB 2023</footer>
</body>
</html>