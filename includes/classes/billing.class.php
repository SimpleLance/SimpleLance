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

        $query = $this->db->prepare("SELECT * FROM `invoices` WHERE `owner` = ?");

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

    public function create_invoice($owner, $created_date, $due_date) {

        $query = $this->db->prepare("INSERT INTO `invoices` (`owner`, `created_date`, `due_date`, `status`, `amount_due`) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $owner);
        $query->bindValue(2, $created_date);
        $query->bindValue(3, $due_date);
        $query->bindValue(4, 'Draft');
        $query->bindValue(5, '0');

        try {
            $query->execute();

        } catch (PDOException $e) {

            die($e->getMessage());
        }

        header("Location: /billing/add_details.php?id=" . $this->db->lastInsertId() . "");
    }

    public function add_invoice_item($invoice_id, $item, $price, $quantity, $total) {

        $query = $this->db->prepare("INSERT INTO `invoice_items` (`invoice_id`, `item`, `price`, `quantity`, `total`) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $invoice_id);
        $query->bindValue(2, $item);
        $query->bindValue(3, $price);
        $query->bindValue(4, $quantity);
        $query->bindValue(5, $total);

        try {
            $query->execute();

        } catch (PDOException $e) {

            die($e->getMessage());
        }

        $query2 = $this->db->prepare("UPDATE `invoices` SET `amount_due` = `amount_due` + ? WHERE `id` = ?");

        $query2->bindValue(1, $total);
        $query2->bindValue(2, $invoice_id);

        try {
            $query2->execute();

        } catch (PDOException $e) {

            die($e->getMessage());
        }

        header("Location: /billing/add_details.php?id=" . $invoice_id . "");
    }

    public function send_invoice($invoice_id, $email) {

        $query = $this->db->prepare("UPDATE `invoices` SET `status` = ? WHERE `id` = ?");

        $query->bindValue(1, 'Unpaid');
        $query->bindValue(2, $invoice_id);

        try {
            $query->execute();

        } catch (PDOException $e) {

            die($e->getMessage());
        }

        $subject = "New Invoice from SimpleLance Dev";
        $body = "Hi There, you have received a new invoice from SimpleLance Dev";
        $headers = "From: admin@simplelane.com";

        mail($email,$subject,$body,$headers);
    }
}

