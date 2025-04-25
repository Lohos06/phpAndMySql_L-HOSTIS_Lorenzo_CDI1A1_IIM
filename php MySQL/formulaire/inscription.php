<?php

try { // connexion a la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=pokemon_users;charset=utf8', 'root', '');
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}

if (isset($_POST['ok'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $envoie = $pdo->prepare("INSERT INTO utilisateurs (pseudo, email, password) VALUES (?, ?, ?)");
    $envoie -> execute([$pseudo, $email, $hash]);

    header('Location: connexion.php');
    exit();

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form method="POST" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" placeholder="entrer votre nom">
    <br><br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="entrer votre email">
    <br><br>
    <label for="password">Mot de Passe</label>
    <input type="password" id="password" name="password" placeholder="entrer votre mot de passe">
    <br><br>
    <input type="submit" value="M'Inscrire" name="ok">
</form>


</body>
</html>