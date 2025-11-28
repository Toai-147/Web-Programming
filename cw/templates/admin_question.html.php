<h2>Manage Questions</h2>
<p><?=$totalQuestions?> questions have been submitted.</p>

<form action="question.php" method="get" class="question-search-simple" style="margin-bottom: 1.5em;">
    <input type="text" name="keyword" placeholder="Search question text"
           value="<?= htmlspecialchars($keyword ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <select name="sort">
        <option value="desc" <?=$currentSort === 'desc' ? 'selected' : ''?>>Newest first</option>
        <option value="asc" <?=$currentSort === 'asc' ? 'selected' : ''?>>Oldest first</option>
    </select>
    <button type="submit">Search</button>
    <?php if (!empty($keyword)): ?>
        <a href="question.php" class="clear-search-link">Clear</a>
    <?php endif; ?>
</form>

<?php if (!empty($keyword) && empty($questions)): ?>
    <p class="notice">No questions found for "<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>".</p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Image</th>
            <th>Date</th>
            <th>User</th>
            <th>Module</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question): ?>
        <tr>
            <td><?=htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8')?></td>
            <td>
                <?php if (!empty($question['image'])): ?>
                    <img src="../image/<?=$question['image']?>" alt="Question Image" width="100">
                <?php endif; ?>
            </td>
            <td><?=$question['questiondate']?></td>
            <td><?=htmlspecialchars($question['name'], ENT_QUOTES, 'UTF-8')?></td>
            <td><?=htmlspecialchars($question['Modulename'], ENT_QUOTES, 'UTF-8')?></td>
            <td>
                <form action="editquestion.php" method="get" style="display: inline">
                    <input type="hidden" name="id" value="<?=$question['id']?>">
                    <input type="submit" value="Edit">
                </form>
                <form action="deletequestion.php" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?=$question['id']?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>