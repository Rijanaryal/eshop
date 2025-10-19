<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['email'])) {
    // User is logged in, redirect back to main page
    header("Location: real.html");
    exit();
} else {
    // User is not logged in, redirect to login page
    header("Location: index.php");
    exit();
}
?>


