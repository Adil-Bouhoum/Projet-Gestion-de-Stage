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
        $this->password_hash = $this->password_hash =password_hash($this->password_hash, PASSWORD_BCRYPT);
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
            $this->major,
        );

        if ($stmt->execute()) {
            return true;
        }

        error_log("Error creating student: " . $stmt->error);
        return false;
    }
}
?>
