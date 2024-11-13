<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

echo "Welcome, " . $_SESSION['username'] . "! You are logged in as " . $_SESSION['role'] . ".<br>";

if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin.php'>Admin Page</a><br>";
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Description</th><th>Quantity</th><th>Price</th><th>Category</th><th>Expiry Date</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["item_id"]."</td><td>".$row["item_name"]."</td><td>".$row["item_description"]."</td><td>".$row["quantity"]."</td><td>".$row["unit_price"]."</td><td>".$row["category"]."</td><td>".$row["expiry_date"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<a href="logout.php">Logout</a>
