<?php

try { // connexion a la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=pokemon_users;charset=utf8', 'root', ''); // parametre du pdo pour se connecter a la BDD
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}

if(isset($_POST['submit'])) { // on verifie si un post a été fait
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

        $check = $pdo -> prepare("SELECT id, username, email, password_hash FROM users WHERE email = ?"); // dans le cas ou tout est valide, on recupere les infos en lien avec l'adresse mail donnée dans la BDD
        $check -> execute([$email]); // on execute la demande
        $user = $check -> fetch(PDO::FETCH_ASSOC); // on rend manipulable les infos en question en les mettant en tableaux associatif

        if ($user && password_verify($password, $user['password_hash'])) { // on verifie de un l'existence de l'utilisateur et la correpondance entre le mdp hashé stocke en BDD et le hashage du mdp rentré dans le formulaire.
            session_start(); // si on arrive a se connecter on demarre une session
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // on stock en variable de session le username
            $_SESSION['email'] = $user['email']; // de meme avec l'email

            var_dump($_SESSION);

            header('Location:../profil/profil.php'); // on redirige vers la page de profil
            exit(); // on arrete le programme
        } else {
            $erreur[] = "mot de passe ou adresse mail invalide"; // si l'utilisateur n'existe pas ou que le mdp ne correspond pas, message d'erreur affiché
        }

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
    <meta name="description" content="Se Connecter"> <!-- description de la page -->

    <title>Pokemon Trading Center Sign in</title> <!-- Nom de la page -->
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
      <button id="sign_in" onclick="window.location.href = '../sign_in/Index.php';">Sign in</button>
      <button id="sign_up" onclick="window.location.href = '../Sign_up/Index.php';">Sign up</button>
    </nav>
  </header>

  <main>
      <!-- Formulaire principal -->
      <form id="registrationForm" method = "POST" action = ""> <!-- Le formulaire a un identifiant "registrationForm", utile pour la manipulation en JavaScript -->

        <!-- Champ pour l'email -->
        <label for="email">Email :</label> <!-- Label lié au champ "email" -->
        <input type="email" id="email" name="email" placeholder="Entrez votre email"> <!-- Champ d'entrée spécifique pour un email -->

        <!-- Champ pour le mot de passe -->
        <label for="password">Mot de passe :</label> <!-- Label lié au champ "password" -->
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"> <!-- Champ pour saisir un mot de passe -->

        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit" name = "submit">Se Connecter</button> <!-- Bouton pour soumettre les données -->
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
  <script src="../Script JS/BurgerMenu.js"></script>
  <script src="../Script JS/Darkmode.js"></script>
  <script src="../Script JS/SignIn.js"></script>
   <!-- lien avec le fichier local JavaScript -->
</body>
</html> <!-- fin du document -->
