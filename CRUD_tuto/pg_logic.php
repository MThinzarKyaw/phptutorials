<?php
include_once 'db_connection.php';

$edit_data = null;

// Create
if (isset($_POST['add'])) {
    $sql = "INSERT INTO tutorials (tutorial_name, description, deadline, status) VALUES ($1, $2, $3, $4)";
    pg_query_params($dbconn, $sql, [$_POST['name'], $_POST['desc'], $_POST['deadline'], $_POST['status']]);
    header("Location: pg_view.php");
    exit();
}

// Update
if (isset($_POST['update'])) {
    $sql = "UPDATE tutorials SET tutorial_name=$1, description=$2, deadline=$3, status=$4 WHERE tutorial_id=$5";
    pg_query_params($dbconn, $sql, [$_POST['name'], $_POST['desc'], $_POST['deadline'], $_POST['status'], $_POST['id']]);
    header("Location: pg_view.php");
    exit();
}

// Complete Status
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    pg_query_params($dbconn, "UPDATE tutorials SET status = 'Completed' WHERE tutorial_id = $1", [$id]);
    header("Location: pg_view.php");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    pg_query_params($dbconn, "DELETE FROM tutorials WHERE tutorial_id = $1", [$id]);
    header("Location: pg_view.php");
    exit();
}

// Edit Fetch
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = pg_query_params($dbconn, "SELECT * FROM tutorials WHERE tutorial_id = $1", [$id]);
    $edit_data = pg_fetch_assoc($result);
}

// Read
$result = pg_query($dbconn, "SELECT * FROM tutorials ORDER BY tutorial_id ASC");
$tutorials = pg_fetch_all($result) ?: [];
?>