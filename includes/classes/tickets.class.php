<?php
class Tickets {

    private $db;

    public function __construct($database) {

        $this->db = $database;
    }

    public function get_priorities() {

        $query = $this->db->prepare("SELECT * FROM `ticket_priorities`");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();

    }

    public function get_priority($id) {

        $query = $this->db->prepare("SELECT `priority` FROM `ticket_priorities` WHERE `id` = ? LIMIT 1");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $data =  $query->fetch();
        $priority = $data['priority'];
        return $priority;

    }

    public function get_statuses() {

        $query = $this->db->prepare("SELECT * FROM `ticket_statuses`");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function get_status($id) {

        $query = $this->db->prepare("SELECT `status` FROM `ticket_statuses` WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $data =  $query->fetch();
        $status = $data['status'];
        return $status;
    }

    public function new_ticket($subject, $content, $priority, $owner) {

        $query = $this->db->prepare("INSERT INTO `tickets` (`subject`, `content`, `opened`, `priority`, `status`, `owner`, `last_reply`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $query->bindValue(1, $subject);
        $query->bindValue(2, $content);
        $query->bindValue(3, date('Y-m-d H:i:s'));
        $query->bindValue(4, $priority);
        $query->bindValue(5, '1');
        $query->bindValue(6, $owner);
        $query->bindValue(7, $owner);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function user_tickets($id) {

        $query = $this->db->prepare("SELECT * FROM `tickets` WHERE `owner` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function list_tickets() {

        $query = $this->db->prepare("SELECT * FROM `tickets` ORDER BY `opened` ASC");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
}