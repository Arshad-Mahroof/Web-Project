<?php
header('Content-Type: application/json');
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate 6-digit reset code
        $reset_code = random_int(100000, 999999);
        $expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes'));

        // Save code and expiry in DB
        $stmt = $conn->prepare("UPDATE users SET reset_code = ?, code_expires = ? WHERE email = ?");
        $stmt->bind_param("iss", $reset_code, $expires_at, $email);
        $stmt->execute();

        echo json_encode([
            'success' => true,
            'reset_code' => $reset_code,
            'email' => $email
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
