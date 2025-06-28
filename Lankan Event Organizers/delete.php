<?php
session_start();
include('dbconnect.php');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Delete user from pending_users
    $stmt = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully.'); window.location.href = 'admin_home.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
