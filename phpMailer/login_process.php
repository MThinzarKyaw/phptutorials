<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email=$1";
    $result = pg_query_params($conn, $query, [$email]);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, trim($user['password']))) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password');
        window.location='login.php';</script>";
    }
}
?>