<?php

    namespace App\Models;
    use Core\Model;
    class UserModel extends Model
    {
        public function findUser($login) {
            $query = "SELECT * FROM users WHERE login='$login'";
            $user = $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }

        public function createUser($fullname, $email, $login, $password) {
            $query = "INSERT INTO 
                    users (`fullname`, `email`, `login`, `password`) 
                    VALUES ('$fullname', '$email', '$login', '$password');";
            $this->db->query($query);
            
            $id = $this->db->lastInsertId();
            return $id;
        }

        public function getUsers(): array {
            $query = "SELECT * FROM users";
            $users = $this->db->query($query)->fetchAll();
            return $users;
        }

        public function getUser($id) {
            $query = "SELECT * FROM users WHERE id='$id'";
            $user = $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }
    }