<?php

class User
{
    private $db;
    public function __construct()
    {
        // Instantiate Database
        $this->db = new Database;
    }


    // Find User By Email function
    public function findUserByEmail($email)
    {

        $this->db->query("SELECT * FROM users where email = :email");
        $this->db->bind(":email", $email);
        $row = $this->db->singleResult();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        }

        return false;
    }

    // Register User
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":email", $data['email']);
        $this->db->bind(":password", $data['password']);

        // Execute
        if ($this->db->executePrepareStmt()) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);

        $row = $this->db->singleResult();

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    // Get User By Id
    public function findUserById($id)
    {

        $this->db->query("SELECT * FROM users where id = :id");
        $this->db->bind(":id", $id);
        $row = $this->db->singleResult();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        }

        return false;
    }
}
