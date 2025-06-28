<?php
session_start();
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_id']) && is_numeric($_POST['payment_id'])) {
    $payment_id = $_POST['payment_id'];

    // Fetch the pending payment record
    $stmt = $conn->prepare("SELECT * FROM pending_payments WHERE id = ?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $payment = $result->fetch_assoc();

    if ($payment) {
        // Insert into 'payment' table with booking_date
        $insert = $conn->prepare("INSERT INTO payment (username, provider_name, service_name, amount, card_name, card_number, expiry, service_id, booking_date, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert->bind_param(
            "sssisssis",
            $payment['username'],
            $payment['provider_name'],
            $payment['service_name'],
            $payment['amount'],
            $payment['card_name'],
            $payment['card_number'],
            $payment['expiry'],
            $payment['service_id'],
            $payment['booking_date'] // Added booking_date
        );

        if ($insert->execute()) {
            // Delete from pending_payments table
            $delete = $conn->prepare("DELETE FROM pending_payments WHERE id = ?");
            $delete->bind_param("i", $payment_id);
            if ($delete->execute()) {
                echo "<script>alert('Payment approved and saved successfully.'); window.location.href='provider_home.php';</script>";
            } else {
                echo "<script>alert('Error deleting payment record.'); window.location.href='provider_home.php';</script>";
            }
            $delete->close();
        } else {
            echo "<script>alert('Error saving payment. Please try again.'); window.location.href='provider_home.php';</script>";
        }

        $insert->close();
    } else {
        echo "<script>alert('Payment not found.'); window.location.href='provider_home.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='provider_home.php';</script>";
}
?>
