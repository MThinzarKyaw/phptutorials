<!DOCTYPE html>
<html>
<head>
    <title>Age Calculator</title>
</head>
<body>
    <h1>Age Calculator</h1>

    <form method="post">
        <label>Select your birth date:</label><br><br>
        <input type="date" 
        name="dob"
        value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : '' ; ?>"
        required>
        <br><br>
        <button type="submit">Calculate Age</button>
    </form>

    <?php
    if (isset($_POST['dob'])) {

        $birthDate = new DateTime($_POST['dob']);
        $today = new DateTime();

        $age = $today->diff($birthDate)->y;
        echo "<h3>Your age is: $age years</h3>";
    }
    ?>
</body>
</html>