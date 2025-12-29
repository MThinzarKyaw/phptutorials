<?php
include 'db.php';

$token = $_POST['token'];
$new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "SELECT * FROM users WHERE reset_token=$1";
$result = pg_query_params($conn, $query, [$token]);
$user = pg_fetch_assoc($result);

if ($user) {
    $expire = strtotime($user['token_expire']);
    $now = time();

    if ($now <= $expire) {
        $update_query = "UPDATE users SET password=$1, reset_token=NULL, token_expire=NULL WHERE reset_token=$2";
        pg_query_params($conn, $update_query, [$new_password, $token]);
        echo "Password updated successfully! <a href='login.php'>Login</a>";
    } else {
        echo "Token has expired.";
    }
} else {
    echo "Invalid token.";
}
