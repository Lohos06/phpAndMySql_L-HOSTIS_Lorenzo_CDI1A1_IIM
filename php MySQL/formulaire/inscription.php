<?php

try { // connexion a la BDD en utilisant le PDO
    $pdo = new PDO('mysql:host=localhost;dbname=exercice_users;charset=utf8', 'root', '');
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}



if (isset($_POST['ok'])) { // on verifie si on a soumis le formulaire en verifiant si il y a un POST (issue du bouton de validation du formulaire)
    $pseudo = $_POST['pseudo']; // on recupere le pseudo mis dans le formulaire
    $email = trim($_POST['email']); // pareil avec l'email
    $password = trim($_POST['password']); // pareil avec le mdp

    $erreur = []; // on créer un tableau pour stocker les erreurs
    

    if(empty($pseudo)) { // on verifie si le pseudo est remplis
        $erreur[] = "Le pseudo est obligatoire"; // message d'erreur sinon
    }
    
    
    if (empty($email)) { // on fait de meme avec l'email
        $erreur[] = "L'email est obligatoire";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si rempli, on verifie que l'email est valide, du style test@gmail.com
        $erreur[] = "L'email est invalide"; // message d'erreur sinon
    }
    
    if (empty($password)) { // on verifie que le mdp soit rempli
        $erreur[] = "Le mot de passe est obligatoire";
    }

    if(empty($erreur)) {
    $hash = password_hash($password, PASSWORD_DEFAULT); // on hash le mdp pour la securité des données, ici on utilise le parametre password_default car ce parametre utilise le meilleur algoritme de hashage du moment, en ce moment Bycript

    $envoie = $pdo->prepare("INSERT INTO utilisateurs (pseudo, email, password) VALUES (?, ?, ?)"); // on prepare l'envoir des donnée en crant un ligne dans la table utilisateir contenant pseudo, email et mdp
    $envoie -> execute([$pseudo, $email, $hash]); // on met en valeur de chacuns le contenu mis dans les cases du formulaire lors de la validation de celui ci

    header('Location:connexion.php'); // on redirige vers la page de connexion
    exit(); // on stop le programme
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

<form method="POST" action=""> <!-- formulaire d'inscription en methode POST-->
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" placeholder="entrer votre nom"> <!-- zone de texte ou on met le pseudo-->
    <br><br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="entrer votre email"> <!-- zone de texte pour mettre l'email-->
    <br><br>
    <label for="password">Mot de Passe</label>
    <input type="password" id="password" name="password" placeholder="entrer votre mot de passe"> <!-- zone de texte pour rentrer le mdp-->
    <br><br>
    <input type="submit" value="M'Inscrire" name="ok"> <!-- boutton pour envoyer le formulaire-->
</form>

</main>

</body>
</html>