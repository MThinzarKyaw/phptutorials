<?php include 'pdo_logic.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>PDO Tutorials</title>
</head>

<body>
    <h2><?= $edit_data ? "Edit Tutorial" : "Add New Tutorial" ?></h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $edit_data['tutorial_id'] ?? '' ?>">
        <input type="text" name="name" placeholder="Tuto Name" value="<?= $edit_data['tutorial_name'] ?? '' ?>" required>
        <input type="text" name="desc" placeholder="Description" value="<?= $edit_data['description'] ?? '' ?>">
        <input type="date" name="deadline" value="<?= $edit_data['deadline'] ?? '' ?>">
        <select name="status">
            <option value="Pending" <?= (isset($edit_data) && $edit_data['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
            <option value="In Progress" <?= (isset($edit_data) && $edit_data['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
        </select>
        <button type="submit" name="<?= $edit_data ? 'update' : 'add' ?>"><?= $edit_data ? 'Update' : 'Save' ?></button>
        <?php if ($edit_data): ?> <a href="pdo_view.php">Cancel</a> <?php endif; ?>
    </form>

    <table border="1" style="margin-top:20px; width: 80%; border-collapse: collapse;">
        <tr style="background: #f4f4f4;">
            <th>No.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        $no = 1;
        foreach ($tutorials as $row):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['tutorial_name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['deadline'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="?complete=<?= $row['tutorial_id'] ?>">Complete</a> |
                    <a href="?edit=<?= $row['tutorial_id'] ?>">Edit</a> |
                    <a href="?delete=<?= $row['tutorial_id'] ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>