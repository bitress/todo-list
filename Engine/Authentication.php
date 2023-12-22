<?php

class Authentication
{

    /**
     * @var Database
     */
    private $db;

    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    /**
     * Register a new user by inserting their information into the database.
     *
     * This method checks for required user information, ensures the uniqueness of the username
     * and email, and then inserts the user data into the specified database table.
     *
     * @return bool True if the user is successfully registered, false otherwise.
     */
    public function userRegister(): bool
    {
        try {
            // Check if required user information is provided
            if (empty($this->username) || empty($this->email) || empty($this->password)) {
                return false;
            }

            // Check if the username is already taken
            if ($this->isUsernameExists()) {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Username is already taken."]);
                return false;
            }

            // Check if the email is already taken
            if ($this->isEmailExists()) {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Email is already taken."]);
                return false;
            }

            // SQL query to insert user data into the database
            $sql = "INSERT INTO " . $this->table_name . " SET username = :username, email = :email, password = :password";

            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);

            // Sanitize and bind parameters
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            // Hash the password
            $hashed_password = password_hash($this->password, PASSWORD_ARGON2ID);

            // Bind parameters to the prepared statement
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $hashed_password);

            // Execute the prepared statement
            if ($stmt->execute()) {
                return true;
            }

            // Execution failed
            return false;
        } catch (Exception $exception) {
            // Handle exceptions and return an error response
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error: " . $exception->getMessage()]);
        }

        // Default return if an exception occurs
        return false;
    }



    private function isEmailExists()
    {
        $sql = "SELECT email FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        }
        return false;
    }

    /**
     * Check if a username already exists in the database.
     *
     * This method queries the database to check if the specified username already exists.
     *
     * @return bool True if the username exists, false otherwise.
     */
    private function isUsernameExists(): bool
    {
        // SQL query to check for the existence of the username
        $sql = "SELECT username FROM " . $this->table_name . " WHERE username = :username";

        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);

        // Bind the username parameter to the prepared statement
        $stmt->bindParam(":username", $this->username);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Check if there are any rows returned (username exists)
            if ($stmt->rowCount() > 0) {
                return true;
            }

            // No rows returned (username does not exist)
            return false;
        }

        // Execution failed
        return false;
    }

}