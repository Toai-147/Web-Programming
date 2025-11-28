<h2>Manage Modules</h2>

<?php if (!empty($messages)): ?>
<div class="notice success">
    <ul>
        <?php foreach ($messages as $message): ?>
            <li><?=htmlspecialchars($message, ENT_QUOTES, 'UTF-8')?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
<div class="notice error">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<section class="panel">
    <h3>Add Module</h3>
    <form action="modules.php" method="post">
        <input type="hidden" name="mode" value="create">
        <label for="new-module-name">Module name</label>
        <input type="text" name="name" id="new-module-name" required>
        <button type="submit">Add Module</button>
    </form>
</section>

<?php if ($editingModule): ?>
<section class="panel highlight">
    <h3>Edit Module</h3>
    <form action="modules.php" method="post">
        <input type="hidden" name="mode" value="update">
        <input type="hidden" name="id" value="<?=$editingModule['id']?>">

        <label for="edit-module-name">Module name</label>
        <input type="text" name="name" id="edit-module-name" value="<?=htmlspecialchars($editingModule['Modulename'], ENT_QUOTES, 'UTF-8')?>" required>

        <button type="submit">Update Module</button>
        <a href="modules.php" class="button secondary">Cancel</a>
    </form>
</section>
<?php endif; ?>

<table>
    <thead>
        <tr>
            
            <th>Module</th>
            <th>Questions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($modules as $module): ?>
        <tr>
            
            <td><?=htmlspecialchars($module['Modulename'], ENT_QUOTES, 'UTF-8')?></td>
            <td><?=$module['question_count']?></td>
            <td>
                <a href="modules.php?edit=<?=$module['id']?>">Edit</a>
                <form action="modules.php" method="post" style="display:inline" onsubmit="return confirm('Delete this module?');">
                    <input type="hidden" name="mode" value="delete">
                    <input type="hidden" name="id" value="<?=$module['id']?>">
                    <button type="submit" <?=$module['question_count'] > 0 ? 'disabled' : ''?>>Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

