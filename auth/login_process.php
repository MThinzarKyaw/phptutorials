<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email=$1";
$result = pg_query_params($conn, $query, [$email]);
$user = pg_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: dashboard.php");
} else {
    echo '<div class="alert alert-danger">Invalid email or password</div>';
}
?>