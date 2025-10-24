<?php foreach ($jokes as $joke): ?>
<div style="display:flex; align-items:center; gap:20px; border-bottom:1px solid #ccc; padding:10px 0;">
  
  <?php if (!empty($joke['image'])): ?>
    <div style="flex-shrink:0;">
      <img src="images/<?= htmlspecialchars($joke['image'], ENT_QUOTES, 'UTF-8'); ?>"
           alt="joke image" style="width:170px;">
    </div>
  <?php endif; ?>

  <div style="flex:1;">
    <p style="margin:0 0 8px 0;">
      <?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?>
    </p>
  </div>

  <div>
    <form action="deletejoke.php" method="post" style="margin:0;">
      <input type="hidden" name="id" value="<?= $joke['id'] ?>">
      <input type="submit" value="Delete" style="cursor:pointer;">
    </form>
  </div>
</div>
<?php endforeach; ?>
