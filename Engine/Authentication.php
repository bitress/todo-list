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


    public function userRegister()
    {

        try {

            if (  empty($this->username) ||
                empty($this->email) ||
                empty($this->password)) {
                return false;
            }



            $sql = "INSERT INTO " . $this->table_name . " SET username = :username, email = :email, password = :password";
            $stmt = $this->db->prepare($sql);

            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $hashed_password = password_hash($this->password, PASSWORD_ARGON2ID);


            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $hashed_password);

            if ($stmt->execute()){
                return true;
            }

            return false;

        } catch (Exception $exception){
            echo json_encode(array("success" => false, "message" => "Error: " . $exception->getMessage()));
        }

        return false;
    }

}