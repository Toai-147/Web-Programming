<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'Error') ?></title>
</head>
<body>
  <h1>Error</h1>
  <p style="color:red"><?= htmlspecialchars($error ?? 'Something went wrong.') ?></p>
  <p><a href="./">← Try again</a></p>
</body>
</html>
