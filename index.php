<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bike Rental</title>
</head>
<body>
    <h2>Bike List</h2>
    <a href="add.php">Add New Bike</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Model</th><th>Type</th><th>Rent/Hr</th><th>Status</th><th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM bikes");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['model'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['rent_per_hour'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this bike?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
