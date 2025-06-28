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
    <title>Admin & Doctor Portal</title>
    <link rel="icon" href="images/Logo.jpeg" />
    <link rel="stylesheet" href="sheet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
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
                <li class="active"><a href="AdminDoctor.php">Admin & Doctor Portal</a></li>
                <li><a href="Payment.php">Payment</a></li>
            </ul>
        </div>
    </div>

    <div class="login">
    <h2>Login</h2>
    <form action="" method="POST" id="login-form">
        <label for="username">Enter Your Username:</label>
        <input type="text" id="username" name="username" required />
        
        <label for="password">Enter Your Password:</label>
        <input type="password" id="password" name="password" required />
        
        <label for="role">Select Role:</label>
        <select name="role" id="role" required>
            <option value="admin">Admin</option>
            <option value="doctor">Doctor</option>
        </select>
        
        <button type="submit" class="btn" name="log">Login</button>
    </form>
</div>


<?php
if (isset($_POST["log"])) {
    $usern = $_POST["username"];
    $passw = $_POST["password"];

    // Secure query using prepared statements
    $sql = "SELECT * FROM user WHERE username=? AND pwd=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usern, $passw);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Store user details in session
        $_SESSION['user_id'] = $row['user_id']; 
        $_SESSION['username'] = $row['username']; 
        
        // Redirect based on role
        if ($row['user_role'] == 'admin') {
            echo '<script>
                alert("You have successfully logged in as Admin!");
                window.location.href = "AdminDashboard.php";
            </script>';
        } elseif ($row['user_role'] == 'doctor') {
            echo '<script>
                alert("You have successfully logged in as Doctor!");
                window.location.href = "DoctorDashboard.php";
            </script>';
        }
    } else {
        echo '<script> alert("Your Username or Password is Wrong");</script>';
    }
    $stmt->close(); // Close the statement
}
$conn->close(); // Close the connection
?>


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

</body>
</html>