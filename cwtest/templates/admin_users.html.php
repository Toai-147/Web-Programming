<h2>Manage Users</h2>

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
    <h3>Add User</h3>
    <form action="users.php" method="post">
        <input type="hidden" name="mode" value="create">
        <label for="new-name">Name</label>
        <input type="text" name="name" id="new-name" required>

        <label for="new-email">Email</label>
        <input type="email" name="email" id="new-email" required>

        <button type="submit">Add User</button>
    </form>
</section>

<?php if ($editingUser): ?>
<section class="panel highlight">
    <h3>Edit User</h3>
    <form action="users.php" method="post">
        <input type="hidden" name="mode" value="update">
        <input type="hidden" name="id" value="<?=$editingUser['id']?>">

        <label for="edit-name">Name</label>
        <input type="text" name="name" id="edit-name" value="<?=htmlspecialchars($editingUser['name'], ENT_QUOTES, 'UTF-8')?>" required>

        <label for="edit-email">Email</label>
        <input type="email" name="email" id="edit-email" value="<?=htmlspecialchars($editingUser['email'], ENT_QUOTES, 'UTF-8')?>" required>

        <button type="submit">Update User</button>
        <a href="users.php" class="button secondary">Cancel</a>
    </form>
</section>
<?php endif; ?>

<table>
    <thead>
        <tr>
            
            <th>Name</th>
            <th>Email</th>
            <th>Questions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            
            <td><?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?></td>
            <td><a href="mailto:<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?></a></td>
            <td><?=$user['question_count']?></td>
            <td>
                <a href="users.php?edit=<?=$user['id']?>">Edit</a>
                <form action="users.php" method="post" style="display:inline" onsubmit="return confirm('Delete this user?');">
                    <input type="hidden" name="mode" value="delete">
                    <input type="hidden" name="id" value="<?=$user['id']?>">
                    <button type="submit" <?=$user['question_count'] > 0 ? 'disabled' : ''?>>Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

