<?php
session_start();
include 'dbconnect.php';

$emailFromURL = $_GET['email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $entered_code = $_POST['reset_code'];

    $stmt = $conn->prepare("SELECT reset_code, code_expires FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['reset_code'] == $entered_code && strtotime($row['code_expires']) > time()) {
            $_SESSION['reset_email'] = $email;
            header("Location: reset_password.php");
            exit();
        } else {
            $error = "Invalid or expired code.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="forget&reset.css" />
    <link rel="icon" href="images/Logo.png" />
    <title>Verify Reset Code</title>
</head>
<body>
    <main>
        <div class="container" role="main" aria-label="Forgot Password Form">
            <h2>Enter the Reset Code</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST" action="#" aria-describedby="reset-instructions">
                <label>your Email Address:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($emailFromURL) ?>" readonly autofocus/>
                <label>Enter 6-digit code:</label>
                <input type="text" name="reset_code" placeholder="Enter 6-digit code" required autofocus/>
                <button type="submit" aria-label="Verify Code">Verify Code</button>
            </form>
        </div>
    </main>
</body>
</html>
