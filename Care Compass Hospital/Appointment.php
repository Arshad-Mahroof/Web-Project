<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn=isset($_SESSION['username']);
$isLoggedId = $_SESSION['user_id'] ?? null;
 // Assume 'username' is stored during login
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
                <li class="active"><a href="Appointment.php">Book Appointment</a></li>
                <li><a href="Portal.php">Patient Portal</a></li>
                <li><a href="Payment.php">Payment</a></li>
            </ul>
        </div>
    </div>

    <div class="appointment">
        <h2>Book Your Appointment</h2>
        <form action="" method="POST" id="appointment-form">
            <label for="full_name">Patient Name:</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter Your Name" required><br>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required><br>

            <label for="phone">Contact Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter Your Contact Number" required><br>

            <label for="doctor">Select Doctor: <a href="Filterdoctor.php">Search Doctor</a></label>
            <select id="doctor" name="doctor_id" required>
                <option value="">-- Choose Doctor --</option>
                <?php
                // Fetch the list of doctors from the database
                $query = "SELECT doctor_id,full_name FROM doctors";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['doctor_id']."'>".htmlspecialchars($row['full_name'])."</option>";
                    }
                } else {
                    echo "<option value=''>No doctors available</option>";
                }
                ?>
        </select><br>

            <label for="date">Appointment Date:</label>
            <input type="date" id="date" name="appointment_date" required><br>

            <label for="time">Appointment Time:</label>
            <input type="time" id="time" name="appointment_time" required><br>
        
            <label for="reason">Reason for Visit:</label>
            <textarea id="reason" name="reason" rows="2" style="width:99%; margin-bottom:15px;" required></textarea><br>

            <button type="submit" class="btn" name="appointment">Book Appointment</button>

            <div class="link">
            <a href="viewappointment.php">view Appointment</a>
            </div>

        </form>
    </div>

    <!-- Show welcome message and menu for logged-in users -->
    <h1 align="center" style="color:black; margin-bottom:20px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']);?> !</h1>

    <div class="footers">
        <p>&copy;Care Compass Hospitals. All Rights Reserved. |<a href="Contact.php">  Contact us  </a>|<?php if ($isLoggedIn): ?><a href="Logout.php"> Logout </a><?php endif; ?></p>
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/yourphonenumber" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

<?php

if (isset($_POST['appointment'])) {
    if (!$isLoggedIn) {
        echo '<script>alert("Please log in to your account to book an appointment.");
        window.location.href = "Portal.php";</script>';
        exit();
    } else {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $doctor_id = $_POST['doctor_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $reason = $_POST['reason'];

        $status = 'pending';
        $isLoggedId = $_SESSION['user_id'] ?? null;

        if ($isLoggedId === null) {
            echo '<script>alert("Error: User ID not found. Please log in again.");</script>';
            exit();
        }

        $sql = "INSERT INTO appointments(user_id, doctor_id, appointment_date, appointment_time, reason, status) 
                VALUES ('$isLoggedId', '$doctor_id', '$appointment_date', '$appointment_time', '$reason', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Appointment booked successfully!");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

</body>
</html>

<script>
/*
    document.getElementById('appointment-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const patientname = document.getElementById('patient-name').value.trim();
        const email = document.getElementById('email').value.trim();
        const contactnumber = document.getElementById('contact-number').value.trim();

        let isValid = true;
        let errorMessage = '';

        if (!/^[A-Za-z]{2,}$/.test(patientname)) {
            isValid = false;
            errorMessage += 'Patient Name should only contain letters and be at least 2 characters long.\n';
        }

        if (!/^\d{10}$/.test(contactnumber)) {
            isValid = false;
            errorMessage += 'Contact Number must be exactly 10 digits.\n';
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            errorMessage += 'Please enter a valid email address.\n';
        }

        if (isValid) {
            alert('Appointment Added successful!');
            window.location.href = 'Home.php';
        } else {
            alert(errorMessage);
        }
    });
*/
</script>