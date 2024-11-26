<?php

class Professor
{
    // Database connection
    private $conn;
    private $table = "professors";

    // Professor properties
    public $id;
    public $lastname;
    public $firstname;
    public $phone_number;
    public $date_of_birth;
    public $cin;
    public $email;
    public $profile_picture_url;
    public $password_hash;
    public $password_reset_token;
    public $major;
    public $speciality;
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

    // Generate random professor password
    public function generateProfessorPass($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $characters = str_shuffle($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }

    function getProfessorByEmail($email)
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

    function loginProfessor($email, $password)
    {
        $user = $this->getProfessorByEmail($email);

        if (!$user) {
            return "Invalid email or password.";
        }

        if ($password === $user['password_hash']) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['cin'] = $user['cin'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['date_of_birth'] = $user['date_of_birth'];
            $_SESSION['major'] = $user['major'];
            $_SESSION['speciality'] = $user['speciality'];

            return "Login successful!";
        } else {
            return "Invalid email or password.";
        }
    }

    public function createProfessor()
    {
        $query = "INSERT INTO " . $this->table . " 
                  (lastname, firstname, phone_number, date_of_birth, cin, email, profile_picture_url, password_hash, major, speciality, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->getdb()->prepare($query);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->conn->error);
        }

        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->cin = htmlspecialchars(strip_tags($this->cin));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->profile_picture_url = htmlspecialchars(strip_tags($this->profile_picture_url));
        $this->password_hash = $this->password_hash =password_hash($this->password_hash, PASSWORD_BCRYPT);
        $this->major = htmlspecialchars(strip_tags($this->major));
        $this->speciality = htmlspecialchars(strip_tags($this->speciality));

        $stmt->bind_param(
            "ssssssssss",
            $this->lastname,
            $this->firstname,
            $this->phone_number,
            $this->date_of_birth,
            $this->cin,
            $this->email,
            $this->profile_picture_url,
            $this->password_hash,
            $this->major,
            $this->speciality
        );

        if ($stmt->execute()) {
            return true;
        }

        error_log("Error creating professor: " . $stmt->error);

        return false;
    }
}

?>
