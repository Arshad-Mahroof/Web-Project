<?php
include('dbconnect.php');
session_start();
error_reporting(0);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM payment WHERE id=?";
} elseif (isset($_GET['package_id'])) {
    $id = $_GET['package_id'];
    $sql = "DELETE FROM booked_packages WHERE id=?";
} else {
    echo "<div class='message error'>Invalid Request!</div>";
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "
    <script>
        alert('Booking deleted successfully!');
        window.location.href = 'view_booking.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error deleting booking.');
        window.location.href = 'view_booking.php';
    </script>
    ";
}
?>
