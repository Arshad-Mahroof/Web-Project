<?php
include('dbconnect.php');

// Get filter value from dropdown
$selectedSpecialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';

// Query to fetch specializations for dropdown
$specializationQuery = "SELECT DISTINCT specialization FROM doctors";
$specializationResult = $conn->query($specializationQuery);

// Query to fetch doctors based on selected specialization
$sql = "SELECT * FROM doctors";
if (!empty($selectedSpecialization)) {
    $sql .= " WHERE specialization = '$selectedSpecialization'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Doctors by Specialization</title>
    <link rel="icon" href="images/Logo.jpeg" />
    <link rel="stylesheet" href="sheet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="head">
        <div class="image">
            <img src="images/Logo.jpeg" />
            <h1>Care Compass Hospital</h1>
        </div>
        <div class="sub">
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Appointment.php">Book Appointment</a></li>
                <li><a href="Portal.php">Patient Portal</a></li>
                <li><a href="Payment.php">Payment</a></li>
                <li class="active"><a href="Filterdoctor.php">Search Doctor</a></li>
            </ul>
        </div>
    </div>

<div class="Filter_doctor">
<h2>Filter Doctors</h2>

<div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
<!-- Specialization Dropdown Filter -->
<form method="GET" action="">
    <label for="specialization">Choose Specialization:</label>
    <select name="specialization" id="specialization">
        <option value="">-- All Specializations --</option>
        <?php while ($row = $specializationResult->fetch_assoc()) { ?>
            <option value="<?php echo $row['specialization']; ?>" 
                <?php echo ($selectedSpecialization == $row['specialization']) ? 'selected' : ''; ?>>
                <?php echo $row['specialization']; ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit">Filter</button>
</form>
<hr>
</div>

<h2>Doctor Profiles</h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:solid #ccc; padding:10px; margin:10px; border-radius:15px;'>";
        if (!empty($row['profile_picture'])) {
            echo "<img src='" . $row['profile_picture'] . "' width='100' height='100' alt='Profile Picture'><br>";
        }
        echo "<strong>ID:</strong> " . $row['doctor_id'] . "<br>";
        echo "<strong>Name:</strong> " . $row['full_name'] . "<br>";
        echo "<strong>Specialization:</strong> " . $row['specialization'] . "<br>";
        echo "<strong>Email:</strong> " . $row['email'] . "<br>";
        echo "<strong>Phone:</strong> " . $row['phone_number'] . "<br>";
        echo "</div>";
    }
} else {
    echo "<p>No doctors found.</p>";
}
?>
</div>

<div class="footers">
        <p>&copy;Care Compass Hospitals. All Rights Reserved. |<a href="Contact.php">  Contact us  </a>|<?php if ($isLoggedIn): ?><a href="Logout.php"> Logout </a><?php endif; ?></p>
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/yourphonenumber" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

</body>
</html>
