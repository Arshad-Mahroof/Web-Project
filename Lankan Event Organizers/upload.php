<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fullName = $fname . ' ' . $lname;
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validate passwords
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match. Please try again.'); window.history.back();</script>";
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Handle photo upload
$targetDir = "uploads/";
$photoName = basename($_FILES["photo"]["name"]);
$photoName = str_replace(" ", "_", $photoName); // remove spaces
$targetFile = $targetDir . time() . "_" . $photoName;

// Determine table based on role
$table = ($role === "service") ? "pending_users" : "users";

// Check if email already exists in both users and pending_users
$checkQuery = "SELECT email FROM users WHERE email = ? 
               UNION 
               SELECT email FROM pending_users WHERE email = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param("ss", $email, $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo "<script>alert('Email already registered. Please use a different email address.'); window.history.back();</script>";
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        // Insert into appropriate table
        $stmt = $conn->prepare("INSERT INTO $table (name, email, password, role, photo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $email, $hashedPassword, $role, $targetFile);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "Database Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error uploading the photo.'); window.history.back();</script>";
    }
}

$checkStmt->close();
$conn->close();
?>
