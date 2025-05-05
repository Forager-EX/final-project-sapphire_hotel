<?php
session_start();
include(__DIR__ . '/../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Protect against SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

       // Verify password
        if (password_verify($password, $user['password'])) {
            // Success
            echo "Login successful!";
            // Redirect or start session
        } else {
            // Wrong password
            header("Location: login.php?error=wrongpassword");
            exit();
        }
    } else {
        // Email not found
        header("Location: login.php?error=usernotfound");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
