<?php
// Start the session
session_start();

// Destroy the session to log out the user
session_unset();
session_destroy();

// Redirect to the login page or admin dashboard
header("Location: log_in.html"); // Or redirect to login page if needed
exit();
?>
