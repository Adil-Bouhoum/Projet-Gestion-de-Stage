<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "internship_management";
    public $conn;

    // Constructor to establish the database connection
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Function to create a table
    // Create the Admin table
    public function createAdminTable() {
        // SQL query to create the `admins` table
        $query = "
            CREATE TABLE IF NOT EXISTS admins (
                id INT AUTO_INCREMENT PRIMARY KEY,
                lastname VARCHAR(100) NOT NULL,
                firstname VARCHAR(100) NOT NULL,
                phone_number VARCHAR(15),
                date_of_birth DATE,
                cin VARCHAR(20) UNIQUE NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                profile_picture_url VARCHAR(255),
                password_hash VARCHAR(255) NOT NULL,
                password_reset_token VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ";

        // Execute the query using mysqli
        if ($this->conn->query($query) === TRUE) {
            echo "Admin table created successfully.";
        } else {
            // Log error if table creation fails
            error_log("Error creating admin table: " . $this->conn->error);
            throw new Exception("Error creating admin table.");
        }
    }
}

?>
