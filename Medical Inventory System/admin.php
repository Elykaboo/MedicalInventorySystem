<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

echo "Welcome to the admin page, " . $_SESSION['username'] . "!<br>";

// Admin-specific functions can be added here
// Example: View all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["user_id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["role"]."</td><td>".$row["created_at"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<a href="index.php">Back to Home</a>
