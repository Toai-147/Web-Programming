<h2>Manage Contact Messages</h2>
<p><?=$totalContacts?> contact messages have been submitted.</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?=$contact['id']?></td>
            <td><?=htmlspecialchars($contact['text'], ENT_QUOTES, 'UTF-8')?></td>
            <td>
                <form action="deletecontact.php" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?=$contact['id']?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

