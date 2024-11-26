<?php
// register.php

// Connecting to database...
require '..\Connection\config.php';

// Collecting Signup page Data....
if (isset($_POST["submit"])) {
    // Debug: Check if form is submitting
    error_log("Form is submitting.");
    
    // Getting input values from form
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $dob = $_POST["dob"];
    $social_links = $_POST["social_links"];

    // Handling profile picture upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = 'uploads/' . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }

    // Checking if username or email already exists in the database
    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email Has Already Been Taken'); </script>";
    } else {
        // Check if passwords match
        if ($password == $confirmpassword) {
            // Hashing the password before storing it
            $hashed_password = md5($password);

            // Inserting data into the database
            $query = "INSERT INTO users (username, email, password_hash, firstName, lastName, date_of_birth, profile_picture_url, social_media_links)
            VALUES ('$username', '$email', '$hashed_password', '$firstName', '$lastName', '$dob', '$profile_picture', '$social_links')";
            
            if (mysqli_query($conn, $query)) {
                echo "<script> alert('Registration Successful'); </script>";
            } else {
                // Output any SQL errors
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>