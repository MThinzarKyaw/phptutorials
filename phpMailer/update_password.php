<?php
require 'db.php';

$token = $_POST['token'];
$new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "SELECT * FROM users WHERE reset_token=$1 AND token_expire > NOW()";
$result = pg_query_params($conn, $query, [$token]);

if (pg_num_rows($result) > 0) {
    pg_query_params($conn, "UPDATE users SET password=$1, reset_token=NULL, token_expire=NULL WHERE reset_token=$2", [$new_pass, $token]);
    echo "Password updated! <a href='login.php'>Login</a>";
} else {
    echo "Invalid or expired token.";
}
?>