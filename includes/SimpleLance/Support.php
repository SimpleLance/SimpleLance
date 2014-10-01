<?php

namespace SimpleLance;

use PDOException;

/**
 * Class Support
 * @package SimpleLance
 */
class Support extends Mailer
{
    /**
     * @var
     */
    private $db;

    /**
     * @param $database
     */
    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * @return mixed
     */
    public function getPriorities()
    {
        $query = $this->db->prepare("SELECT * FROM ticket_priorities");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPriority($id)
    {
        $query = $this->db->prepare("SELECT priority FROM ticket_priorities WHERE id = ? LIMIT 1");

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

    /**
     * @return mixed
     */
    public function getStatuses()
    {
        $query = $this->db->prepare("SELECT * FROM ticket_statuses");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStatus($id)
    {
        $query = $this->db->prepare("SELECT status FROM ticket_statuses WHERE id = ?");

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

    /**
     * @param $subject
     * @param $content
     * @param $priority
     * @param $owner
     * @throws \Exception
     * @throws \phpmailerException
     */
    public function newTicket($subject, $content, $priority, $owner)
    {
        $query = $this->db->prepare("INSERT INTO tickets (subject, content, opened, priority, status, owner, last_reply_user, last_reply_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

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

        $user = $this->getUser($this->getTicket($this->lastTicketId())['owner']);

        $this->sendMail($params = array(
            'email' => $user['email'],
            'name' => $user['first_name']." ".$user['last_name'],
            'subject' => 'New support ticket',
            'body' => 'Hi '.ADMIN_NAME.',<br><br>'.$this->getUser($this->getTicket($this->lastTicketId())['owner'])['first_name'].' '.$this->getUser($this->getTicket($this->lastTicketId())['owner'])['last_name'].' has opened a new '. $this->getPriority($priority) .' priority support ticket with subject '.$subject.'.<br><br>You can view the ticket at http://'.SITE_URL.'/support/ticket?id='.$this->lastTicketId().'<br><br>Regards,<br>'. SITE_NAME
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function listUserTickets($id)
    {
        $query = $this->db->prepare("SELECT * FROM tickets WHERE owner = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @return mixed
     */
    public function listAllTickets()
    {
        $query = $this->db->prepare("SELECT * FROM tickets ORDER BY last_reply_date ASC");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $ticket_id
     * @param $content
     * @param $user_id
     * @param $status
     * @throws \Exception
     * @throws \phpmailerException
     */
    public function updateTicket($ticket_id, $content, $user_id, $status)
    {
        // insert ticket reply to db
        $query1 = $this->db->prepare("INSERT INTO ticket_replies (ticket_id, content, replied_on, user_id) VALUES (?, ?, ?, ?)");

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
        $query2 = $this->db->prepare("UPDATE tickets SET status = ?, last_reply_user = ?, last_reply_date = ? WHERE id = ? ");

        $query2->bindValue(1, $status);
        $query2->bindValue(2, $user_id);
        $query2->bindValue(3, date('Y-m-d H:i:s'));
        $query2->bindValue(4, $ticket_id);

        try {
            $query2->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $user = $this->getUser($this->getTicket($ticket_id)['owner']);

        // check if reply from user
        if ($status == '2' || $status == '3') {

            $this->sendMail($params = array(
                'email' => $user['email'],
                'name' => $user['first_name']." ".$user['last_name'],
                'subject' => 'Updated support ticket',
                'body' => 'Hi '.$user['first_name'].' '.$user['last_name'].',<br><br>Your support ticket with subject '.$this->getTicket($ticket_id)['subject'].' has been updated.<br><br>You can view the ticket at http://'.SITE_URL.'/support/ticket?id='.$this->lastTicketId().'<br><br>Regards,<br>'. SITE_NAME
            ));

        } elseif ($status = '1') { // check if reply from admin

            $this->sendMail($params = array(
                'email' => ADMIN_EMAIL,
                'name' => ADMIN_NAME,
                'subject' => 'Updated support ticket',
                'body' => 'Hi '.ADMIN_NAME.',<br><br>'.$user['first_name'].' '.$user['last_name'].' has updated their support ticket with subject '.$this->getTicket($ticket_id)['subject'].'.<br><br>You can view the ticket at http://'.SITE_URL.'/support/ticket?id='.$this->lastTicketId().'<br><br>Regards,<br>'. SITE_NAME
            ));
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function getTicket($id)
    {
        $query = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");

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

    /**
     * @param $id
     * @return mixed
     */
    public function getTicketReplies($id)
    {
        $query = $this->db->prepare("SELECT * FROM ticket_replies WHERE ticket_id = ? ORDER BY id ASC");

        $query->bindValue(1, $id);

        try {
        $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $id
     */
    public function deleteTicket($id)
    {
        $query1 = $this->db->prepare("DELETE FROM tickets WHERE id = ?");

        $query1->bindValue(1, $id);

        try {
            $query1->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $query2 = $this->db->prepare("DELETE FROM ticket_replies WHERE ticket_id = ?");

        $query2->bindValue(1, $id);

        try {
            $query2->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function lastTicketId()
    {
        $query = $this->db->prepare("SELECT id FROM tickets ORDER BY id DESC LIMIT 1");

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $data =  $query->fetch();
        $status = $data['id'];

        return $status;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id= ?");
        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetch();
    }
}
