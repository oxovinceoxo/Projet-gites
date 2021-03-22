<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require "vendor/autoload.php";
require "DataBase.php";
class Reservation extends DataBase

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


        $BD = new PDO("mysql:host=localhost;dbname=gites;charset=utf8","root", "");
        //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
        $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM type WHERE id_gite = ?";
// 3 Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
    $requete_insertion = $BD->prepare($sql);
//Passage du ? à la valeur de $_GET['id_gite']
    $id = $_GET['id_gite'];
// 4 je bind (lier) les parametres
    $requete_insertion->bindParam(1, $id);
// 5 j'excute la requete
    $requete_insertion->execute();
// 6 j'affiche mon element avec fetch (pour charger les resultats)



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'réserver votre gite';
    while ($BD = $requete_insertion->fetch()) {
        //Stock de l'id dans une variable
        $emailId = $BD['id_gite'];
        //Url du liens de validation
        $url = "http://localhost/Gites3/confirmer_reservation?id_gite=$emailId";
        $mail->Body = '

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Votre reservation chez lebongite.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="color: #6cc3d5;">
    <div style="color: #6cc3d5; padding: 20px;">
    <h3 style="color: #1D2326">Le bon gite.COM</h3>
    
    <p>Vous avez déposé une demande de reservation (ET C BIEN)  avec le liens suivant</p><br />
        <p>Recapitulatif de votre commande</p>
        <p>Nom du gite :<b style="color: #2c4f56">' . $BD['nom'] . '</b></p>
        <p>Description du gite :<b style="color: #2c4f56"> ' . $BD['description'] . '</b></p>
        <p>Image du gite :<img src="https://www.leboupere.fr/medias/2016/02/Logo-gite.png"/></p>
        <p>Prix par semaine du gite :<b style="color: #2c4f56"> ' . $BD['prix'] . ' €</b></p>
        <p>Nombre de chambre :<b style="color: #2c4f56"> ' . $BD['nbr_chambre'] . '</b></p>
        <p>Nombre de salle de bain :<b style="color: #2c4f56"> ' . $BD['nbr_sdb'] . '</b></p>
        <p>Zone géographique :<b style="color: #2c4f56"> ' . $BD['zone'] . '</b></p>
        <p>Date arrivée :<b style="color: #2c4f56"> ' . $BD['date_arrivee'] . '</b></p>
        <p>Date départ :<b style="color: #2c4f56"> ' . $BD['date_depart'] . '</b></p>
        <p>Toutes fois vous avez la possibilité d\'annuler ou de confirmer votre commande</p>
        <br /><br />
        
    <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer la reservation de votre gite</a><br />
    
    ';
    }
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}