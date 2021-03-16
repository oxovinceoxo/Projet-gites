<?php
require "DataBase.php";
//Instance de la classe (copie de la classe Database)
$BD= new DataBase();
$gite= new DataBase();
// on peut acceder au propriétés= les variable et aux méthode

?>
<h1>Liste des Gites selon la recherche</h1>
<h2>RECHERCHE UN GITE</h2>

    <?php
    $gite->FormulaireRecherche();
    $prix = $_POST['prix'];
    $zone = $_POST['zone'];
    $chambre = $_POST['NbrChambre'];
    $dateArrivee = $_POST['date_arrivee'];
    $DateDepart = $_POST['date_depart'];
    $Recherche = $_POST['recherche'];

    $BD->ShowResultat();



    //$BD->filtrePrix();
    //$BD->NbrChambre();




