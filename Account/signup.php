<?php
include("../Connection/config.php");
include("../Models/admins.php");

$conn = new Database();
if (isset($_POST["submit"])) {
    $admin = new Admin($conn->getConnection()); 
    $admin->lastname =$_POST["lastname"];
    echo($_POST["lastname"]);
    $admin->firstname =$_POST["firstname"];
    $admin->phone_number =$_POST["phonenumber"];
    $admin->date_of_birth = $_POST["dateofbirth"];
    $admin->cin =$_POST["cin"];
    $admin->email = $_POST["signup-email"];
    echo "<script> alert('INFORMATION SASI TFO 3LA KHRA KIDAYR'); </script>";
    // File upload handling
    $admin->profile_picture_url = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        // Validate file type (example: image files only)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_picture']['type'], $allowedTypes)) {
            $admin->profile_picture_url = '../Assets/Images/Uploads/' . basename($_FILES["profile_picture"]["name"]);
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $admin->profile_picture_url);
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            exit;
        }
    }

    // Generate password
    $admin->password_hash = $admin->generateAdminPass();

    // Create admin record
    if ($admin->createAdmin()) {
        echo "Admin created successfully!";
        // Redirect to login page after success
        header("Location: login.php");
        exit; // Always call exit after header redirect
    } else {
        echo "Failed to create admin.";
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
    
    <div class="container border d-flex flex-column" style="margin-top:2rem;">
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
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" class="form-control"  placeholder="Enter LastName">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" class="form-control"  placeholder="Enter FirstName">
            </div>
            <div class="form-group">
                <label for="phonenumber">Numero de Téléphone</label>
                <input type="tel" id="phonenumber" name="phonenumber" class="form-control"  placeholder="Enter Phone Number">
            </div>
            <div class="form-group">
                <label for="dateofbirth">Date de Naissance</label>
                <input type="date" id="dateofbirth" name="dateofbirth" class="form-control"  placeholder="Enter Date of Birth">
            </div>
            <div class="form-group">
                <label for="cin">CIN</label>
                <input type="text" id="cin" name="cin" class="form-control"  placeholder="Enter CIN">
                <span></span>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="signup-email" class="form-control"  placeholder="Enter email">
                <span></span>
            </div>
            <div class="form-group">
            <label for="profile_picture">Profile Picture: </label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <a href="login.php"><button type="button" class="btn btn-outline-success">Login</button></a>
        </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>