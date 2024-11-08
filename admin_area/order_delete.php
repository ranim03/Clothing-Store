<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['order_delete'])){ //Cette ligne vérifie si le paramètre 'order_delete' est présent dans l'URL. isset($_GET['order_delete']) 
    //renvoie true si le paramètre 'order_delete' est défini dans l'URL, sinon false.

$delete_id = $_GET['order_delete'];// Si le paramètre 'order_delete' est présent dans l'URL, cette ligne récupère sa valeur et la stocke dans la variable $delete_id.

$delete_order = "delete from pending_orders where order_id='$delete_id'";

$run_delete = mysqli_query($con,$delete_order);//exécute la requête de suppression en utilisant la connexion à la base de données $con. Le résultat de la requête est stocké dans la variable $run_delete.

if($run_delete){

echo "<script>alert('Order Has Been Deleted')</script>";

echo "<script>window.open('index.php?view_orders','_self')</script>";


}


}



?>



<?php }  ?>