<?php
session_start();
include('dbconnect.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $card_name = trim($_POST['card_name']);
    $card_number = trim($_POST['card_number']);
    $expiry_month = trim($_POST['expiry_month']);
    $expiry_year = trim($_POST['expiry_year']);
    $cvv = trim($_POST['cvv']);
    $amount = $_POST['amount'];
    $booking_date = $_POST['booking_date'];
    $package_id = $_POST['package_id'];
    $expiry = $expiry_month . '/' . $expiry_year;

    // Get user info from session
    $username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

    // Get package info from the database
    $stmt = $conn->prepare("SELECT * FROM package WHERE id = ?");
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();

    if ($package) {
        // Extract package details
        $package_name = $package['package_type'];

        // Check if the same package is already booked for this date
        $check_stmt = $conn->prepare("SELECT * FROM booked_packages WHERE package_id = ? AND booking_date = ?");
        $check_stmt->bind_param("is", $package_id, $booking_date);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "<script>alert('This package is already booked for this date. Please choose another date.'); window.history.back();</script>";
            exit;
        }

        // Mask card number (only showing last 4 digits)
        $masked_card = str_repeat('*', strlen($card_number) - 4) . substr($card_number, -4);

        // Insert the booking into booked_packages table
        $stmt = $conn->prepare("INSERT INTO booked_packages (username, package_name, amount, card_name, card_number, expiry, package_id, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssis", $username, $package_name, $amount, $card_name, $masked_card, $expiry, $package_id, $booking_date);

        if ($stmt->execute()) {
            echo "<script>alert('Package Booked Successfully.'); window.location.href='user_home.php';</script>";
        } else {
            echo "Error submitting payment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid package ID.'); window.location.href='user_home.php';</script>";
    }

    $conn->close();
}
?>
