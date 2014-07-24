<?php
class Billing {

    private $db;

    public function __construct($database) {

        $this->db = $database;
    }

    public function list_invoices() {

        $query = $this->db->prepare("SELECT * FROM `invoices`");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function user_invoices($user_id) {

        $query = $this->db->prepare("SELECT * FROM `invoices` WHERE `user_id` = ?");

        $query->bindValue(1, $user_id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function get_invoice($id) {

        $query = $this->db->prepare("SELECT * FROM `invoices` WHERE `id` = ? LIMIT 1");

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

    public function invoice_items($id) {

        $query = $this->db->prepare("SELECT * FROM `invoice_items` WHERE `invoice_id` = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function create_invoice() {

    }
}