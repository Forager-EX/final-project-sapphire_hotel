<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: /final-project-sapphire_hotel/frontend/admin_login.php"); // Redirect to the login page
exit();
?>
