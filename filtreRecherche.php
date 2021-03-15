<?php
require "DataBase.php";
//Instance de la classe (copie de la classe Database)
$BD= new DataBase();
// on peut acceder au propriétés= les variable et aux méthode

?>
<h1>liste des Gites</h1>
<h2>RECHERCHE UN GITE</h2>

<form method="POST" action="filtreRecherche.php">


    <label for="prix">Prix</label>
    <select name="prix">
        <option value="3">prix</option>
        <option value="1">croissant</option>
        <option value="2">décroissant</option>

    </select>


    <label for="titre">Nombre de chambres</label>
    <select name="NbrChambre">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>


    <label for="titre">zone</label>
    <select name="zone">
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
    <?php

    $BD->filtrePrix();

   // $BD->NbrChambre();

