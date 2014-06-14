<?php
class Users {

    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function change_password($user_id, $password) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

        $query->bindValue(1, $password);
        $query->bindValue(2, $user_id);

        try {
            $query->execute();
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    
    public function fetch_info($what, $field, $value) {

        $allowed = array('id', 'username', 'first_name', 'last_name', 'email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
        if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
            throw new InvalidArgumentException;
        } else {

            $query = $this->db->prepare("SELECT $what FROM `users` WHERE $field = ?");

            $query->bindValue(1, $value);

            try {

                $query->execute();
            } catch (PDOException $e) {

                die($e->getMessage());
            }

            return $query->fetchColumn();
        }
    }

    public function user_exists($email) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
        $query->bindValue(1, $email);

        try {

            $query->execute();
            $rows = $query->fetchColumn();

            if ($rows == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function register($email, $first_name, $last_name, $display_name, $password, $access_level) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT INTO `users` (`email`, `first_name`, `last_name`, `display_name`, `password`, `access_level`) VALUES (?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $email);
        $query->bindValue(2, $first_name);
        $query->bindValue(3, $last_name);
        $query->bindValue(4, $display_name);
        $query->bindValue(5, $password);
        $query->bindValue(6, $access_level);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function login($email, $password) {

        $query = $this->db->prepare("SELECT `password`, `id`, `access_level`, `display_name` FROM `users` WHERE `email` = ?");
        $query->bindValue(1, $email);

        try {

            $query->execute();
            $data = $query->fetch();
            $stored_password = $data['password']; // stored hashed password
            $id = $data['id']; // id of the user to be returned if the password is verified, below.

            if (password_verify($password, $stored_password) === true) { // using the verify method to compare the password with the stored hashed password.
                $_SESSION['access_level'] = $data['access_level'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['display_name'] = $data['display_name'];
                return $id; // returning the user's id.
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function logged_in() {
        return(isset($_SESSION['id'])) ? true : false;
    }

    public function logged_in_protect() {
        if ($this->logged_in() === true) {
            header('Location: index.php');
            exit();
        }
    }

    public function logged_out_protect() {
        if ($this->logged_in() === false) {
            header('Location: login.php');
            exit();
        }
    }

    public function get_users() {

        $query = $this->db->prepare("SELECT * FROM `users` ORDER BY `id` ASC");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function delete_user($id) {
        $query = $this->db->prepare("DELETE from `users` where `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_user($id) {
        $query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetch();
    }

    public function update_profile($email, $first_name, $last_name, $display_name, $password, $id) {
        $query = $this->db->prepare("UPDATE `users` SET `email` = ?, `first_name` = ?, `last_name` = ?, `display_name` = ?, `password` = ? WHERE `id` = ?");

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query->bindValue(1, $email);
        $query->bindValue(2, $first_name);
        $query->bindValue(3, $last_name);
        $query->bindValue(4, $display_name);
        $query->bindValue(5, $password);
        $query->bindValue(6, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}