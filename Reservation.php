<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require "vendor/autoload.php";

class Reservation
{
public function reservationEmail (){
    //Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '754bcbdddf46fa';                     //SMTP username
    $mail->Password   = '43f5df2046fcf2';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;
    $mail->CharSet = 'UTF-8';//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('gite@vincrent.com', 'Mailer');
    $mail->addAddress('locagite@gite.com', 'Administrateur Annonces Games.com');
    $mail->addReplyTo('locagite@gite.com', 'Annonces Administration');




    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'réserver votre gite';
    $mail->Body    = '
    Salut c vincent
    
    
    ';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}