<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");
?>

  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">SHOP</span> Cart
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->



<div class="col-md-9" id="cart" ><!-- col-md-9 Starts -->

<div class="box" ><!-- box Starts -->
<!--ce formulaire envoie ses données au script PHP "cart.php" en utilisant la méthode "post" et l'encodage "multipart/form-data". Lorsqu'il est soumis, les données du formulaire seront accessibles dans le script "cart.php" pour traitement ultérieur.-->
<form action="cart.php" method="post" enctype="multipart-form-data" > 
  
<h1> Shopping Cart </h1>

<?php

$ip_add = getRealUserIp(); //Cette ligne appelle une fonction nommée getRealUserIp() pour récupérer l'adresse IP réelle de l'utilisateur actuel.

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

$count = mysqli_num_rows($run_cart);//cette ligne utilise la fonction mysqli_num_rows() pour compter le nombre de lignes retournées par la requête SQL précédente. Cela permet de déterminer combien d'articles se trouvent actuellement dans le panier de l'utilisateur.

?>

<p class="text-muted" > You currently have <?php echo $count; ?> item(s) in your cart. </p>

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table" ><!-- table Starts -->

<thead><!-- thead Starts -->

<tr>

<th colspan="2" >Product</th> <!--Cet entête de tableau est destiné à la colonne "Product" (produit). L'attribut colspan="2" indique que cette cellule doit s'étendre sur deux colonnes du tableau. Cela signifie que cette cellule fusionnera avec la cellule suivante "Quantity", créant ainsi une cellule plus large qui englobe à la fois le nom du produit et la quantité.  -->

<th>Quantity</th>

<th>Unit Price</th>

<th>Size</th>

<th colspan="1">Delete</th>

<th colspan="2"> Sub Total </th>


</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php

$total = 0; //initialise une variable 

while($row_cart = mysqli_fetch_array($run_cart)){  //Boucle while pour parcourir les éléments du panier 
//Récupération des informations sur le produit
$pro_id = $row_cart['p_id'];

$pro_size = $row_cart['size'];

$pro_qty = $row_cart['qty'];

$only_price = $row_cart['p_price'];

$get_products = "select * from products where product_id='$pro_id'";

$run_products = mysqli_query($con,$get_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_title = $row_products['product_title'];

$product_img1 = $row_products['product_img1'];

$sub_total = $only_price*$pro_qty;//Le sous-total pour chaque article est calculé en multipliant le prix unitaire du produit ($only_price) par la quantité du produit ($pro_qty). Ce sous-total est stocké dans la variable $sub_total

$_SESSION['pro_qty'] = $pro_qty;//La quantité du produit est stockée dans une variable de session $_SESSION['pro_qty']. Cela peut être utile pour d'autre

$total += $sub_total;

?>

<tr><!-- tr Starts -->

<td>

<img src="admin_area/product_images/<?php echo $product_img1; ?>" >

</td>

<td>

<a href="#" > <?php echo $product_title; ?> </a>

</td>

<td>
<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-product_id="<?php echo $pro_id; ?>" class="quantity form-control">
</td>

<td>

$<?php echo $only_price; ?>.00

</td>

<td>

<?php echo $pro_size; ?>

</td>

<td>
<input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"><!--permet à l'utilisateur de sélectionner un ou plusieurs éléments pour suppression dans un formulaire. Les valeurs des cases cochées seront envoyées au serveur sous forme de tableau PHP associé à la variable "remove[]"-->
</td>

<td>

$<?php echo $sub_total; ?>.00

</td>

</tr><!-- tr Ends -->

<?php } } ?>

</tbody><!-- tbody Ends -->

<tfoot><!-- tfoot Starts -->

<tr>

<th colspan="5"> Total </th>

<th colspan="2"> $<?php echo $total; ?>.00 </th>

</tr>

</tfoot><!-- tfoot Ends -->

</table><!-- table Ends -->




<div class="box-footer"><!-- box-footer Starts -->

<div class="pull-left"><!-- pull-left Starts -->

<a href="index.php" class="btn btn-default">

<i class="fa fa-chevron-left"></i> Continue Shopping

</a>

</div><!-- pull-left Ends -->

<div class="pull-right"><!-- pull-right Starts -->

<button class="btn btn-default" type="submit" name="update" value="Update Cart">

<i class="fa fa-refresh"></i> Update Cart

</button>

<a href="checkout.php" class="btn btn-primary">

Proceed to checkout <i class="fa fa-chevron-right"></i>

</a>

</div><!-- pull-right Ends -->

</div><!-- box-footer Ends -->

</form><!-- form Ends -->


</div><!-- box Ends -->



<?php

function update_cart(){

global $con;

if(isset($_POST['update'])){

foreach($_POST['remove'] as $remove_id){


$delete_product = "delete from cart where p_id='$remove_id'";

$run_delete = mysqli_query($con,$delete_product);

if($run_delete){
echo "<script>window.open('cart.php','_self')</script>";
}



}




}



}

echo @$up_cart = update_cart();



?>




</div><!-- col-md-9 Ends -->


</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>

$(document).ready(function(data){

$(document).on('keyup', '.quantity', function(){

var id = $(this).data("product_id");

var quantity = $(this).val();

if(quantity  != ''){

$.ajax({
//Cette partie envoie une requête AJAX à un script PHP nommé "change.php" en utilisant la méthode POST. Les données envoyées sont l'identifiant du produit (id) et la quantité (quantity).
//En cas de succès de la requête, la fonction success est appelée. Elle charge alors le contenu de "cart_body.php" dans le corps de la page HTML. Cela permet de mettre à jour dynamiquement le contenu du panier sans avoir à recharger toute la page.
url:"change.php",

method:"POST",

data:{id:id, quantity:quantity},

success:function(data){

$("body").load('cart_body.php');

}




});


}




});




});

</script>

</body>
