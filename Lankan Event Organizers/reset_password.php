<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['reset_email'])) {
    echo "Unauthorized access.";
    exit;
}

$email = $_SESSION['reset_email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_code = NULL, code_expires = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    if ($stmt->execute()) {
        unset($_SESSION['reset_email']); // clear session
        echo "<script>alert('Password updated successfully.'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="forget&reset.css" />
    <link rel="icon" href="images/Logo.png" />
    <title>Reset Password</title>
</head>
<body>
    <main>
        <div class="container" role="main" aria-label="Forgot Password Form">
            <h2>Reset Password</h2>
            <form method="POST" action="#" aria-describedby="reset-instructions">
                <label>Enter your New Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter New Password" required autofocus />
                <button type="submit" aria-label="Update Password">Update Password</button>
            </form>
        </div>
    </main>
</body>
</html>
