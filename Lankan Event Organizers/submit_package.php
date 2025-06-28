<?php
session_start();
include('dbconnect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the package type and price
    $package_type = mysqli_real_escape_string($conn, $_POST['package_type']);
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;

    // Initialize an array to hold selected services
    $selected_services = [];

    // Define all possible services
    $services = ['chef', 'decoration', 'photographers', 'waiters', 'cleaning_services', 'restaurants', 'djs', 'makeup_artists', 'mehandi_artists', 'transport'];

    foreach ($services as $service) {
        $key = 'service_' . $service;
        if (isset($_POST[$key])) {
            $selected_services[$service] = $_POST[$key];
        }
    }

    // Encode the services array to JSON
    $services_json = json_encode($selected_services);

    // Use prepared statement for security
    $stmt = $conn->prepare("INSERT INTO package (package_type, services, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $package_type, $services_json, $price);

    if ($stmt->execute()) {
        echo "<script>alert('Package selection saved successfully!'); window.location.href = 'packages.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
