<?php
include('dbconnect.php');
session_start();
error_reporting(0);

// Check if updating service booking
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM payment WHERE id=?";
} 
// Check if updating package booking
elseif (isset($_GET['package_id'])) {
    $id = $_GET['package_id'];
    $sql = "SELECT * FROM booked_packages WHERE id=?";
} 
else {
    echo "Invalid Request!";
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "Booking not found!";
    exit();
}

// Update after form submission
if (isset($_POST['update'])) {
    $booking_date = $_POST['booking_date'];

    if (isset($_GET['id'])) {
        $update_sql = "UPDATE payment SET booking_date=? WHERE id=?";
    } else {
        $update_sql = "UPDATE booked_packages SET booking_date=? WHERE id=?";
    }

    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $booking_date, $id);

    if ($update_stmt->execute()) {
        echo "<script>
                alert('Booking updated successfully!');
                window.location.href = 'view_booking.php';
              </script>";
    } else {
        echo "Error updating booking.";
    }
}
?>
<link rel="icon" href="images/Logo.png" />

<h2>Update Booking</h2>
<form method="post">
    Booking Date: <input type="date" name="booking_date" value="<?php echo $row['booking_date']; ?>" required><br><br>
    <input type="submit" name="update" value="Update Booking">
</form>

<style>
/* Basic Page Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #eef6fc;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

/* Container for the Form */
form {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
    width: 400px;
    text-align: center;
}

/* Form Input */
input[type="date"] {
    width: 90%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
}

/* Update Button */
input[type="submit"] {
    background-color: #0b5394;
    color: #fff;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #08417a;
}

/* Message Box */
.message {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    font-size: 18px;
    width: 400px;
}

/* Error Message */
.message.error {
    border: 2px solid #e74c3c;
    color: #e74c3c;
}

/* Success Message */
.message.success {
    border: 2px solid #2ecc71;
    color: #2ecc71;
}

/* Back Button */
.back-button {
    margin-top: 20px;
    display: inline-block;
    padding: 10px 20px;
    background-color: #0b5394;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #08417a;
}
</style>
