<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("location: index.php"); // Redirect to your login page
    exit();
}
