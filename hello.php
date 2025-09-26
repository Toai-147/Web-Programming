<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World PHP</title>
</head>
<body>
<?php
$myString = "This is a string";
$myint = 42;
$myfloat = 3.14;
$myNull = null;

echo "String data is: $myString<br/>";
echo "Integer data is: $myint<br/>";
echo "Float data is: $myfloat<br/>";
echo "Null data is: $myNull<br/>";
echo "<br/>";
function tester()
{
    echo "This is my first function which I am going to call twice";
}
tester();
echo "<br/>";
?>

<?php
function addNumber ($a, $b, $c)
{
    $total = $a + $b + $c;
    echo ("$a + $b + $c = $total");
}
addNumber ("5","12","15");
echo "<br/>";
?>

<?php 
$txt1="Hello World!";
$txt2= "What a nice day!";
echo $txt1 . " " . $txt2;
echo "<br/>";
echo "<br/>";
?>

<?php 
$theDay = date("l");
echo "The day is $theDay<br />";
$theMonth = date("F");
echo "The month is $theMonth<br />";
$t = date("H");
if ($t < 13) {
    echo "Good morning to you!";
} else{
    echo "Good afternoon to you";
}
?>


<p> here is some HTML </p>
<p> And now I will use PHP function again </p>
<?php tester() ?>
</body>
</html>