<?php

session_start();

if (!isset($_SESSION['pseudo'])) {
    header('Location:connexion.php');
    exit();
}

echo "bienvenue", htmlspecialchars($_SESSION['pseudo']);

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

        <a href="deconnexion.php">Deconnexion</a>

    </main>
</body>
</html>