<?php
require "DataBase.php";

//instance de la class database
$gite= new DataBase();
$DB=$gite->databaseConnexion();

//Requètes SQL
$sql = "SELECT * FROM type WHERE id_gite = ?";

//Objet qui retourne PDO statement etat de la table produits à l'instant
//var_dump($requete);
$requete= $DB->prepare($sql);
$mise_a_jour_id = $_GET['id_gite'];
echo "ID du produit à mettre a jour = " .$mise_a_jour_id;
//Passage du ? à la valeur de $_GET['id_produit']
$requete->bindParam(1, $mise_a_jour_id);
//Execute la requète
$requete->execute();
//pour afficher les vaeurs de la tables produits on doit utiliser la fonction fectch = rechercher
$resultat = $requete->fetch();

if($resultat){

?>

<h1>mise a jour d'un Gite ici</h1>
<form  method="POST">

    <label for="titre">Nom du gite</label>
    <input type="text" value="<?= $resultat['nom'] ?>" name="nom">

    <label for="titre">description</label>
    <input type="text" value="<?= $resultat['description'] ?>" name="description">

    <label for="titre">image</label>
    <input type="text" value="<?= $resultat['image'] ?>" name="image">

    <label for="prix">Prix</label>
    <input type="number" value="<?= $resultat['prix'] ?>" name="prix">

    <label for="titre">Nombre de salle de bain</label>
    <input type="text" value="<?= $resultat['nbr_sdb'] ?>" name="nbr_sdb">

    <label for="titre">Nombre de chambres</label>
    <input type="text" value="<?= $resultat['nbr_chambre'] ?>" name="nbr_chambre">

    <label for="titre">disponible</label>
    <input type="text" value="<?= $resultat['disponible'] ?>" name="disponible">

    <label for="titre">zone</label>
    <input type="text" value="<?= $resultat['zone'] ?>" name="zone">

    <label for="date">date d'arrivée</label>
    <input type="date" value="<?= $resultat['date_arrivee'] ?>" name="date_arrivee">

    <label for="date">date de départ</label>
    <input type="date" value="<?= $resultat['date_depart'] ?>" name="date_depart">

    <button name="majGite" type="submit">Enregistrer le gite</button>

</form>

<?php

if(isset($_POST["majGite"])){
    $id_gite=$_GET["id_gite"];
    $gite->updateGite();
}else{
    echo "merci de remplir tous les champs";
}
}