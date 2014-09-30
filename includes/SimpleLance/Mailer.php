<?php

namespace SimpleLance;

class Mailer
{
    public function __construct()
    {

    }

    public function sendMail($params)
    {
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
        $mail->AddAddress($params['email'], $params['name']);
        $mail->IsHTML(true);
        $mail->Subject = $params['subject'];
        $mail->Body    = $params['body'];
        $mail->Send();
    }
} 