<?php
function totalQuestions($pdo){
    $query = $pdo->query('SELECT COUNT(*) FROM question');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function getQuestion($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * From question WHERE id = :id', $parameters);
    return $query->fetch();
}

function deleteQuestion($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM question WHERE id = :id', $parameters);
}

function addQuestion($pdo, $questiontext, $imageName, $userid, $moduleid) {
    $query = 'INSERT INTO question (questiontext, questiondate, image, userid, moduleid) 
             VALUES (:questiontext, CURDATE(), :image, :userid, :moduleid)';
    $parameters = [
        ':questiontext' => $questiontext,
        ':image' => $imageName,
        ':userid' => $userid,
        ':moduleid' => $moduleid
    ];
    query($pdo, $query, $parameters);
}

function updateQuestion($pdo, $id, $questiontext, $userid, $moduleid, $image = null) {
    $parameters = [
        ':id' => $id,
        ':questiontext' => $questiontext,
        ':userid' => $userid,
        ':moduleid' => $moduleid,
        ':image' => $image
    ];
    query(
        $pdo,
        'UPDATE question 
         SET questiontext = :questiontext,
             userid = :userid,
             moduleid = :moduleid,
             image = :image
         WHERE id = :id',
        $parameters
    );
}

function allUsers($pdo) {
    $users = query($pdo, 'SELECT * FROM user');
    return $users->fetchAll();
}

function getUser($pdo, $id) {
    $parameters = [':id' => $id];
    $user = query($pdo, 'SELECT * FROM user WHERE id = :id', $parameters);
    return $user->fetch();
}

function addUser($pdo, $name, $email) {
    $parameters = [
        ':name' => $name,
        ':email' => $email
    ];
    query($pdo, 'INSERT INTO user (name, email) VALUES (:name, :email)', $parameters);
}

function updateUserRecord($pdo, $id, $name, $email) {
    $parameters = [
        ':id' => $id,
        ':name' => $name,
        ':email' => $email
    ];
    query($pdo, 'UPDATE user SET name = :name, email = :email WHERE id = :id', $parameters);
}

function deleteUserRecord($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM user WHERE id = :id', $parameters);
}

function allUsersWithStats($pdo) {
    $users = query(
        $pdo,
        'SELECT user.id, user.name, user.email, COUNT(question.id) AS question_count
         FROM user
         LEFT JOIN question ON question.userid = user.id
         GROUP BY user.id, user.name, user.email
         ORDER BY user.name'
    );
    return $users->fetchAll();
}

function userQuestionCount($pdo, $id) {
    $parameters = [':id' => $id];
    $count = query(
        $pdo,
        'SELECT COUNT(*) FROM question WHERE userid = :id',
        $parameters
    );
    return (int) $count->fetchColumn();
}

function allModules($pdo) {
    $modules = query($pdo, 'SELECT * FROM module');
    return $modules->fetchAll();
}

function getModule($pdo, $id) {
    $parameters = [':id' => $id];
    $module = query($pdo, 'SELECT * FROM module WHERE id = :id', $parameters);
    return $module->fetch();
}

function addModule($pdo, $moduleName) {
    $parameters = [':name' => $moduleName];
    query($pdo, 'INSERT INTO module (Modulename) VALUES (:name)', $parameters);
}

function updateModuleRecord($pdo, $id, $moduleName) {
    $parameters = [
        ':id' => $id,
        ':name' => $moduleName
    ];
    query($pdo, 'UPDATE module SET Modulename = :name WHERE id = :id', $parameters);
}

function deleteModuleRecord($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM module WHERE id = :id', $parameters);
}

function allModulesWithStats($pdo) {
    $modules = query(
        $pdo,
        'SELECT module.id, module.Modulename, COUNT(question.id) AS question_count
         FROM module
         LEFT JOIN question ON question.moduleid = module.id
         GROUP BY module.id, module.Modulename
         ORDER BY module.Modulename'
    );
    return $modules->fetchAll();
}

function moduleQuestionCount($pdo, $id) {
    $parameters = [':id' => $id];
    $count = query(
        $pdo,
        'SELECT COUNT(*) FROM question WHERE moduleid = :id',
        $parameters
    );
    return (int) $count->fetchColumn();
}

function allQuestions($pdo, $order = 'DESC') {
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $questions = query(
        $pdo,
        "SELECT question.id, questiontext, questiondate, image, 
                user.name, user.email, module.Modulename 
         FROM question 
         INNER JOIN user ON question.userid = user.id
         INNER JOIN module ON question.moduleid = module.id
         ORDER BY question.id $order"
    );
    return $questions->fetchAll();
}

function searchQuestions($pdo, $keyword, $order = 'DESC') {
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $parameters = [':keyword' => '%' . $keyword . '%'];
    $questions = query(
        $pdo,
        "SELECT question.id, questiontext, questiondate, image,
                user.name, user.email, module.Modulename
         FROM question
         INNER JOIN user ON question.userid = user.id
         INNER JOIN module ON question.moduleid = module.id
         WHERE questiontext LIKE :keyword
         ORDER BY question.id $order",
        $parameters
    );
    return $questions->fetchAll(PDO::FETCH_ASSOC);
}

function addContact($pdo, $text) {
    $query = 'INSERT INTO contact (text) VALUES (:text)';
    $parameters = [':text' => $text];
    query($pdo, $query, $parameters);
}

function allContacts($pdo) {
    $contacts = query($pdo, 'SELECT * FROM contact ORDER BY id DESC');
    return $contacts->fetchAll();
}

function deleteContact($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM contact WHERE id = :id', $parameters);
}

function totalContacts($pdo) {
    $query = $pdo->query('SELECT COUNT(*) FROM contact');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}