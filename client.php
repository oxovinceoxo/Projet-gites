<?php
require "DataBase.php";


//instance de la class database
$gite= new DataBase();
?>
    <h1>liste des Gites</h1>
        <h2>RECHERCHE UN GITE</h2>

<?php
$gite->FormulaireRecherche();

$gite->recuperationGitesCLient();








