<?php foreach ($jokes as $joke): ?>
<blockquote>
  <?php if (!empty($joke['image'])): ?>
    <img src="images/<?= htmlspecialchars($joke['image'], ENT_QUOTES, 'UTF-8'); ?>"
         alt="joke image" style="max-width:240px; display:block; margin-bottom:8px;">
  <?php endif; ?>
  <?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?>

  <form action="deletejoke.php" method="post" style="margin-top:6px;">
    <input type="hidden" name="id" value="<?= $joke['id'] ?>">
    <input type="submit" value="Delete">
  </form>
</blockquote>
<?php endforeach; ?>
