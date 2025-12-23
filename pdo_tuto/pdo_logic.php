<?php
$host = 'localhost';
$user = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Create
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO tutorials (tutorial_name, description, deadline, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['desc'], $_POST['deadline'], $_POST['status']]);
        header("Location: pdo_view.php");
        exit();
    }

    // Update
    if (isset($_POST['update'])) {
        $stmt = $pdo->prepare("UPDATE tutorials SET tutorial_name=?, description=?, deadline=?, status=? WHERE tutorial_id=?");
        $stmt->execute([$_POST['name'], $_POST['desc'], $_POST['deadline'], $_POST['status'], $_POST['id']]);
        header("Location: pdo_view.php");
        exit();
    }

    // Complete ststus
    if (isset($_GET['complete'])) {
        $stmt = $pdo->prepare("UPDATE tutorials SET status = 'Completed' WHERE tutorial_id = ?");
        $stmt->execute([$_GET['complete']]);
        header("Location: pdo_view.php");
        exit();
    }

    // Delete
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM tutorials WHERE tutorial_id = ?");
        $stmt->execute([$_GET['delete']]);
        header("Location: pdo_view.php");
        exit();
    }

    // Edit
    $edit_data = null;
    if (isset($_GET['edit'])) {
        $stmt = $pdo->prepare("SELECT * FROM tutorials WHERE tutorial_id = ?");
        $stmt->execute([$_GET['edit']]);
        $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read
    $stmt = $pdo->query("SELECT * FROM tutorials ORDER BY tutorial_id ASC");
    $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}