<form action="addquestion.php" method="post" enctype="multipart/form-data">
    <label for="text">Type your question here:</label>
    <textarea name="text" id="text" rows="3" cols="40" required></textarea>

    <label for="image">Select image:</label>
    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif,.webp">

    <label for="moduleid">Module:</label>
    <select name="moduleid" id="moduleid" required>
        <option value="">-- Select Module --</option>
        <?php foreach ($modules as $module): ?>
            <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($module['Modulename'], ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="userid">User:</label>
    <select name="userid" id="userid" required>
        <option value="">-- Select User --</option>
        <?php foreach ($users as $user): ?>
            <option value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Add Question">
</form>