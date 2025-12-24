<?php
session_start();

$conn = pg_connect("
    host=localhost
    dbname=my_db
    user=postgres
    password=mya123
");

if (!$conn) {
    die("Database Connection Failed");
}
