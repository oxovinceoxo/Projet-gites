<?php
require "Admin.php";

//instance de la class Admin
$Admin = new Admin();
?>
<h1>CONNEXION Administrateur</h1>
<form method="post" >
    <input type="email" name="email_admin" placeholder="Email">
    <input type="password" name="password_admin" placeholder="Mot de passe">
    <button name="ConnexionAdmin" type="submit">CONNECTER</button>
</form>



<?php
if(isset($_POST["ConnexionAdmin"])){
    $Admin->ConnexionAdmin();
}else{
    echo "merci de bien remplir les champs";
}
?>