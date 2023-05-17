<?php

class User
{
    public $id;
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->id = $this->generateUserId();
    }

    public function generateUserId()
    {
        $user_id = md5(uniqid(rand(), true));
        return $user_id;
    }

    public function createUser($name, $last_name, $email, $password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $db = new DB();
        $db->query("INSERT INTO users (id, name, last_name, email, password) VALUES (:id, :name, :last_name, :email, :password)");
        $db->bind(":id", $this->id);
        $db->bind(":name", $name);
        $db->bind(":last_name", $last_name);
        $db->bind(":email", $email);
        $db->bind(":password", $password);
        $db->execute();
        if ($db->lastInsertId()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($email)
    {
        $db = new DB();
        $db->query("SELECT * FROM users WHERE email = :email");
        $db->bind(":email", $email);
        $user = $db->result();
        return $user;
    }

    public function getUserById($id)
    {
        $db = new DB();
        $db->query("SELECT * FROM users WHERE id = :id");
        $db->bind(":id", $id);
        $user = $db->result();
        return $user;
    }

    public function updateUser($name, $last_name, $email, $password)
    {
        $db = new DB();
        $db->query("UPDATE users SET name = :name, last_name = :last_name, email = :email, password = :password WHERE id = :id");
        $db->bind(":id", $this->id);
        $db->bind(":name", $name);
        $db->bind(":last_name", $last_name);
        $db->bind(":email", $email);
        $db->bind(":password", $password);
        $db->execute();
    }

    public function deleteUser($id)
    {
        $db = new DB();
        $db->query("DELETE FROM users WHERE id = :id");
        $db->bind(":id", $id);
        $db->execute();
    }

    public function getUsers()
    {
        $db = new DB();
        $db->query("SELECT * FROM users");
        $users = $db->resultSet();
        return $users;
    }

    public function verifyPassword($submitted, $hash)
    {
        //compare the hash with the password
        if (password_verify($submitted, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}
