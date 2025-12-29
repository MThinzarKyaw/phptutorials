<?php
$host = "localhost";
$db   = "my_db";
$user = "postgres";
$pass = "mya123";

// PDO Connection
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}

// pg Connection
$dbconn = pg_connect("host=$host dbname=$db user=$user password=$pass");
if (!$dbconn) {
    die("pg_* Connection failed: " . pg_last_error());
}
