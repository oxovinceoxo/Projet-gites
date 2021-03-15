<?php
require "DataBase.php";

//instance de la class database
$gite= new DataBase();
$gite->detailGite();

?>
<form method="post">
    <button name="SupGite" type="submit">supprimer gite</button>
</form>




<?php
if(isset($_POST["SupGite"])){
    $gite->delete();
}else{
    echo"attention cette operation supprime définitivement le gite";
}


