<?php

session_start(); // on commence une session pour affihcer les infos lié a l'utilisateur mis en variable lors de la connexion

if (!isset($_SESSION['username'])) { // on verifie que la connexion ait été effectué en verifiant si un username est lié a la session
    header('Location:../Sign_In/index.php'); // si ce n'est pas le cas on redirige vers la page de connexion
    exit(); // on arrete le programe de cette page apres la redirection
}

if (!isset($_SESSION['id'])) { // on verifie que la connexion ait été effectué en verifiant si un id est lié a la session
    header('Location:../Sign_In/index.php'); // si ce n'est pas le cas on redirige vers la page de connexion
    exit(); // on arrete le programe de cette page apres la redirection
}

try { // connexion a la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=pokemon_users;charset=utf8', 'root', ''); // parametre du pdo pour se connecter a la BDD
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}

$desc = $pdo -> prepare("SELECT description FROM users WHERE id = ?"); // on recupere la description du user
$desc -> execute([$_SESSION['id']]); // on execute la requete
$description = $desc -> fetch(); // on fetch cette description pour l'afficher


if(isset($_POST['add'])) { // on parametre les boutons ici celui pour ajouter une description a son clic
    $description = $_POST['description']; // on recupere l'info rentré dans le champ de texte
    $desc = $pdo -> prepare("UPDATE users SET description = ? WHERE id = ?"); // on prepare la requete pour l'envoyer
    $desc -> execute([$description, $_SESSION['id']]); // on execute la requete

    header('Location: profil.php'); // on redirige sur la meme page pour recharger la page
    exit(); // on arrete le programme
}

if(isset($_POST['modify'])) { // ici c'est la meme chose mais avec modifier la description
    $description = $_POST['description'];
    $desc = $pdo -> prepare("UPDATE users SET description = ? WHERE id = ?");
    $desc -> execute([$description, $_SESSION['id']]);

    header('Location: profil.php');
    exit();
}

if(isset($_POST['delete'])) { // ici on supprime la descritpion
    $desc = $pdo -> prepare("UPDATE users SET description = NULL WHERE id = ?"); // on met en valeur de descritpion NULL pour la retirer
    $desc -> execute([$_SESSION['id']]);

    header('Location: profil.php');
    exit();
}


$order = 'ASC'; // valeur du tri selectionée au depart

if(isset($_POST['asc'])) { // condition de si on a appuyé sur le tri
    $order ='ASC'; // si on appui sur le bouton tri croissant on met la variable en ASC
} elseif (isset($_POST['desc'])) { // ici pareil mais avec DESC
    $order = 'DESC';
}

$fav = $pdo -> prepare('SELECT * FROM users_favorite WHERE user_id = ? ORDER BY card_id ' . $order); // on prepare la requete en fonction de la variable d'ordre pour le tri
$fav -> execute([$_SESSION['id']]); // on execute en fonction du user connecté
$favList = $fav -> fetchAll(PDO::FETCH_ASSOC); //on fetch le resultat pour l'afficher

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
        <a href="../MyCards/index.php">MyCards</a>
        <?php
        echo "bienvenue", htmlspecialchars($_SESSION['username']);  // si l'utilisateur est bien connecté, on affiche un message de bienvenue avec son username
        ?>

        <div id = description>

        <?php 
        
        if($description && !empty($description['description'])) { // les differents bouton pour la description en fonction de l'etat de celle ci
            echo htmlspecialchars($description['description']);
            echo "<form method = 'POST' action=''>
            <input type='text' name = 'description' placeholder ='Entrer votre description'>
            <input type= 'submit' name = 'modify' value = 'modifier sa description'>
            </form>";
            echo "<form method = 'POST' action=''>
            <input type= 'submit' name = 'delete' value = 'supprimer sa description'>
            </form>";
        } else {
            echo "<form method = 'POST' action=''>
                <input type='text' name = 'description' placeholder ='Entrer votre description'>
                <input type= 'submit' name = 'add' value = 'ajouter sa description'>
                </form>";
        }
        
        ?>



        </div>



        <div>

        <form method="POST">
        <button type="submit" name="asc">Tri croissant</button>
        <button type="submit" name="desc">Tri décroissant</button>
        </form>

            <?php 
            echo implode(", ", array_column ($favList, 'card_id')); // on affiche la liste des id des favoris que l'on peut trie avec les boutons au dessus
            ?>
        </div>

        <a href="../fichier de traitement php/deconnexion.php">Deconnexion</a> <!-- lien vers la page de deconnexion-->

    </main>
</body>
</html>