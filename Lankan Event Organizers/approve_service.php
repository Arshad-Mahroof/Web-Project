<?php
include('dbconnect.php');

$service_id = $_POST['service_id'];

$query = "SELECT * FROM pending_services WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();

    // Insert all fields into services table
    $insert = $conn->prepare("INSERT INTO services (provider_name, service_name, description, email, photo, location, price, time_slot) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param(
        "ssssssds",
        $service['provider_name'],
        $service['service_name'],
        $service['description'],
        $service['email'],
        $service['photo'],
        $service['location'],
        $service['price'],
        $service['time_slot']
    );
    $insert->execute();

    // Delete from pending_services
    $delete = $conn->prepare("DELETE FROM pending_services WHERE id = ?");
    $delete->bind_param("i", $service_id);
    $delete->execute();

    echo "<script>alert('Service approved!'); window.location.href='admin_home.php';</script>";
} else {
    echo "Service not found.";
}
?>
