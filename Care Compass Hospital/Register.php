<?php 
session_start();
include('dbconnect.php');
error_reporting(0);

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
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
                <li class="active"><a href="Register.php">Register</a></li>
            </ul>
        </div>
    </div>

    <div class="registration">
        <h2>Patient Registration</h2>
        <form name="myform" method="POST" action="" id="registration-form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required><br>

            <label for="emailid">Email:</label>
            <input type="email" id="emailid" name="emailid" placeholder="Enter Your Email ID" required><br>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter Your Phone Number" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter Your Address" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="pwsd" maxlength="8" minlength="4" placeholder="Enter New Password" required><br>

            <label>Confirm Password:</label>
            <input type="password" name="confirmpassword" placeholder="Confirm Password" maxlength="8" minlength="4" required><br>

            <button type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">Register</button>
        </form>
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

<?php
if (isset($_POST['signup'])) {
    $usern = $_POST['username'];
    $passw = $_POST['pwsd'];
    $email = $_POST['emailid'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($passw !== $_POST['confirmpassword']) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {

        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, pwd, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $usern, $passw, $email, $phone, $address);

        // Execute the query
        if ($stmt->execute()) {
            echo '<script type="text/javascript">alert("Registration successful. Now you can login");window.location="Portal.php";</script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

</body>
</html>


<script>
/*
    document.getElementById('registration-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const firstName = document.getElementById('first-name').value.trim();
        const lastName = document.getElementById('last-name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const password = document.getElementById('password').value.trim();

        let isValid = true;
        let errorMessage = '';

        if (!/^[A-Za-z]{2,}$/.test(firstName)) {
            isValid = false;
            errorMessage += 'First Name should only contain letters and be at least 2 characters long.\n';
        }

        if (!/^[A-Za-z]{2,}$/.test(lastName)) {
            isValid = false;
            errorMessage += 'Last Name should only contain letters and be at least 2 characters long.\n';
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            errorMessage += 'Please enter a valid email address.\n';
        }

        if (!/^\d{10}$/.test(phone)) {
            isValid = false;
            errorMessage += 'Phone Number must be exactly 10 digits.\n';
        }

        if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password)) {
            isValid = false;
            errorMessage += 'Password must be at least 8 characters long and include at least one letter and one number.\n';
        }

        if (isValid) {
            localStorage.setItem('user', JSON.stringify({ firstName, lastName, email, phone, password }));
            alert('Registration successful!');
            window.location.href = 'Services.php';
        } else {
            alert(errorMessage);
        }
    });
*/
</script>