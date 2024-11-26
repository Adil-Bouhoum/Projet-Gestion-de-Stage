<?php

class Student
{
    // Database connection
    private $conn;
    private $table = "students";

    // Student properties
    public $id; // Now an auto-incrementing integer
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
            return $result->fetch_assoc(); // Return professor data as an associative array
        } else {
            return null; // No professor found with that email
        }
    }


    // Create a new student in the database
    public function createStudent()
    {
        $query = "INSERT INTO " . $this->table . " 
                  (firstname, lastname, email, password_hash, date_of_birth, phone_number, profile_picture_url, cin, student_id, department, year, major, assigned_professor_id, internship_status, company_name, start_date, end_date, resume_url, portfolio_url, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        // Sanitize input
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password_hash = $this->password_hash =password_hash($this->password_hash, PASSWORD_BCRYPT);
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->profile_picture_url = htmlspecialchars(strip_tags($this->profile_picture_url));
        $this->cin = htmlspecialchars(strip_tags($this->cin));
        $this->student_id = htmlspecialchars(strip_tags($this->student_id));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->major = htmlspecialchars(strip_tags($this->major));
        $this->assigned_professor_id = htmlspecialchars(strip_tags($this->assigned_professor_id));
        $this->internship_status = htmlspecialchars(strip_tags($this->internship_status));
        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->resume_url = htmlspecialchars(strip_tags($this->resume_url));
        $this->portfolio_url = htmlspecialchars(strip_tags($this->portfolio_url));

        // Bind parameters
        $stmt->bind_param(
            "sssssssssssissssss",
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->password_hash,
            $this->date_of_birth,
            $this->phone_number,
            $this->profile_picture_url,
            $this->cin,
            $this->student_id,
            $this->department,
            $this->year,
            $this->major,
            $this->assigned_professor_id,
            $this->internship_status,
            $this->company_name,
            $this->start_date,
            $this->end_date,
            $this->resume_url,
            $this->portfolio_url
        );

        if ($stmt->execute()) {
            return true;
        }

        error_log("Error creating student: " . $stmt->error);
        return false;
    }
}
?>
