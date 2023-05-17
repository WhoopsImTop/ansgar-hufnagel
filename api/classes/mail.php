<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class mail extends customer
{

    public function sendConfirmationMail()
    {
        //setup smtp
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //setup mail
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM);
        $mail->addAddress($this->email, $this->name . ' ' . $this->last_name);

        $mail->isHTML(true);
        $mail->Subject = 'Farsight Festival Ticket Bestellung';

        $message = '<p style="color: #000000; font-size: 14px;">Hallo ' . $this->name  . ' ' . $this->last_name . ',<br>';
        $message .= 'vielen Dank für deine Ticket Bestellung, deine Bestellnummer ist:' . $this->order_id . ' bei Fragen kannst du dich gerne an uns wenden.<br>';
        $message .= 'Deine Bestellung:<br>';
        $message .= '<table style="width: 100%; border: 1px solid #000000; border-collapse: collapse; margin-top: 20px;">';
        $message .= '<tr style="border: 1px solid #000000; border-collapse: collapse;">';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Ticket</th>';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Anzahl</th>';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Preis</th>';
        $message .= '</tr>';
        //parse line items and add to message
        $lineItems = json_decode($this->lineItems, true);
        foreach ($lineItems as $lineItem) {
            $message .= '<tr style="border: 1px solid #000000; border-collapse: collapse;">';
            $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['name'] . '</td>';
            $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['quantity'] . '</td>';
            $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['price'] . '€</td>';
            $message .= '</tr>';
        }
        $message .= '</table>';
        $message .= '<br>';
        $message .= 'Gesamtpreis: ' . $this->total . '€<br>';
        $message .= '<br>';
        $message .= 'Bezahlung: ' . $this->payment_method . '<br>';
        $message .= '<br>';
        if($this->payment_method == 'Überweisung') {
            $message .= 'Bitte überweise den Gesamtbetrag auf folgendes Konto:<br>';
            $message .= 'Kontoinhaber: ' . KONTO_INHABER . '<br>';
            $message .= 'IBAN: ' . IBAN . '<br>';
            $message .= 'BIC: ' . BIC . '<br>';
            $message .= 'Verwendungszweck: Farsight Festival ' . $this->name . ' ' . $this->last_name . '<br>';
        } else {
            $message .= 'Bitte sende den Betrag an: <br> ' . PAYPAL_EMAIL . ' per PayPal Freunde und Familie.<br>';
        }
        $message .= '<br><br>';
        $message .= 'Viele Grüße, Torben und Mauel</p>';
        $template = $this->mycomp_email_filter($message);

        $mail->Body = $template['message'];
        $mail->AltBody = $template['message'];

        //send mail in php
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }


    public function mycomp_email_filter($message)
    {

        $template = $this->mycomp_email_details();

        $args['message'] = str_replace("[message]", $message, $template);

        return $args;
    }

    public function mycomp_email_details()
    {
        
        $info = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
       <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Grüne Flotte Auto Abo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      </head>';

        $info .= '<body style="margin: 0; padding: 0px 0px 150px 0px; background-color:#f8f8f8;">';

        $info .= '<table border="0" cellpadding="0" cellspacing="0" style="background-color:#f8f8f8; width:775px; max-width:90%; margin:0 auto;" >';

        $info .= '<tr><td style="padding: 20px 0px 20px 0px;">';
        $info .= '<img style="width: 250px" src="https://mein-campusplan.de/assets/image/logo.png" />';
        $info .= '</td></tr>';

        $info .= '<tr><td style="padding: 30px 30px 30px 30px; background-color:#FFFFFF; text-align:left; font-size:14px; color:#000000;">';
        $info .= '[message]';
        $info .= '</td></tr>';

        $info .= '<tr><td style="text-align:center; font-size:10px; padding:30px 0px 0px 0px; color:#000000;">';


        $info .= '&copy; ' . date("Y") . ' Farsight Festival. Alle Rechte vorbehalten';

        $info .= '</td></tr>';

        $info .= '</table>';


        $info .= '</body></html>';

        return $info;
    }
}
