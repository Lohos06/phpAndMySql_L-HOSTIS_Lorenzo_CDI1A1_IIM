<?php

try { // connexion a la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=exercice_users;charset=utf8', 'root', ''); // parametre du pdo pour se connecter a la BDD
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}

if(isset($_POST['ok'])) { // on verifie si un post a été fait
    $email = trim($_POST['email']); // si un poste a été fait, on stocke l'email du formulaire sans espace
    $password = trim($_POST['password']); // de meme avec le mot de passe

    $erreur = []; // on créer un tableau pour stocker les erreurs  
    
    if (empty($email)) { // on fait de meme avec l'email
        $erreur[] = "L'email est obligatoire";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si rempli, on verifie que l'email est valide, du style test@gmail.com
        $erreur[] = "L'email est invalide"; // message d'erreur sinon
    }
    
    if (empty($password)) { // on verifie que le mdp soit rempli
        $erreur[] = "Le mot de passe est obligatoire";
    }

    if(empty($erreur)) {

        $check = $pdo -> prepare("SELECT * FROM utilisateurs WHERE email = ?"); // dans le cas ou tout est valide, on recupere les infos en lien avec l'adresse mail donnée dans la BDD
        $check -> execute([$email]); // on execute la demande
        $user = $check -> fetch(PDO::FETCH_ASSOC); // on rend manipulable les infos en question en les mettant en tableaux associatif

        if ($user && password_verify($password, $user['password'])) { // on verifie de un l'existence de l'utilisateur et la correpondance entre le mdp hashé stocke en BDD et le hashage du mdp rentré dans le formulaire.
            session_start(); // si on arrive a se connecter on demarre une session
            $_SESSION['pseudo'] = $user['pseudo']; // on stock en variable de session le pseudo
            $_SESSION['email'] = $user['email']; // de meme avec l'email

            header('Location:profil.php'); // on redirige vers la page de profil
            exit(); // on arrete le programme
        } else {
            echo "mot de passe ou adresse mail invalide"; // si l'utilisateur n'existe pas ou que le mdp ne correspond pas, message d'erreur affiché
        }

    } else {
        echo implode(", ", $erreur); // on affiche les erreurs cumulées dans le tableaux separées d'une virgule puis un espace
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

<header> 
    <a href="inscription.php">inscription</a> <!-- lien vers la page d'inscription'-->
    <a href="connexion.php">connexion</a> <!-- lien vers la page de deconnexion-->
    <br>
    <br>
</header>

<main>

<form method="POST" action=""> <!-- formulaire de connexion en POST qui envoie les infos-->
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="entrer votre email"> <!-- Ici on rentre l'email-->
    <br><br>
    <label for="password">Mot de Passe</label>
    <input type="password" id="password" name="password" placeholder="entrer votre mot de passe"> <!-- Et ici le mdp-->
    <br><br>
    <input type="submit" value="Me connecter" name="ok"> <!-- Le bouton pour soummetre le formulaire -->
</form>

</main>

</body>
</html>