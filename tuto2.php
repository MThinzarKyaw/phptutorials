<!DOCTYPE html>
<html>
<body>

<h1>Chess Board</h1>

<?php
$rows = 8;
$columns = 8;
$square_size = "40px";

echo '<table style = "border-collapse: collapse;">';

for ($i = 1; $i <= $rows; $i++) {
    echo '<tr>';

    for ($j = 1; $j <= $columns; $j++) {
    $sum = $i + $j;

    if ($sum % 2 == 0) {
        $color = 'white';
    } else {
        $color = 'black';
    }

    echo '<td style = "
    width: ' . $square_size . ';
    height: ' . $square_size . ';
    background-color: ' . $color . ';
    border: 1px solid #ccc;
    "></td>'; 
    }
    echo '</tr>';
}
echo '</table>';
?>
</body>
</html>