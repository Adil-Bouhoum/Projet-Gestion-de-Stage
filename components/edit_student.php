<?php
include_once '../Models/students.php';
include_once '../Connection/config.php';
$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student->id = $_POST['id'];
    $student->firstname = $_POST['firstname'];
    $student->lastname = $_POST['lastname'];
    $student->email = $_POST['email'];
    $student->date_of_birth = $_POST['date_of_birth'];
    $student->phone_number = $_POST['phone_number'];
    $student->cin = $_POST['cin'];
    $student->department = $_POST['department'];
    $student->year = $_POST['major'];
    $student->year = $_POST['year'];

    
    if ($student->updateStudent()) {
        // Redirect to the student table page or show success message
        header('Location: ../Indexes/index.php'); // Adjust the location as needed
        exit;
    } else {
        // Show an error message if the update failed
        echo "Error updating student information.";
    }
}
?>