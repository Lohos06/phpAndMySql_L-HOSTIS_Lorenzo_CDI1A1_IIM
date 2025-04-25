<?php

try { // connexion a la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=pokemon_users;charset=utf8', 'root', '');
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}

if(isset($_POST['ok'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "email non valide";
        header('Location: connexion.php');
        exit();
    }

    $check = $pdo -> prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $check -> execute([$email]);
    $user = $check -> fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['email'] = $user['email'];

        header('Location:profil.php');
        exit();
    }

    else {
        echo "mot de passe ou adresse mail incorecte";
    }
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
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="entrer votre email">
    <br><br>
    <label for="password">Mot de Passe</label>
    <input type="password" id="password" name="password" placeholder="entrer votre mot de passe">
    <br><br>
    <input type="submit" value="Me connecter" name="ok">
</form>


</body>
</html>