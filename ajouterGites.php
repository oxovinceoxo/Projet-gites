<?php
require "DataBase.php";

//instance de la class database
$gite= new DataBase();
?>
<h1>Ajouter un Gite ici</h1>
        <!-- formulaire pour rajouter un film --->
    <form method="POST">

        <label for="titre">Nom du gite</label>
        <input type="text"  name="nom">

        <label for="titre">description</label>
        <input type="text"  name="description">

        <label for="titre">image</label>
        <input type="text"  name="image">

        <label for="prix">Prix</label>
        <input type="number"  name="prix">

        <label for="titre">Nombre de salle de bain</label>
        <input type="number"  name="nbr_sdb">

        <label for="titre">Nombre de chambres</label>
        <input type="number"  name="nbr_chambre">

        <label for="titre">disponible</label>
        <input type="number"  name="disponible">

        <label for="titre">zone</label>
        <input type="text"  name="zone">

        <label for="date">date d'arrivée</label>
        <input type="date"  name="date_arrivee">

        <label for="date">date de départ</label>
        <input type="date"  name="date_depart">

        <button name="boutonAjouter" type="submit">Enregistrer le gite</button>


        <?php
if(isset($_POST["boutonAjouter"])){
    $gite->ajouterGite();
}else{
    echo "merci de remplir tous les champs";
}

