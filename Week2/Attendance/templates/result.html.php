<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'Result') ?></title>
</head>
<body>
  <h1>Result</h1>
  <p><?= htmlspecialchars($output ?? '') ?></p>
  <p><a href="./">← Back</a></p>
</body>
</html>
