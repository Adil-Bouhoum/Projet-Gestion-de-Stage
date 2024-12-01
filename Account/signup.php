<?php
include("../Connection/config.php");
include("../Models/admins.php");
include("../Models/professors.php");
include("../Models/students.php");
include("../Models/majors.php");

$conn = new Database();
if (isset($_POST["submit"])) {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $phone_number = $_POST["phonenumber"];
    $date_of_birth = $_POST["dateofbirth"];
    $cin = $_POST["cin"];
    $email = $_POST["signup-email"];
    $role = $_POST["user_role"];
    $profile_picture_url = '';

    $uploadDir = '../Assets/Images/Uploads';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['profile_picture']['type'];
        if (in_array($fileType, $allowedTypes)) {
            $fileName = uniqid() . '-' . basename($_FILES["profile_picture"]["name"]);
            $targetFile = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                $profile_picture_url = $targetFile;
            } else {
                die("Failed to upload file.");
            }
        } else {
            die("Invalid file type. Allowed: JPG, PNG, GIF.");
        }
    }
    

    if ($role == "admin") {
        $admin = new Admin($conn->getConnection());
        $admin->lastname = $lastname;
        $admin->firstname = $firstname;
        $admin->phone_number = $phone_number;
        $admin->date_of_birth = $date_of_birth;
        $admin->cin = $cin;
        $admin->email = $email;
        $admin->profile_picture_url = $profile_picture_url;
        $admin->password_hash = $admin->generateAdminPass();

        if ($admin->createAdmin()) {
            echo "Admin created successfully!";
            header("Location: login.php");
            exit;
        } else {
            echo "Failed to create admin.";
        }
    } elseif ($role == "professor") {
        $professor = new Professor($conn->getConnection());
        $professor->lastname = $lastname;
        $professor->firstname = $firstname;
        $professor->email = $email;
        $professor->phone_number = $phone_number;
        $professor->date_of_birth = $date_of_birth;
        $professor->cin = $cin;
        $professor->password_hash = $professor->generateProfessorPass();
        $professor->speciality = $_POST["speciality"] ?? null;
        $professor->major = $_POST["major"] ?? null;
        $professor->profile_picture_url = $profile_picture_url;
    
        if ($professor->createProfessor()) {
            echo "Professor created successfully!";
            header("Location: login.php");
            exit;
        } else {
            echo "Failed to create professor.";
        }
    } elseif ($role == "student") {
        $student = new Student($conn->getConnection());
        $student->lastname = $lastname;
        $student->firstname = $firstname;
        $student->email = $email;
        $student->phone_number = $phone_number;
        $student->date_of_birth = $date_of_birth;
        $student->cin = $cin;
        $student->password_hash = $student->generateStudentPass();
        $student->year = $_POST["year"] ?? null;
        $student->major = $_POST["major"] ?? null;
        $student->profile_picture_url = $profile_picture_url;
    
        if ($student->createStudent()) {
            echo "Student created successfully!";
            header("Location: login.php");
            exit;
        } else {
            echo "Failed to create student.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../assets/styles/style.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .container:first-child{
            padding: 1.8rem;
        }
    </style>
</head>
<body>
    <?php include("../components/nvb.php"); ?>

    <div class="container border d-flex flex-column mb-5" style="margin-top:2rem;">
        <div>
        <div class="header-div d-flex flex-row py-3">
            <div class="img-div col-5">
                <img src="../Assets/Images/Banners/Logo1.png" alt="Emsi Logo" class="img-fluid" style="width: 240px; height:60px">
            </div>
            <div class="col-7">
                <h1>Welcome!</h1>
            </div>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="role-selector">Select Role</label>
        <select id="role-selector" name="user_role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="professor">Professor</option>
            <option value="student">Student</option>
        </select>
    </div>

    <!-- Common Fields -->
    <div class="form-group">
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter LastName" required>
    </div>
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter FirstName" required>
    </div>
    <div class="form-group">
        <label for="phonenumber">Numero de Téléphone</label>
        <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="Enter Phone Number">
    </div>
    <div class="form-group">
        <label for="dateofbirth">Date de Naissance</label>
        <input type="date" id="dateofbirth" name="dateofbirth" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="cin">CIN</label>
        <input type="text" id="cin" name="cin" class="form-control" placeholder="Enter CIN">
    </div>
    <div class="form-group">
        <label for="signup-email">Email</label>
        <input type="email" id="signup-email" name="signup-email" class="form-control" placeholder="Enter Email" required>
    </div>
    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
    </div>

    <!-- Fields for Professor -->
<div id="professor-fields" class="conditional-fields" style="display: none;">
    <div class="form-group">
        <label for="speciality">Speciality</label>
        <input type="text" id="speciality" name="speciality" class="form-control" placeholder="Enter Speciality">
    </div>
    <div class="form-group">
        <label for="major-professor">Major</label>
        <select id="major-student" name="major" class="form-control">
            <option value="" disabled selected>Select Major</option>
            <?php
            $majors = major::selectAllMajors('majors', $conn->getConnection());
            foreach ($majors as $major) {
                echo "<option value='{$major['id']}'>{$major['majorName']}</option>";
            }
            ?>
        </select>
    </div>
</div>

<!-- Fields for Student -->
<div id="student-fields" class="conditional-fields" style="display: none;">
    <div class="form-group">
        <label for="year">Year</label>
        <input type="text" id="year" name="year" class="form-control" placeholder="Enter Year">
    </div>
    <div class="form-group">
        <label for="major-student">Major</label>
        <select id="major-student" name="major" class="form-control">
            <option value="" disabled selected>Select Major</option>
            <?php
            $majors = major::selectAllMajors('majors', $conn->getConnection());
            foreach ($majors as $major) {
                echo "<option value='{$major['id']}'>{$major['majorName']}</option>";
            }
            ?>
        </select>
    </div>
</div>

    <button type="submit" name="submit" class="btn btn-success">Submit</button>
</form>

        </div>
    </div>
    <?php include("../components/footer.php") ?>



    <script>
    // JavaScript to dynamically show/hide fields
    const roleSelector = document.getElementById('role-selector');
    const professorFields = document.getElementById('professor-fields');
    const studentFields = document.getElementById('student-fields');

    roleSelector.addEventListener('change', () => {
        const selectedRole = roleSelector.value;

        // Hide all conditional fields by default
        professorFields.style.display = 'none';
        studentFields.style.display = 'none';

        // Show fields based on selected role
        if (selectedRole === 'professor') {
            professorFields.style.display = 'block';
        } else if (selectedRole === 'student') {
            studentFields.style.display = 'block';
        }
    });

    // Trigger change event on page load to ensure correct fields are displayed
    roleSelector.dispatchEvent(new Event('change'));
</script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>