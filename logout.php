<?php
session_start();          // Start the session
session_unset();          // Remove all session variables
session_destroy();        // Destroy the session

// Redirect to login page or home page
header("Location: home.php");
exit();
?>
