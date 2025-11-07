<?php foreach ($questions as $question): ?>
<div style="display:flex; align-items:center; gap:20px; border-bottom:1px solid #ccc; padding:10px 0;">
  
  <?php if (!empty($question['image'])): ?>
    <div style="flex-shrink:0;">
      <img src="image/<?= htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8'); ?>"
           alt="question image" style="width:170px;">
    </div>
  <?php endif; ?>

  <div style="flex:1;">
    <p style="margin:0 0 8px 0;">
      <?= htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8') ?>
    </p>
    <p style="margin:0; font-size:0.9em; color:#666;">
      <?= htmlspecialchars($question['Modulename'], ENT_QUOTES, 'UTF-8') ?>
      (by <a href="mailto:<?= htmlspecialchars($question['email'], ENT_QUOTES, 'UTF-8') ?>">
        <?= htmlspecialchars($question['name'], ENT_QUOTES, 'UTF-8') ?>
      </a>)
    </p>
  </div>

  <a href="editquestion.php?id=<?=$question['id']?>">Edit</a>
  <div>
    <form action="deletequestion.php" method="post" style="margin:0;">
      <input type="hidden" name="id" value="<?= $question['id'] ?>">
      <input type="submit" value="Delete" style="cursor:pointer;">
    </form>
  </div>
</div>
<?php endforeach; ?>
