<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="questionid" value="<?= htmlspecialchars($question['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($question['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="questiontext">Edit your question here:</label>
    <textarea name="questiontext" id="questiontext" rows="3" cols="40" required><?= htmlspecialchars($question['questiontext'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>

    <label for="moduleid">Module:</label>
    <select name="moduleid" id="moduleid" required>
        <option value="">-- Select Module --</option>
        <?php foreach ($modules as $module): ?>
            <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>"
                <?= ($module['id'] == $question['moduleid']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($module['Modulename'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="userid">User:</label>
    <select name="userid" id="userid" required>
        <option value="">-- Select User --</option>
        <?php foreach ($users as $user): ?>
            <option value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>"
                <?= ($user['id'] == $question['userid']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="image">Replace image (optional):</label>
    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif,.webp">
    <?php if (!empty($question['image'])): ?>
        <p>Current image:</p>
        <img src="../image/<?= htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Current question image" style="max-width: 300px; display: block; margin-bottom: 1em;">
    <?php endif; ?>

    <input type="submit" name="submit" value="Save">
</form>