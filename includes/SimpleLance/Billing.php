<?php

namespace SimpleLance;

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

        $query = $this->db->prepare("INSERT INTO `invoices` (`owner`, `created_date`, `due_date`, `status`, `total`) VALUES (?, ?, ?, ?, ?)");

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

        $query2 = $this->db->prepare("UPDATE `invoices` SET `total` = `total` + ? WHERE `id` = ?");

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

        $mail = new \PHPMailer();
        $mail->IsSMTP();
        $mail->Host = EMAIL_SERVER;
        $mail->Port = EMAIL_PORT;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = EMAIL_SECURITY;
        $mail->From = EMAIL_FROM_ADDRESS;
        $mail->FromName = EMAIL_FROM_NAME;
        $mail->AddAddress($this->get_user($this->get_invoice($invoice_id)['owner'])['email'], $this->get_user($this->get_invoice($invoice_id)['owner'])['first_name'].' '.$this->get_user($this->get_invoice($invoice_id)['owner'])['last_name']);
        $mail->IsHTML(true);
        $mail->Subject = 'New invoice from '.SITE_NAME;
        $mail->Body    = 'Hi '.$this->get_user($this->get_invoice($invoice_id)['owner'])['first_name'].' '.$this->get_user($this->get_invoice($invoice_id)['owner'])['last_name'].',<br><br>A new invoice has been generated for you at '.SITE_NAME.'.<br><br>You can view the invoice at http://'.SITE_URL.'/billing/invoice?id='.$this->last_invoice_id().'<br><br>Regards,<br>'. SITE_NAME;
        $mail->Send();

        header("Location: /billing/");
    }

    public function mark_paid($invoice_id) {

        $query = $this->db->prepare("UPDATE `invoices` SET `status` = ?, `date_paid` = ? WHERE `id` = ?");

        $query->bindValue(1, 'Paid');
        $query->bindValue(2, date('Y-m-d'));
        $query->bindValue(3, $invoice_id);

        try {
            $query->execute();

        } catch (PDOException $e) {

            die($e->getMessage());
        }

        $mail = new \PHPMailer();
        $mail->IsSMTP();
        $mail->Host = EMAIL_SERVER;
        $mail->Port = EMAIL_PORT;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = EMAIL_SECURITY;
        $mail->From = EMAIL_FROM_ADDRESS;
        $mail->FromName = EMAIL_FROM_NAME;
        $mail->AddAddress($this->get_user($this->get_invoice($invoice_id)['owner'])['email'], $this->get_user($this->get_invoice($invoice_id)['owner'])['first_name'].' '.$this->get_user($this->get_invoice($invoice_id)['owner'])['last_name']);
        $mail->IsHTML(true);
        $mail->Subject = SITE_NAME.' Invoice Paid';
        $mail->Body    = 'Hi '.$this->get_user($this->get_invoice($invoice_id)['owner'])['first_name'].' '.$this->get_user($this->get_invoice($invoice_id)['owner'])['last_name'].',<br><br>Your invoice at '.SITE_NAME.'.  has now been paid and this email will act as your official receipt.<br><br>Regards,<br>'. SITE_NAME;
        $mail->Send();

        header("Location: /billing/");
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

    public function last_invoice_id() {

        $query = $this->db->prepare("SELECT `id` FROM `invoices` ORDER BY `id` DESC LIMIT 1");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $data =  $query->fetch();
        $status = $data['id'];
        return $status;
    }
}

