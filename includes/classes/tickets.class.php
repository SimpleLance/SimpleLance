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

        $query = $this->db->prepare("INSERT INTO `tickets` (`subject`, `content`, `opened`, `priority`, `status`, `owner`, `last_reply_user`, `last_reply_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $query->bindValue(1, $subject);
        $query->bindValue(2, $content);
        $query->bindValue(3, date('Y-m-d H:i:s'));
        $query->bindValue(4, $priority);
        $query->bindValue(5, '1');
        $query->bindValue(6, $owner);
        $query->bindValue(7, $owner);
        $query->bindValue(8, date('Y-m-d H:i:s'));

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

        $query = $this->db->prepare("SELECT * FROM `tickets` ORDER BY `last_reply_date` ASC");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function update_ticket($ticket_id, $content, $user_id, $status) {
        // insert ticket reply to db
        $query1 = $this->db->prepare("INSERT INTO `ticket_replies` (`ticket_id`, `content`, `replied_on`, `user_id`) VALUES (?, ?, ?, ?)");

        $query1->bindValue(1, $ticket_id);
        $query1->bindValue(2, $content);
        $query1->bindValue(3, date('Y-m-d H:i:s'));
        $query1->bindValue(4, $user_id);

        try {
            $query1->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        // update status and
        $query2 = $this->db->prepare("UPDATE `tickets` SET `status` = ?, `last_reply_user` = ?, `last_reply_date` = ? WHERE `id` = ? ");

        $query2->bindValue(1, $status);
        $query2->bindValue(2, $user_id);
        $query2->bindValue(3, date('Y-m-d H:i:s'));
        $query2->bindValue(4, $ticket_id);

        try {
            $query2->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_ticket($id) {

        $query = $this->db->prepare("SELECT * FROM `tickets` WHERE `id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if ($query->rowCount() != '1') {
            return "Error";
        } else {
            return $query->fetch();
        }
    }

    public function get_ticket_replies($id) {

        $query = $this->db->prepare("SELECT * FROM `ticket_replies` WHERE `ticket_id` = ? ORDER BY `id` ASC");

        $query->bindValue(1, $id);

        try {
        $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
}