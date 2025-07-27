<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['model'];
    $type = $_POST['type'];
    $rent = $_POST['rent'];
    $status = $_POST['status'];

    if ($model && $type && is_numeric($rent)) {
        $stmt = $conn->prepare("INSERT INTO bikes (model, type, rent_per_hour, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $model, $type, $rent, $status);
        $stmt->execute();
        header("Location: index.php");
    } else {
        echo "Please fill all fields correctly.";
    }
}
?>
<form method="post">
    Model: <input type="text" name="model"><br>
    Type: <input type="text" name="type"><br>
    Rent per Hour: <input type="text" name="rent"><br>
    Status:
    <select name="status">
        <option value="available">Available</option>
        <option value="rented">Rented</option>
    </select><br>
    <input type="submit" value="Add Bike">
</form>
