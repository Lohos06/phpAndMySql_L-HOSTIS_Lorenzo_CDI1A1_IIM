<?php

try { // connexion a la BDD en utilisant le PDO
    $pdo = new PDO('mysql:host=localhost;dbname=pokemon_users;charset=utf8', 'root', '');
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}



if (isset($_POST['submit'])) { // on verifie si on a soumis le formulaire en verifiant si il y a un POST (issue du bouton de validation du formulaire)
    $username = $_POST['username']; // on recupere le username mis dans le formulaire
    $email = trim($_POST['email']); // pareil avec l'email
    $password = trim($_POST['password']); // pareil avec le mdp
    $confirmPassword = trim($_POST['confirmPassword']); // pareil avec le mdp confirmé

    $erreur = []; // on créer un tableau pour stocker les erreurs
    

    if(empty($username)) { // on verifie si le username est remplis
        $erreur[] = "Le username est obligatoire"; // message d'erreur sinon
    } else {
    $check = $pdo -> prepare("SELECT * FROM users WHERE username = ?");
    $check -> execute([$username]);
    $existingUser = $check->fetch();
    if (!empty($existingUser)){
    $erreur[] = "Pseudo déjà utilisé"; // message d'erreur sinon
    }}

    if (empty($email)) { // on fait de meme avec l'email
        $erreur[] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si rempli, on verifie que l'email est valide, du style test@gmail.com
        $erreur[] = "L'email est invalide"; // message d'erreur sinon
    } else {
    $check = $pdo -> prepare("SELECT * FROM users WHERE email = ?");
    $check -> execute([$email]);
    $existingEmail = $check->fetch();
    if (!empty($existingEmail)){
    $erreur[] = "Email déjà utilisé"; // message d'erreur sinon
    }}
       
    if (empty($password)) { // on verifie que le mdp soit rempli
        $erreur[] = "Le mot de passe est obligatoire";
    } elseif ( $password !== $confirmPassword) {
      $erreur[] = "Les mots de passe ne correspondent pas"; // message d'erreur sinon
    }

    if(empty($erreur)) {
    $hash = password_hash($password, PASSWORD_DEFAULT); // on hash le mdp pour la securité des données, ici on utilise le parametre password_default car ce parametre utilise le meilleur algoritme de hashage du moment, en ce moment Bycript

    $envoie = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)"); // on prepare l'envoir des donnée en crant un ligne dans la table utilisateir contenant username, email et mdp
    $envoie -> execute([$username, $email, $hash]); // on met en valeur de chacuns le contenu mis dans les cases du formulaire lors de la validation de celui ci

    header('Location:Sign_in.php'); // on redirige vers la page de connexion
    exit(); // on stop le programme
    }
}

?>



<!DOCTYPE html> <!-- initialisation du de la page -->
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../Composants Css/Root.css">
    <link rel="stylesheet" href="../Composants Css/Header.css">
    <link rel="stylesheet" href="../Composants Css/Form.css">
    <link rel="stylesheet" href="../Composants Css/Footer.css">
    <link rel="stylesheet" href="../Composants Css/Darkmode.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- dispositif pour le responsive -->
    <meta name="description" content="S'inscrire"> <!-- description de la page -->

    <title>Pokemon Trading Center Sign up</title> <!-- Nom de la page -->
</head>

<body>
  <header id="header">
    <div>
      <img id="logo" src="../assets/ImagePokemon/Pokeball.png" alt="Pokeball"> <!-- Logo de pokeball -->
    </div>
    <button id="BurgerMenuToggle" class="Burger-menu"> <!-- bouton menu burger pour mobile -->
      ☰
    </button>
    <nav id="menu">  <!-- Menu des liens et boutons -->
      <a href="../Landing page/Index.html">Pokemon Trading Center The Begining</a>
      <a href="../Card List/Index.html">CardList</a>
      <a href="../MyCards/Index.html">MyCards</a>
      <button id="darkModeToggle">Activer le mode sombre</button> <!-- bouton darkmode -->
      <button id="sign_in" onclick="window.location.href = '../sign_in/Index.html';">Sign in</button>
      <button id="sign_up" onclick="window.location.href = '../Sign_up/Index.php';">Sign up</button>
    </nav>
  </header>

  <main>
    <!-- Formulaire principal -->
    <form id="registrationForm" method = "POST" action = ""> <!-- Le formulaire a un identifiant "registrationForm", utile pour la manipulation en JavaScript -->
      <!-- Champ pour le username -->
      <label for="username">username :</label> <!-- Label lié au champ "username" -->
      <input type="text" id="username" name="username" placeholder="Entrez votre username"> <!-- Champ texte pour le username -->

      <!-- Champ pour l'email -->
      <label for="email">Email :</label> <!-- Label lié au champ "email" -->
      <input type="email" id="email" name="email" placeholder="Entrez votre email"> <!-- Champ d'entrée spécifique pour un email -->

      <!-- Champ pour le mot de passe -->
      <label for="password">Mot de passe :</label> <!-- Label lié au champ "password" -->
      <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"> <!-- Champ pour saisir un mot de passe -->

      <!-- Champ pour confirmer le mot de passe -->
      <label for="confirmPassword">Confirmer le mot de passe :</label> <!-- Label lié au champ "confirmPassword" -->
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe"> <!-- Champ pour confirmer le mot de passe -->

      <!-- Question sur le type préféré -->
      <p>Quel est votre type préféré ?</p> <!-- Question posée -->
      <label><input type="radio" name="type" value="feu"> Feu</label>
      <label><input type="radio" name="type" value="eau"> Eau</label>
      <label><input type="radio" name="type" value="plante"> Plante</label>

      <button type="submit" id="submit" name = "submit">S'inscrire</button>
      <div id="feedback">

      <?php 
      
      if (!empty($erreur)) {
          echo '<div>' . implode(", ", $erreur) . '</div>'; // on affiche les erreurs cumulées dans le tableaux separées d'une virgule puis un espace
      }

      ?>

      </div> <!-- Zone pour afficher un message de retour (confirmation ou erreur générale) -->
    </form>
  </main>

  <footer id="footer"> <!-- information pour contacter le responsable du site -->
    <div>
      <h3>Nos contacts : Lorenzo.lhostis@edu.devinci.fr</h3>
    </div>
  </footer>
  <script src="../Script JS/SignUp.js"></script>
  <script src="../Script JS/BurgerMenu.js"></script>
  <script src="../Script JS/Darkmode.js"></script>
</body>
</html> <!-- fin du document -->
