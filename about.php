<?php

session_start();//Cette fonction démarre une nouvelle session ou restaure la session existante en fonction de l'identifiant de session passé via une requête GET ou POST,

include("includes/db.php");//contenir la logique de connexion à la base de données
include("includes/header.php");//contenir l'en-tête HTML commun à toutes les pages du site
include("functions/functions.php");//contenir des fonctions réutilisables
include("includes/main.php");//contenir le contenu principal spécifique à chaque page.
//L'utilisation de l'inclusion de fichiers permet de réduire la redondance du code en séparant le contenu en modules réutilisables, ce qui facilite la maintenance et l'évolutivité du code.

?>

  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">About</span> us
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>

<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->

<div class="col-md-12" ><!-- col-md-12 Starts -->

<div class="box" ><!-- box Starts -->

<?php

$get_about_us = "select * from about_us";

$run_about_us = mysqli_query($con,$get_about_us); 

$row_about_us = mysqli_fetch_array($run_about_us);//extrait une seule ligne de données de l'ensemble de résultats retourné par la requête SQL et la stocke dans le tableau associatif 

$about_heading = $row_about_us['about_heading']; //Cette ligne extrait la valeur de la colonne nommée "about_heading" de la ligne récupérée et l'assigne à la variable

$about_short_desc = $row_about_us['about_short_desc'];//Cette ligne fait la même chose que la précédente, mais extrait la valeur de la colonne nommée "about_short_desc" et l'assigne à la variable $about_short_desc

$about_desc = $row_about_us['about_desc'];

?>

<h1> <?php echo $about_heading; ?> </h1>

<p class="lead"> <?php echo $about_short_desc; ?> </p>

<p> <?php echo $about_desc; ?> </p>

</div><!-- box Ends -->

</div><!-- col-md-12 Ends -->



</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
