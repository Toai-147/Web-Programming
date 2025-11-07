<?php
function totalJokes($pdo){
    $query = $pdo->query('SELECT COUNT(*) FROM joke');
    $query ->execute();
    $row = $query->fetch();
    return $row[0];
}
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function getJokes($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * From joke WHERE id = :id', $parameters);
    return $query->fetch();
}

function deleteJoke($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM joke WHERE id = :id', $parameters);
}

function addJoke($pdo, $joketext, $imageName, $authorid, $categoryid) {
    $query = 'INSERT INTO joke (joketext, jokedate, Image, authorid, categoryid) VALUES (:joketext, CURDATE(), :image, :authorid, :categoryid)';
    $parameters = [
        ':joketext' => $joketext,
        ':image' => $imageName,
        ':authorid' => $authorid,
        ':categoryid' => $categoryid
    ];
    $query = query($pdo, $query, $parameters);
}

function AllAuthors($pdo) {
    $authors = query($pdo, 'SELECT * FROM author');
    return $authors->fetchAll();
}

function AllCategorys($pdo) {
    $categorys = query($pdo, 'SELECT * FROM category');
    return $categorys->fetchAll();
}

function allJokes($pdo) {
    $jokes = query($pdo, 'SELECT joke.id, joketext, jokedate, Image, author.name, author.email, categoryName FROM joke 
            INNER JOIN author ON joke.authorid = author.id
            INNER JOIN category ON joke.categoryid = category.id
            ORDER BY joke.id DESC');
    return $jokes->fetchAll();
}
