<?php
include 'db.php';

// $username = 'Mg Mg';
// $email = 'admin@gmail.com';
// $raw_password = '123456'; 
// $hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);

// $query = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
// $result = pg_query_params($conn, $query, [$username, $email, $hashed_password]);

// if ($result) {
//     echo "<h3>User Created Successfully!</h3>";
//     echo "Email: admin@gmail.com<br>";
//     echo "Password: 123456<br>";
//     echo "Database Hash: " . $hashed_password;
// } else {
//     echo "Error: " . pg_last_error($conn);
// }
$email = 'admin@gmail.com';
$password = '123456';

pg_query_params(
    $conn,
    "INSERT INTO users (email, password) VALUES ($1, $2)",
    [$email, $password]
);

echo "User created";
