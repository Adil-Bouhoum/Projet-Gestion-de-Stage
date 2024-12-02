<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Account/login.php");
    exit(); 
}

$user_type = $_SESSION['user_type'] ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/styles/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

    <?php include('../components/nvb.php'); ?>
    <?php include('../components/snb.php'); ?>
    <?php if ($user_type == "admin")  include('../components/students_list.php');?>
    
    <div class="container-fluid p-0 mt-5">
        <!-- Content goes here -->
    </div>

    <?php include('../components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
