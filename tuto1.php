<!DOCTYPE html>
<html>

<body>

    <h1>Diamond Pattern</h1>

    <?php

    $rows = 6;
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= ($rows - $i); $j++) {
            echo "&nbsp;&nbsp;";
        }
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "*";
        }
        echo "<br>";
    }

    for ($i = $rows - 1; $i >= 1; $i--) {
        for ($j = 1; $j <= ($rows - $i); $j++) {
            echo "&nbsp;&nbsp;";
        }
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "*";
        }
        echo "<br>";
    }
    ?>

</body>

</html>