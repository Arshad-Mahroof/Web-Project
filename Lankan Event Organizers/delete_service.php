<?php
include('dbconnect.php');

$service_id = $_POST['service_id'];

$stmt = $conn->prepare("DELETE FROM pending_services WHERE id = ?");
$stmt->bind_param("i", $service_id);
if ($stmt->execute()) {
    echo "<script>alert('Service deleted.'); window.location.href='admin_home.php';</script>";
} else {
    echo "Error deleting service.";
}
