<?php
class Projects {

    private $db;

    public function __construct($database) {

        $this->db = $database;
    }

    public function new_project($name, $description, $customer, $status) {

        $query = $this->db->prepare("INSERT INTO `projects` (`name`, `description`, `created_on`, `customer`, `status`) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, date('Y-m-d H:i:s'));
        $query->bindValue(4, $customer);
        $query->bindValue(5, $status);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function list_projects() {

        $query = $this->db->prepare("SELECT * FROM `projects` ORDER BY `ID` DESC");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function delete_project($id) {

        $query = $this->db->prepare("DELETE from `projects` where `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_project($id) {

        $query = $this->db->prepare ("SELECT * from `projects` WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e){
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    public function update_project($name, $description, $customer, $status, $id) {

        $query = $this->db->prepare ("UPDATE `projects` SET `name` = ?, `description` = ?, `customer` = ?, `status` = ? WHERE `id` = ?");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, $customer);
        $query->bindValue(4, $status);
        $query->bindValue(5, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function list_project_tasks($id) {

        $query = $this->db->prepare ("SELECT * FROM `project_tasks` WHERE `project` = ? ORDER BY `id` DESC");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function list_project_notes($id) {

        $query = $this->db->prepare ("SELECT * FROM `project_notes` WHERE `project` = ? ORDER BY `id` DESC");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function new_task($project_id, $name, $description, $status) {

        $query = $this->db->prepare("INSERT INTO `project_tasks` (`project`, `name`, `description`, `created_on`, `status`) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $project_id);
        $query->bindValue(2, $name);
        $query->bindValue(3, $description);
        $query->bindValue(4, date('Y-m-d H:i:s'));
        $query->bindValue(5, $status);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_task($id) {

        $query = $this->db->prepare ("SELECT * from `project_tasks` WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e){
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    public function update_task($name, $description, $status, $id) {

        $query = $this->db->prepare ("UPDATE `project_tasks` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ?");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, $status);
        $query->bindValue(4, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function new_note($project_id, $title, $details) {

        $query = $this->db->prepare("INSERT INTO `project_notes` (`project`, `title`, `details`, `created_on`) VALUES (?, ?, ?, ?)");

        $query->bindValue(1, $project_id);
        $query->bindValue(2, $title);
        $query->bindValue(3, $details);
        $query->bindValue(4, date('Y-m-d H:i:s'));;

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_note($id) {

        $query = $this->db->prepare ("SELECT * from `project_notes` WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e){
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    public function update_note($title, $details, $id) {

        $query = $this->db->prepare ("UPDATE `project_notes` SET `title` = ?, `details` = ? WHERE `id` = ?");

        $query->bindValue(1, $title);
        $query->bindValue(2, $details);
        $query->bindValue(3, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function close_project($id) {

        $query = $this->db->prepare ("UPDATE `projects` SET `status` = 'Closed' WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete_project_tasks($id) {

        $query = $this->db->prepare ("DELETE FROM `project_tasks` WHERE `project` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete_project_notes($id) {

        $query = $this->db->prepare ("DELETE FROM `project_notes` WHERE `project` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}