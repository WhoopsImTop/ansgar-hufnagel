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
        $mail->Subject = 'Ihre Bestellung bei Ansgar Hufnagel';

        $message = '<p style="color: #000000; font-size: 14px;">Hallo ' . $this->name  . ' ' . $this->last_name . ',<br>';
        $message .= 'vielen Dank für Ihre Bestellung, deine Bestellnummer ist:' . $this->order_id . ' bei Fragen können Sie sich gerne an mich wenden.<br>';
        $message .= 'Ihre Bestellung:<br>';
        $message .= '<table style="width: 100%; border: 1px solid #000000; border-collapse: collapse; margin-top: 20px;">';
        $message .= '<tr style="border: 1px solid #000000; border-collapse: collapse;">';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Produkt</th>';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Anzahl</th>';
        $message .= '<th style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">Preis</th>';
        $message .= '</tr>';
        //parse line items and add to message
        $lineItems = json_decode($this->lineItems, true);
        foreach ($lineItems as $lineItem) {
            $message .= '<tr style="border: 1px solid #000000; border-collapse: collapse;">';
            $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['name'] . '</td>';
            $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['quantity'] . '</td>';
            if ($lineItem['reduction']['reduction_price']) {
                $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['reduction']['reduction_price'] . '€</td>';
            } else {
                $message .= '<td style="border: 1px solid #000000; border-collapse: collapse; padding: 10px;">' . $lineItem['price'] . '€</td>';
            }
            $message .= '</tr>';
        }
        $message .= '</table>';
        $message .= '<br>';
        $message .= 'Gesamtpreis: ' . $this->total . '€<br>';
        $message .= '<br>';
        $message .= 'Sie werden in kürze eine E-Mail von mir bekommen, mit einer Rechnung und Bezahlinformationen.<br>';
        $message .= '<br><br>';
        $message .= 'Viele Grüße, Ansgar Hufnagel</p>';
        $template = $this->mycomp_email_filter($message);

        $mail->Body = $template['message'];
        $mail->AltBody = $template['message'];

        //send mail in php
        if (!$mail->send()) {
            //write to log File
            $this->writeLog('Mail Error: ' . $mail->ErrorInfo . ' ' . $this->email);
        } else {
            //write to log File
            $this->writeLog('Mail sent to: ' . $this->email);
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
        <title>Ansgar Hufnagel Bestellung</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      </head>';

        $info .= '<body style="margin: 0; padding: 0px 0px 150px 0px; background-color:#f8f8f8;">';

        $info .= '<table border="0" cellpadding="0" cellspacing="0" style="background-color:#f8f8f8; width:775px; max-width:90%; margin:0 auto;" >';

        $info .= '<tr><td style="padding: 20px 0px 20px 0px;">';
        $info .= '<p><img style="width: 100px" src="https://www.ansgar-hufnagel.de/logo.png" /><h3 style="font-size: 20px; font-weight: bold, color: #000">Ansgar Hufnagel</h3></p>';
        $info .= '</td></tr>';

        $info .= '<tr><td style="padding: 30px 30px 30px 30px; background-color:#FFFFFF; text-align:left; font-size:14px; color:#000000;">';
        $info .= '[message]';
        $info .= '</td></tr>';

        $info .= '<tr><td style="text-align:center; font-size:10px; padding:30px 0px 0px 0px; color:#000000;">';


        $info .= '&copy; ' . date("Y") . ' Ansgar Hufnagel. Alle Rechte vorbehalten';

        $info .= '</td></tr>';

        $info .= '</table>';


        $info .= '</body></html>';

        return $info;
    }

    public function writeLog($message)
    {
        $logFile = fopen('log.txt', 'a');
        fwrite($logFile, date("Y-m-d H:i:s") . ' ' . $message . "\n");
        fclose($logFile);
    }
}
