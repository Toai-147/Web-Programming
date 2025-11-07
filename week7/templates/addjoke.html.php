
<form action="addjoke.php" method="post" enctype="multipart/form-data">
    <label for="joketext">Type your joke here:</label>
    <textarea name="joketext" rows="3" cols="40" required></textarea>

    <label for="image">Select image:</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">

    <select name="category">
        <option value="">-- Select Category --
        <?php foreach ($categorys as $category): ?>
                <option value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
      
    </select>

    <select name="authorid" id="authorid" required>
        <option value="">-- Select Author --</option>
        <?php foreach ($authors as $author): ?>
                <option value="<?= htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
    </select>

    <input type="submit" name="submit" value="Add">
</form>
