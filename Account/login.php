<?php
// Include necessary files
include("../Connection/config.php");
include("../Models/admins.php");
include("../Models/professors.php");
include("../Models/students.php");
session_start();
session_destroy();
session_start();
 // Start the session

$conn = new Database(); // Create a database connection

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Get form inputs
    $email = trim($_POST['login-email']);
    $password = trim($_POST['login-password']);
    
    // Initialize variables for user and user type
    $user = null;
    $userType = null;

    // Check if the email exists in the Admins table
    $admin = new Admin($conn->getConnection());
    $user = $admin->getAdminByEmail($email);
    if ($user) {
        $userType = 'admin';
    }

    // If not found, check Professors table
    if (!$user) {
        $professor = new Professor($conn->getConnection());
        $user = $professor->getProfessorByEmail($email);
        if ($user) {
            $userType = 'professor';
        }
    }

    // If not found, check Students table
    if (!$user) {
        $student = new Student($conn->getConnection());
        $user = $student->getStudentByEmail($email);
        if ($user) {
            $userType = 'student';
        }
    }

    // If user is found and password matches
    if ($user && password_verify($password, $user['password_hash'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $userType;
        $_SESSION['email'] = $user['email'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['cin'] = $user['cin'];
        $_SESSION['date_of_birth'] = $user['date_of_birth'];

        // Redirect based on user type
        switch ($userType) {
            case 'admin':
                header("Location: ../Indexes/adminindex.php");
                exit();

            case 'professor':
                header("Location: ../Indexes/professorindex.php");
                exit();

            case 'student':
                header("Location: ../Indexes/studentindex.php");
                exit();
        }
    } else {
        // Set error in the session if login failed
        $_SESSION['error'] = "Invalid email or password.";

        // Redirect back to login page
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .container:first-child{
            padding: 1.8rem;
        }
    </style>
</head>
<body>
    
    <div class="container border d-flex flex-column" style="margin-top:30vh;">
        <div>
        <div class="header-div d-flex flex-row py-3">
            <div class="img-div col-5">
                <img src="../Assets/Images/Banners/Logo1.png" alt="Emsi Logo" class="img-fluid" style="width: 240px; height:60px">
            </div>
            <div class="col-7">
                <h1>Welcome!</h1>
            </div>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="login-email">Email address</label>
                <input type="email" id="login-email" name="login-email" class="form-control"aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="login-password" class="form-control"  placeholder="Password">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <a href="signup.php"><button type="button" class="btn btn-outline-success">Signup</button></a>
        </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>