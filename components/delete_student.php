<?php 
include_once '../Models/students.php';
include_once '../Connection/config.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

if (isset($_GET['id'])) {
    $student->id = intval($_GET['id']); // Sanitize input
    if($student->deleteStudent($student->id)){
        header("Location: ../Indexes/index.php?message=Succeeded+to+delete+student");
        exit();
    }    
    else {
        header("Location: ../Indexes/index.php?message=Failed+to+delete+student");
        exit();
    }
}

?>