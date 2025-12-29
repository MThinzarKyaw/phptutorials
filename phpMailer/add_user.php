<?php
include 'db.php';

$username = 'Aung Aung';
$email = 'admin2@gmail.com';
$raw_password = '123456'; 
$hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

$query = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, [$username, $email, $hashed_password]);

if ($result) {
    echo "<h3>User Created Successfully!</h3>";
    echo "Email: admin@gmail.com<br>";
    echo "Password: 123456<br>";
    echo "Database Hash: " . $hashed_password;
} else {
    echo "Error: " . pg_last_error($conn);
}
?>