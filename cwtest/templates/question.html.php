<form action="question.php" method="get" class="question-search-simple">
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

</div>
<?php endforeach; ?>
