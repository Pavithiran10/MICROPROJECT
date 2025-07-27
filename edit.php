<?php include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM bikes WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['model'];
    $type = $_POST['type'];
    $rent = $_POST['rent'];
    $status = $_POST['status'];

    if ($model && $type && is_numeric($rent)) {
        $stmt = $conn->prepare("UPDATE bikes SET model=?, type=?, rent_per_hour=?, status=? WHERE id=?");
        $stmt->bind_param("ssdsi", $model, $type, $rent, $status, $id);
        $stmt->execute();
        header("Location: index.php");
    } else {
        echo "Invalid input.";
    }
}
?>
<form method="post">
    Model: <input type="text" name="model" value="<?= $row['model'] ?>"><br>
    Type: <input type="text" name="type" value="<?= $row['type'] ?>"><br>
    Rent per Hour: <input type="text" name="rent" value="<?= $row['rent_per_hour'] ?>"><br>
    Status:
    <select name="status">
        <option value="available" <?= $row['status'] == 'available' ? 'selected' : '' ?>>Available</option>
        <option value="rented" <?= $row['status'] == 'rented' ? 'selected' : '' ?>>Rented</option>
    </select><br>
    <input type="submit" value="Update Bike">
</form>
