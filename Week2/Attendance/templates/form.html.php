<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'Basic Calculator') ?></title>
</head>
<body>
  <h1>Basic Calculator</h1>

  <form method="post" action="">
    <p>
      <label>Value 1:
        <input type="text" name="val1" required>
      </label>
    </p>
    <p>
      <label>Value 2:
        <input type="text" name="val2" required>
      </label>
    </p>

    <fieldset>
      <legend>Operation</legend>
      <label><input type="radio" name="calc" value="add" checked> Add</label>
      <label><input type="radio" name="calc" value="sub"> Subtract</label>
      <label><input type="radio" name="calc" value="mul"> Multiply</label>
      <label><input type="radio" name="calc" value="div"> Divide</label>
    </fieldset>

    <p><button type="submit">Calculate</button></p>
  </form>
</body>
</html>
