<?php // cette page execute un script de deconnexion

session_start(); // on demara la session sur cette page
session_destroy(); // on detruit la session pour pouvoir se connecter avec un autre compte

header('Location:connexion.php'); // on redirige vers la page de connexion
exit(); // on arrete le programme
?>