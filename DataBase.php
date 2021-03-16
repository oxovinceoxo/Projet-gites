<?php
session_start();

class DataBase{

    private $host = "localhost";
    private $dbname ="gites";
    private $user = "root";
    private $pass = "";

    public function databaseConnexion(){

//Essaie de se connecter
        try {
            $BD = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8", $this->user, $this->pass);
            //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $BD;
        } catch (PDOException $exception) {
            die("Erreur de connexion a PDO MySQL :" . $exception->getMessage());
        }

    }



    public function recuperationGites (){



        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
            ?>
            <a href="deconnexion.php">DECONNEXION</a> <br>
            <?php
        }else{

            ?>
            <a href="connexion.php">CONNEXION</a> <br>
            <?php
        }
        ?>
        <?php
        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){

        //apppel de la connexion
        $BD = $this->databaseConnexion();
// 1 requete sql pour affihcer tout les elements de la base de données
        $sql = "SELECT * FROM type";
// 2 je stock la requete dans une variable
        $liste = $BD->query($sql);

        ?>

        <h1>liste des Gites</h1>

        <a href="ajouterGites.php">ajouter un gite</a>

        <?php
// 3 je fais une boucle while ou foreach pour lister les elements de la table

        while ($row = $liste->fetch())
        {

            ?>
            <ul>
                <li><?=$row['id_gite']?></li>
                <li>nom: <?=$row['nom']?></li>
                <li>description: <?=$row['description']?></li>
                <li>image: <?=$row['image']?></li>
                <li>prix: <?=$row['prix']?></li>
                <li>nbr chambre: <?=$row['nbr_chambre']?></li>
                <li>nbr sdb: <?=$row['nbr_sdb']?></li>
                <li>disponible: <?=$row['disponible']?></li>
                <li>zone: <?=$row['zone']?></li>
                <li>date a: <?=$row['date_arrivee']?></li>
                <li>date d: <?=$row['date_depart']?></li>
            </ul>

            <a href="detail.php?id_gite=<?=$row['id_gite']?> " >detail</a>
            <a href="updateGite.php?id_gite=<?=$row['id_gite']?> ">update</a>
            <a href="delete.php?id_gite=<?=$row['id_gite']?> " >delete</a>
            <?php
        }
    }else{
            echo "merci de bien vouloir vous connecter pour acceder au crud";
        }

    }


    public function FormulaireRecherche(){

 ?>
        <form method="POST" action="filtreRecherche.php">

            <label for="prix">Prix</label>
            <select name="prix">
                <option value="9"></option>
                <option value="1">croissant</option>
                <option value="2">décroissant</option>
            </select>


            <label for="titre">Nombre de chambres</label>
            <select name="NbrChambre">
                <option value="9"></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>


            <label for="titre">zone</label>
            <select name="zone">
                <option value="9"></option>
                <option value="mer">mer</option>
                <option value="montagne">montagne</option>
                <option value="campagne">campagne</option>
                <option value="ville">ville</option>
            </select>

            <label for="date">date d'arrivée</label>
            <input type="date"  name="date_arrivee">

            <label for="date">date de départ</label>
            <input type="date"  name="date_depart">

            <button name="recherche" type="submit">RECHERCHE</button>

        </form>


     <?php
    }

    public function recuperationGitesCLient (){

        //apppel de la connexion
        $BD = $this->databaseConnexion();

        $today= date("Y-m-d");

        // 1 requete sql pour afficher tout les elements de la base de données
        $sql = "SELECT * FROM `type` WHERE '$today'>= `date_depart` AND disponible = 1";
        // 2 je stock la requete dans une variable
        $liste = $BD->query($sql);

        // 3 je fais une boucle while ou foreach pour lister les elements de la table

        while ($row = $liste->fetch()){

            ?>
            <ul>
                <li><?=$row['id_gite']?></li>
                <li>nom: <?=$row['nom']?></li>
                <li>description: <?=$row['description']?></li>
                <li>image: <?=$row['image']?></li>
                <li>prix: <?=$row['prix']?></li>
                <li>nbr chambre: <?=$row['nbr_chambre']?></li>
                <li>nbr sdb: <?=$row['nbr_sdb']?></li>
                <li>disponible: <?=$row['disponible']?></li>
                <li>zone: <?=$row['zone']?></li>
                <li>date a: <?=$row['date_arrivee']?></li>
                <li>date d: <?=$row['date_depart']?></li>
            </ul>

            <a href="detail.php?id_gite=<?=$row['id_gite']?> " >detail</a>

            <?php
        }
    }


    public function ShowResultat (){
        $BD=$this->databaseConnexion();

        if (($_POST['prix'] == 9) && ($_POST['NbrChambre'] == 9) && ($_POST['zone'] == 9)){
            header('Location: http://localhost/Gites3/client.php');
        }elseif((($_POST['prix'] == (1 || 2)) && ($_POST['NbrChambre'] == 9) && ($_POST['zone'] == 9))){
$this->filtrePrix();
        }

    }

    public function filtrePrix () {
    $BD=$this->databaseConnexion();
        if (isset($_POST['prix'])) {
        $prix = $_POST['prix'];

            if ($prix == 1) {
                $reponse = $BD->query("SELECT * FROM type ORDER BY prix ASC");
                        while ($row = $reponse->fetch()){

                        ?>
                        <ul>
                            <li><?=$row['id_gite']?></li>
                            <li>nom: <?=$row['nom']?></li>
                            <li>description: <?=$row['description']?></li>
                            <li>image: <?=$row['image']?></li>
                            <li>prix: <?=$row['prix']?></li>
                            <li>nbr chambre: <?=$row['nbr_chambre']?></li>
                            <li>nbr sdb: <?=$row['nbr_sdb']?></li>
                            <li>disponible: <?=$row['disponible']?></li>
                            <li>zone: <?=$row['zone']?></li>
                            <li>date a: <?=$row['date_arrivee']?></li>
                            <li>date d: <?=$row['date_depart']?></li>
                        </ul>

                        <a href="detail.php?id_gite=<?=$row['id_gite']?> " >detail</a>

                        <?php
                    }
            }elseif($prix == 2) {
                $reponse = $BD->query("SELECT * FROM type ORDER BY prix DESC");
                while ($row = $reponse->fetch())
            {

                ?>
                <ul>
                    <li><?=$row['id_gite']?></li>
                    <li>nom: <?=$row['nom']?></li>
                    <li>description: <?=$row['description']?></li>
                    <li>image: <?=$row['image']?></li>
                    <li>prix: <?=$row['prix']?></li>
                    <li>nbr chambre: <?=$row['nbr_chambre']?></li>
                    <li>nbr sdb: <?=$row['nbr_sdb']?></li>
                    <li>disponible: <?=$row['disponible']?></li>
                    <li>zone: <?=$row['zone']?></li>
                    <li>date a: <?=$row['date_arrivee']?></li>
                    <li>date d: <?=$row['date_depart']?></li>
                </ul>

                <a href="detail.php?id_gite=<?=$row['id_gite']?> " >detail</a>

                <?php


                }
            }



        }


}

    public function NbrChambre (){
        $BD=$this->databaseConnexion();


        if (isset($_POST['NbrChambre'])) {
        $NbrChambre = $_POST['NbrChambre'];

        $reponse = $BD->query("SELECT * FROM type WHERE nbr_chambre = {$NbrChambre}");
                        while ($row = $reponse->fetch()){

                        ?>
                        <ul>
                            <li><?=$row['id_gite']?></li>
                            <li>nom: <?=$row['nom']?></li>
                            <li>description: <?=$row['description']?></li>
                            <li>image: <?=$row['image']?></li>
                            <li>prix: <?=$row['prix']?></li>
                            <li>nbr chambre: <?=$row['nbr_chambre']?></li>
                            <li>nbr sdb: <?=$row['nbr_sdb']?></li>
                            <li>disponible: <?=$row['disponible']?></li>
                            <li>zone: <?=$row['zone']?></li>
                            <li>date a: <?=$row['date_arrivee']?></li>
                            <li>date d: <?=$row['date_depart']?></li>
                        </ul>

                        <a href="detail.php?id_gite=<?=$row['id_gite']?> " >detail</a>

                        <?php
                    }
            }
    }


    public function detailGite (){

        $BD = $this->databaseConnexion();

        // 2 Requètes SQL pour selectionner un element
        $sql = "SELECT * FROM type WHERE id_gite = ?";
// 3 Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
        $requete_insertion = $BD->prepare($sql);
//Passage du ? à la valeur de $_GET['id_film']
        $id = $_GET['id_gite'];
// 4 je bind (lier) les parametres
        $requete_insertion->bindParam(1, $id);
// 5 j'excute la requete
        $requete_insertion->execute();
// 6 j'affiche mon element avec fetch (pour charger les resultats)
        $resultat = $requete_insertion->fetch();

        if($resultat){
            ?>
            <h1>Detail gite</h1>
            <a href="index.php">retour</a>

            <ul>
                <li><?=$resultat['id_gite']?></li>
                <li><?=$resultat['nom']?></li>
                <li><?=$resultat['description']?></li>
                <li><?=$resultat['image']?></li>
                <li><?=$resultat['prix']?></li>
                <li><?=$resultat['nbr_chambre']?></li>
                <li><?=$resultat['nbr_sdb']?></li>
                <li><?=$resultat['disponible']?></li>
                <li><?=$resultat['zone']?></li>
                <li><?=$resultat['date_arrivee']?></li>
                <li><?=$resultat['date_depart']?></li>
            </ul>

       <a href="" >RESERVER</a>

            <?php
        }else{
            echo "<p>Erreur : cet ID n'existe pas</p>";
        }
    }


    public function updateGite (){

        $BD = $this->databaseConnexion();

//Recuperation du nom du gite
        if(isset($_POST["nom"]) && !empty($_POST["nom"])){
            $nom = htmlspecialchars(strip_tags($_POST['nom']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la description
        if(isset($_POST["description"]) && !empty($_POST["description"])){
            $description = htmlspecialchars(strip_tags($_POST['description']));

        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de l'image
        if(isset($_POST["image"]) && !empty($_POST["image"])){
            $image = htmlspecialchars(strip_tags($_POST['image']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }


        //Recuperation du nom du prix
        if(isset($_POST["prix"]) && !empty($_POST["prix"])){
            $prix = htmlspecialchars(strip_tags($_POST['prix']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation du Nombre de salle de bain
        if(isset($_POST["nbr_sdb"]) && !empty($_POST["nbr_sdb"])){
            $nbr_sdb = htmlspecialchars(strip_tags($_POST['nbr_sdb']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation du Nombre de chambres
        if(isset($_POST["nbr_chambre"]) && !empty($_POST["nbr_chambre"])){
            $nbr_chambre = htmlspecialchars(strip_tags($_POST['nbr_chambre']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la disponibilité
        if(isset($_POST["disponible"]) && !empty($_POST["disponible"])){
            $disponible = htmlspecialchars(strip_tags($_POST['disponible']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la zone
        if(isset($_POST["zone"]) && !empty($_POST["zone"])){
            $zone = htmlspecialchars(strip_tags($_POST['zone']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la date d'arrivée
        if(isset($_POST["date_arrivee"]) && !empty($_POST["date_arrivee"])){
            $date_arrivee = htmlspecialchars(strip_tags($_POST['date_arrivee']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la date de départ
        if(isset($_POST["date_depart"]) && !empty($_POST["date_depart"])){
            $date_depart = htmlspecialchars(strip_tags($_POST['date_depart']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }
        $id_gite=$_GET["id_gite"];
//j'écris la reqète SQL insert into pour rajouter une gite

        $sql = "UPDATE type SET nom=?, description=?, image=?, prix=?, nbr_sdb=?, nbr_chambre=?, disponible=?,  zone=?, date_arrivee=?, date_depart=? WHERE id_gite=?" ;
//Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
        $requete_insertion = $BD->prepare($sql);

        $requete_insertion->bindParam(1, $nom);
        $requete_insertion->bindParam(2, $description);
        $requete_insertion->bindParam(3, $image);
        $requete_insertion->bindParam(4, $prix);
        $requete_insertion->bindParam(5, $nbr_sdb);
        $requete_insertion->bindParam(6, $nbr_chambre);
        $requete_insertion->bindParam(7, $disponible);
        $requete_insertion->bindParam(8, $zone);
        $requete_insertion->bindParam(9, $date_arrivee);
        $requete_insertion->bindParam(10, $date_depart);
        $requete_insertion->bindParam(11, $id_gite);

        $insertion = $requete_insertion->execute(array($nom, $description, $image, $prix, $nbr_sdb, $nbr_chambre, $disponible, $zone, $date_arrivee, $date_depart, $id_gite));
//Si l'insertion fonctionne
        if($insertion){
            //Message de réusite + bouton de retour à la liste
            echo "le gite a bien été mis a jour";
            header("refresh:2, http://localhost/Gites3/index.php");
        }else{
            echo "merci de bien remplir les champs";
            var_dump($description);
        }


    }


    public function delete (){

        $BD = $this->databaseConnexion();

// 2 Requètes SQL pour selectionner un element (un film)
        $sql = "DELETE  FROM type WHERE id_gite = ?";
// 3 Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
        $requete_insertion = $BD->prepare($sql);
// 4 Passage du ? à la valeur de $_GET['id_film']
        $id = $_GET['id_gite'];
// 5 je bind (lier) les parametres
        $requete_insertion->bindParam(1, $id);
// 6 j'excute la requete
       $resultat = $requete_insertion->execute();

        if($resultat){
            //Message de réusite + bouton de retour à la liste
            echo "le gite a bien été supprimé";
            header("refresh:2, http://localhost/Gites3/index.php");
        }else{
            echo "merci de bien remplir les champs";
        }

    }


    public function ajouterGite (){

        $BD = $this->databaseConnexion();

        //Recuperation du nom du gite
        if(isset($_POST["nom"]) && !empty($_POST["nom"])){
            $nom = htmlspecialchars(strip_tags($_POST['nom']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la description
        if(isset($_POST["description"]) && !empty($_POST["description"])){
            $description = htmlspecialchars(strip_tags($_POST['description']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de l'image
        if(isset($_POST["image"]) && !empty($_POST["image"])){
            $image = htmlspecialchars(strip_tags($_POST['image']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }


        //Recuperation du nom du prix
        if(isset($_POST["prix"]) && !empty($_POST["prix"])){
            $prix = htmlspecialchars(strip_tags($_POST['prix']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation du Nombre de salle de bain
        if(isset($_POST["nbr_sdb"]) && !empty($_POST["nbr_sdb"])){
            $nbr_sdb = htmlspecialchars(strip_tags($_POST['nbr_sdb']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation du Nombre de chambres
        if(isset($_POST["nbr_chambre"]) && !empty($_POST["nbr_chambre"])){
            $nbr_chambre = htmlspecialchars(strip_tags($_POST['nbr_chambre']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la disponibilité
        if(isset($_POST["disponible"]) && !empty($_POST["disponible"])){
            $disponible = htmlspecialchars(strip_tags($_POST['disponible']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la zone
        if(isset($_POST["zone"]) && !empty($_POST["zone"])){
            $zone = htmlspecialchars(strip_tags($_POST['zone']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la date d'arrivée
        if(isset($_POST["date_arrivee"]) && !empty($_POST["date_arrivee"])){
            $date_arrivee = htmlspecialchars(strip_tags($_POST['date_arrivee']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }



        //Recuperation de la date de départ
        if(isset($_POST["date_depart"]) && !empty($_POST["date_depart"])){
            $date_depart = htmlspecialchars(strip_tags($_POST['date_depart']));
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger'>Erreur, merci de remplir le champ </p>";
        }

//j'écris la reqète SQL insert into pour rajouter une gite

        $sql = "INSERT INTO type (nom, description, image, prix, nbr_sdb, nbr_chambre, disponible,  zone, date_arrivee, date_depart ) VALUES (?,?,?,?,?,?,?,?,?,?)";
//Creation d'une requète péparée avec la fonction prepare de PDO qui execute la requète SQL
        $requete_insertion = $BD->prepare($sql);

        $requete_insertion->bindParam(1, $nom);
        $requete_insertion->bindParam(2, $description);
        $requete_insertion->bindParam(3, $image);
        $requete_insertion->bindParam(4, $prix);
        $requete_insertion->bindParam(5, $nbr_sdb);
        $requete_insertion->bindParam(6, $nbr_chambre);
        $requete_insertion->bindParam(7, $disponible);
        $requete_insertion->bindParam(8, $zone);
        $requete_insertion->bindParam(9, $date_arrivee);
        $requete_insertion->bindParam(10, $date_depart);

        $insertion = $requete_insertion->execute(array($nom, $description, $image, $prix, $nbr_sdb, $nbr_chambre, $disponible, $zone, $date_arrivee, $date_depart));
//Si l'insertion fonctionne
        if($insertion){
            //Message de réusite + bouton de retour à la liste
            echo "le gite a bien été créé";
            var_dump("le gite a bien été créé");
            header("refresh:5, http://localhost/Gites3/index.php");
        }else{
            echo "merci de bien remplir les champs";
        }


    }



}