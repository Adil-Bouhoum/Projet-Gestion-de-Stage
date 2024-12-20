<?php

class Admin
{
    // Database connection
    private $conn;
    private $table = "admins";

    // Admin properties
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
    public $created_at;
    public $updated_at;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getdb(){
        return $this->conn;
    }
    // Generate random admin password
    public function generateAdminPass($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        // Shuffle the characters to increase randomness
        $characters = str_shuffle($characters);

        // Generate the password
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }


    function getAdminByEmail($email) {
        global $conn; // Assuming you have the $conn object from the Database class
        $query = "SELECT * FROM admins WHERE email = ?";
        $stmt = $this->getdb()->prepare($query);
        
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }
    
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc(); // Return user data as an associative array
        } else {
            return null; // No user found with that email
        }
    }

    function loginAdmin($email, $password) {
        // Get user by email
        $user = $this->getAdminByEmail($email);
        
        if (!$user) {
            // User not found
            return "Invalid email or password.";
        }
    
        // Verify password
        if ($password === $user['password_hash']) {
            // Password is correct, start a session
            session_start();
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['email'] = $user['email']; // Store email in session (optional)
            $_SESSION['cin'] = $user['cin'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['date_of_birth'] = $user['date_of_birth']; // If you have a role (e.g. admin)
            
            // Redirect or return success message
            return "Login successful!";
        } else {
            // Incorrect password
            return "Invalid email or password.";
        }
    }

    // Create a new admin in the database
    public function createAdmin() {
        // SQL query to insert data into the admins table
        $query = "INSERT INTO " . $this->table . " 
                  (lastname, firstname, phone_number, date_of_birth, cin, email, profile_picture_url, password_hash, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
        // Prepare the statement using MySQLi
        $stmt = $this->getdb()->prepare($query);
    
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->getdb()->error);
        }
    
        // Sanitize input data
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->cin = htmlspecialchars(strip_tags($this->cin));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->profile_picture_url = htmlspecialchars(strip_tags($this->profile_picture_url));
        $this->password_hash = password_hash($this->password_hash, PASSWORD_BCRYPT);
    
        // Bind parameters for MySQLi
        $stmt->bind_param(
            "ssssssss", 
            $this->lastname, 
            $this->firstname, 
            $this->phone_number, 
            $this->date_of_birth, 
            $this->cin, 
            $this->email, 
            $this->profile_picture_url, 
            $this->password_hash
        );
        
    
        // Execute the query
        if ($stmt->execute()) {
            return true; // Successfully created the admin
        }
    
        // Log error (optional)
        error_log("Error creating admin: " . $stmt->error);
    
        return false; // Failed to create the admin
    }
    
}
?>
