<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Ensure the logged-in user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle POST request to approve user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Retrieve user data from pending_users
    $stmt = $conn->prepare("SELECT name, email, password, role, photo FROM pending_users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Hash the password before saving
        $hashedPassword = $user['password'];

        // Insert into users table
        $stmtInsert = $conn->prepare("INSERT INTO users (name, email, password, role, photo) VALUES (?, ?, ?, ?, ?)");
        $stmtInsert->bind_param("sssss", $user['name'], $user['email'], $hashedPassword, $user['role'], $user['photo']);
        $stmtInsert->execute();

        // Delete from pending_users table
        $stmtDelete = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
        $stmtDelete->bind_param("i", $user_id);
        $stmtDelete->execute();

        echo "<script>alert('User accepted successfully.'); window.location.href = 'admin_home.php';</script>";
        exit();
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}
?>
