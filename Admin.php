<?php

//Appel du fichier de la classe de connexion
require "Database.php";



//la class Admin hérite de la class Database
class Admin extends Database
{
    private $email_admin;
    private $password_admin;


    public function ConnexionAdmin(){

    $BD = $this->databaseConnexion();


    if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
        header('Location: http://localhost/Gites3');
    }else{
        header('Location: http://localhost/Gites3/connexion');
    }

    //Verification des champ du formulaire
    if(isset($_POST['email_admin']) && !empty($_POST['email_admin'])){
        $this->email_admin = htmlspecialchars(strip_tags($_POST['email_admin']));
    }else{
        echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        var_dump($this->email_admin);
    }

    if(isset($_POST['password_admin']) && !empty($_POST['password_admin'])){
        $this->password_admin = htmlspecialchars(strip_tags($_POST['password_admin']));
    }else{
        echo "<p class='alert-danger p-3'>Merci remplir le champ password</p>";
        var_dump($this->password_admin);
    }


        //requête de connexion
        $sql = "SELECT * FROM admin WHERE email_admin = ? AND password_admin = ?";

        //requête préparée
        $stmt = $BD->prepare($sql);

        //Bind des paramètre

        $stmt->bindParam(1, $_POST['email_admin']);
        $stmt->bindParam(2, $_POST['password_admin']);
        //Attention ici 2 paramètres a liés
        $stmt->execute();



    if($stmt->rowCount() >= 1){
        //Créer une variable qui liste (recherche) tous les element
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_admin = $row['id'];
        //Récupérer de l'email
        $this->email_admin = $row['email_admin'];
        $this->password_admin = $row['password_admin'];


    if($_POST['email_admin'] == $row['email_admin'] && $_POST['password_admin'] == $row['password_admin']){
        //Démarre la session
        session_start();
        //Booléen pour verifier si on est connecté
        $_SESSION['connecter'] = true;
        $_SESSION['id_admin'] = $id_admin;
        $_SESSION['email_admin'] = $this->email_admin;
        //La redirection
        header('Location: http://localhost/Gites3/index.php');
    }else{
        echo "mot de passe ou email incorrect";
        }
    }else{
        echo "test";
    }
}

}