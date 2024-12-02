<?php

class Student
{
    // Database connection
    private $conn;
    private $table = "students";

    // Student properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password_hash;
    public $date_of_birth;
    public $phone_number;
    public $profile_picture_url;
    public $cin;
    public $student_id;
    public $department;
    public $year;
    public $major;
    public $assigned_professor_id;
    public $internship_status;
    public $company_name;
    public $start_date;
    public $end_date;
    public $resume_url;
    public $portfolio_url;
    public $created_at;
    public $updated_at;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getdb()
    {
        return $this->conn;
    }

    public function generateStudentPass($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $characters = str_shuffle($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }

    // Get student by email
    function getStudentByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->getdb()->prepare($query);

        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc(); // Return student data as an associative array
        } else {
            return null; // No student found with that email
        }
    }

    // Create a new student in the database
    public function createStudent()
    {
        $query = "INSERT INTO " . $this->table . " 
                  (firstname, lastname, email, password_hash, date_of_birth, phone_number, profile_picture_url, cin, year, major, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        // Sanitize input
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password_hash = password_hash($this->password_hash, PASSWORD_BCRYPT);
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->profile_picture_url = htmlspecialchars(strip_tags($this->profile_picture_url));
        $this->cin = htmlspecialchars(strip_tags($this->cin));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->major = htmlspecialchars(strip_tags($this->major));

        // Bind parameters
        $stmt->bind_param(
            "ssssssssss",
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->password_hash,
            $this->date_of_birth,
            $this->phone_number,
            $this->profile_picture_url,
            $this->cin,
            $this->year,
            $this->major
        );

        if ($stmt->execute()) {
            return true;
        }

        error_log("Error creating student: " . $stmt->error);
        return false;
    }

    // Fetch all students (for displaying in the table)
    public function getAllStudents()
    {
        $query = "SELECT id, firstname, lastname, email, date_of_birth, phone_number, cin, department, year, internship_status, company_name, start_date, end_date, resume_url, portfolio_url, major FROM " . $this->table;
        $stmt = $this->getdb()->prepare($query);
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }
        
        $stmt->execute();
        return $stmt->get_result(); // Return the result set
    }

    // Update student data
    public function updateStudent()
    {
        $query = "UPDATE " . $this->table . " SET
                  firstname = ?, lastname = ?, email = ?, date_of_birth = ?, phone_number = ?, cin = ?, department = ?, year = ?, major = ?
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        $stmt->bind_param(
            "sssssssiii",
            $this->firstname,  // 's' for string (First Name)
            $this->lastname,   // 's' for string (Last Name)
            $this->email,      // 's' for string (Email)
            $this->date_of_birth, // 's' for string (Date of Birth)
            $this->phone_number, // 's' for string (Phone Number)
            $this->cin,         // 's' for string (CIN)
            $this->department,  // 's' for string (Department)
            $this->major,
            $this->year,        // 'i' for integer (Year)
            $this->id
        );

        if (!$stmt->execute()) {
            // Output the error to help debug
            die('Execute failed: ' . $stmt->error);
        }
    
        return true;
    }

    public function getStudentById($id)
{
    $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Return student data as an associative array
    }
    return null;
}

    // Delete student by ID
    public function deleteStudent($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }

        error_log("Error deleting student: " . $stmt->error);
        return false;
    }

}
?>
