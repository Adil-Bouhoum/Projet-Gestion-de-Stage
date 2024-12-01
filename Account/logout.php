<?php
// Function to check if a user is logged in
function isLoggedIn() {
    session_start();
    return isset($_SESSION['user_id']); 
}

// Function to log out a user
function logoutUser() {
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Location: login.php");
    exit();
}

if (isLoggedIn()) {
    logoutUser();
} else {
    header("Location: login.php");
    exit();
}

?>