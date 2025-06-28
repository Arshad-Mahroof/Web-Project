<?php
session_start();
include('dbconnect.php');

// Check if the payment_id is set and is a valid number
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_id']) && is_numeric($_POST['payment_id'])) {
    $payment_id = $_POST['payment_id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM pending_payments WHERE id = ?");
    $stmt->bind_param("i", $payment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Pending payment deleted successfully.'); window.location.href='provider_home.php';</script>";
    } else {
        // Show a generic error message for users (to avoid leaking internal error details)
        echo "<script>alert('Error deleting payment. Please try again.'); window.location.href='provider_home.php';</script>";
    }

    $stmt->close();
} else {
    // Handle invalid requests
    echo "<script>alert('Invalid request.'); window.location.href='provider_home.php';</script>";
}

$conn->close();
?>
