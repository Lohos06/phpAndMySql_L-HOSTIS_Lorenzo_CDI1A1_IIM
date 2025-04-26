<?php

session_start(); // on commence une session pour affihcer les infos lié a l'utilisateur mis en variable lors de la connexion

if (!isset($_SESSION['username'])) { // on verifie que la connexion ait été effectué en verifiant si un username est lié a la session
    header('Location:../Sign_In/index.php'); // si ce n'est pas le cas on redirige vers la page de connexion
    exit(); // on arrete le programe de cette page apres la redirection
}

 // si l'utilisateur est bien connecté, on affiche un message de bienvenue avec son username

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>

        <?php
        echo "bienvenue", htmlspecialchars($_SESSION['username']);
        ?>

        <a href="deconnexion.php">Deconnexion</a> <!-- lien vers la page de deconnexion-->

    </main>
</body>
</html>