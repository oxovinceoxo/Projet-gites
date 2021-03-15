<?php
require "Reservation.php";
$email= new Reservation();

?>
<form method="post">
    <button type="submit" name="envoyerMail">envoyer</button>
</form>



<?php
if(isset($_POST["envoyerMail"])){
    $email->reservationEmail();
}else {
    echo "<p class='alert-warning p-3'>Merci de remplir le formulaire avec votre email</p>";
}


