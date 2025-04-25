<?php

session_start(); // on commence une session pour affihcer les infos lié a l'utilisateur mis en variable lors de la connexion

if (!isset($_SESSION['pseudo'])) { // on verifie que la connexion ait été effectué en verifiant si un pseudo est lié a la session
    header('Location:connexion.php'); // si ce n'est pas le cas on redirige vers la page de connexion
    exit(); // on arrete le programe de cette page apres la redirection
}

echo "bienvenue", htmlspecialchars($_SESSION['pseudo']); // si l'utilisateur est bien connecté, on affiche un message de bienvenue avec son pseudo

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

        <a href="deconnexion.php">Deconnexion</a> <!-- lien vers la page de deconnexion-->

    </main>
</body>
</html>