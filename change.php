<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

?>

<?php


$ip_add = getRealUserIp();

if(isset($_POST['id'])){
 //vérifie si des données ont été envoyées via une requête POST et si la clé id est définie dans ces données. Si c'est le cas, cela signifie qu'une mise à jour de la quantité du produit dans le panier est demandée.
$id = $_POST['id'];

$qty = $_POST['quantity'];

$change_qty = "update cart set qty='$qty' where p_id='$id' AND ip_add='$ip_add'";

$run_qty = mysqli_query($con,$change_qty);


}


//post Utilisé pour envoyer des données au serveur pour traitement.
//Les données sont envoyées dans le corps de la requête HTTP et ne sont pas visibles dans l'URL.


?>