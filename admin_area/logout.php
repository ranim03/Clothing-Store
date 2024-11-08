<?php

session_start();

session_destroy();
//on démarrer une session avec session_start(). Ensuite, il détruit la session existante avec session_destroy().
// Cela signifie que toutes les données de session associées à l'utilisateur actuel sont effacées, et l'utilisateur est déconnecté.
echo "<script>window.open('login.php','_self')</script>";
//on utilise JavaScript pour rediriger l'utilisateur vers la page de connexion (login.php) en utilisant window.open() dans un nouvel onglet ('_self')
//Cela garantit que l'utilisateur est redirigé vers la page de connexion après la destruction de la session.
?>