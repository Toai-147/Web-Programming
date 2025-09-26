<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week1</title>
</head>
<body>
<?php
function hello()
{ echo "Hello, World!";}
hello();
echo "<br/>";

$month = date("F");
if ($month == "August")
{ echo "It's August, so it's really hot.";}
else
{ echo "Not August, so at least not in the peak of the heat.";}
echo "<br/>";

function caculate($w, $h)
{
    $area = $w * $h;
    echo "A rectangle of width $w and height $h has an area of $area.";
}
caculate(5, 10);
echo "<br/>";
?>
    
    
</body>
</html>