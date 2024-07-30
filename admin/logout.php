<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Optionally, you can redirect to the login page or another page
header('Location: ./index.php');
exit();
?>