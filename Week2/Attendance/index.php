<?php
// index.php - Controller cho máy tính 4 phép + kiểm tra lỗi
declare(strict_types=1);

$tplDir = __DIR__ . '/templates';

if (!isset($_POST['val1'])) {
    $title = 'Basic Calculator';
    include $tplDir . '/form.html.php';
    exit;
}

$val1 = $_POST['val1'] ?? '';
$val2 = $_POST['val2'] ?? '';
$calc = $_POST['calc'] ?? 'add';

if (!is_numeric($val1) || !is_numeric($val2)) {
    $title = 'Input Error';
    $error = 'Please enter valid numbers for both fields.';
    include $tplDir . '/error.html.php';
    exit;
}

$val1 = (float)$val1;
$val2 = (float)$val2;

switch ($calc) {
    case 'add':
        $result = $val1 + $val2; $op = '+';
        break;
    case 'sub':
        $result = $val1 - $val2; $op = '−';
        break;
    case 'mul':
        $result = $val1 * $val2; $op = '×';
        break;
    case 'div':
        if ($val2 == 0.0) {
            $title = 'Math Error';
            $error = 'Division by zero is not allowed.';
            include $tplDir . '/error.html.php';
            exit;
        }
        $result = $val1 / $val2; $op = '÷';
        break;
    default:
        $title = 'Unknown Operation';
        $error = 'Invalid operation.';
        include $tplDir . '/error.html.php';
        exit;
}

$title = 'Result';
$output = "{$val1} {$op} {$val2} = {$result}";
include $tplDir . '/result.html.php';
