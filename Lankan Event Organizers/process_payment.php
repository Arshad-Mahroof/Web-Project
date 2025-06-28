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
    $service_id = $_POST['service_id'];
    $expiry = $expiry_month . '/' . $expiry_year;

    // Get user info from session
    $username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

    // Get service info from the database
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();

    if ($service) {
        // Extract service details
        $provider_name = $service['provider_name'];
        $service_name = $service['service_name'];

        // Check if any user has already booked this provider for the same date
        $check_stmt = $conn->prepare("SELECT * FROM pending_payments WHERE provider_name = ? AND booking_date = ?");
        $check_stmt->bind_param("ss", $provider_name, $booking_date);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        // If a booking already exists in pending_payments, show an alert
        if ($check_result->num_rows > 0) {
            echo "<script>alert('This service provider is already booked for this date. Please choose another date or provider.'); window.history.back();</script>";
            exit;
        }

        // If no record found in pending_payments, check in the payment table
        $check_stmt = $conn->prepare("SELECT * FROM payment WHERE provider_name = ? AND booking_date = ?");
        $check_stmt->bind_param("ss", $provider_name, $booking_date);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        // If a booking already exists in payment table, show an alert
        if ($check_result->num_rows > 0) {
            echo "<script>alert('This service provider is already booked for this date. Please choose another date or provider.'); window.history.back();</script>";
            exit;
        }

        // Mask card number (only showing last 4 digits)
        $masked_card = str_repeat('*', strlen($card_number) - 4) . substr($card_number, -4);

        // Insert the payment into the pending_payments table
        $stmt = $conn->prepare("INSERT INTO pending_payments (username, provider_name, service_name, amount, card_name, card_number, expiry, service_id, booking_date, request_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        
        // Correct bind_param with the right types
        $stmt->bind_param("sssisssis", $username, $provider_name, $service_name, $amount, $card_name, $masked_card, $expiry, $service_id, $booking_date);

        if ($stmt->execute()) {
            echo "<script>alert('Payment submitted and pending approval.'); window.location.href='booking.php';</script>";
        } else {
            echo "Error submitting payment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid service ID.'); window.location.href='booking.php';</script>";
    }

    $conn->close();
}
?>
