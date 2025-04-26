<?php

try { // connexion a la BDD avec PDO
    $pdo = new PDO('mysql:host=localhost;dbname=catalogue_livres;charset=utf8', 'root', '');
} catch(PDOException $e) {
    die('erreur de connexion :' .$e->getMessage()); // erreur si connexion echouée
}



if (isset($_POST['submit'])) { // on verifie si on a appuyer sur le boutton de validation du formulaire
    $titre = $_POST['titre']; // si oui, on stocke en variable les données rentrées dans le formulaire, ici le titre
    $auteur = $_POST['auteur']; // l'auteur
    $annee_publication = $_POST['annee_publication']; // l'année de publication
    $disponible = isset($_POST['disponible']) ? 1 : 0; // la disponibilité si la checkbox a été cochée ou non

    $envoie = $pdo->prepare("INSERT INTO livres (titre, auteur, annee_publication, disponible) VALUES (?, ?, ?, ?)"); // on prepare l'envoie des données
    $envoie -> execute([$titre, $auteur, $annee_publication, $disponible]); // on donne les valeurs a envoyer

    header("Location: " . $_SERVER['PHP_SELF']); // on recharge la page en redirigeant sur elle meme
    exit(); // on arrete le programme
}

$infos = $pdo->query("SELECT * FROM livres"); // infos recupérés de la BDD actualisées du formulaire

$livres = $infos->fetchAll(PDO::FETCH_ASSOC); // on fetch les livres de la BDD et les mets en tableaux associatif pour pouvoir les afficher comme on le souhaite, ici on donne toute les infos dans le tableaux


// envoie et suppression pour ne pas interferer

// $envoie = $pdo->prepare("INSERT INTO livres (titre, auteur, annee_publication, disponible) VALUES (?, ?, ?, ?)");
// $envoie -> execute(['Test2', 'Test2', '2100', '0']);

//$envoie = $pdo->prepare("DELETE FROM livres WHERE titre = ?");
//$envoie -> execute(['Test2']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" />      
</head>
<body>

    <table>
        <thead> <!-- titre des colonnes -->
            <tr> 
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année de publication</th>
                <th>disponible</th>
            </tr>
        </thead>

        <tbody>
            <?php            
            foreach($livres as $key => $livres2) { // chaque ligne correspond a un livre
                echo "<tr>";
                echo "<td>" . $livres2["titre"] . "</td>"; // la colonne pour les titres
                echo "<td>" . $livres2["auteur"] . "</td>"; // la colonne pour les auteurs
                echo "<td>" . $livres2["annee_publication"] . "</td>"; // la colonne pour les années de publication
                echo "<td>" . ($livres2["disponible"] ? "Oui" : "Non") . "</td>"; // la colonne pour la disponinilité du livre
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Ajouter un Livre</h2> <!-- Formulaire d'envoie d'un livre dans la BDD -->

    <form action="" method = "POST"> <!-- Formulaire en methode POST -->

    <label for="titre">entrer un titre de Livre</label> 
    <input type="text" name = "titre" id = "titre" placeholder = "Texte"> <!-- champ de texte pour l'envoie du titre du livre -->
    <br>
    <label for="auteur">entrer l'auteur du livre</label>
    <input type="text" name = "auteur" id = "auteur" placeholder = "Texte"> <!-- champ de texte pour l'envoie de l'auteur du livre -->
    <br>
    <label for="annee_publication">entrer l'année de publication</label>
    <input type="number" name = "annee_publication" id = "annee_publication" placeholder = "Année"> <!-- champ de texte pour l'envoie de la date de publication du livre -->
    <br>
    <label for="disponible">Disponible</label>
    <input type="checkbox" name = "disponible" id = "disponible" placeholder = "Oui/Non"> <!-- checkbox pour l'envoie de la disponibilité du livre -->
    <br>
    <input type="submit" name = "submit" id = "submit"> <!-- bouton pour soumettre le formulaire et donc envoyer le livre a la BDD -->

    </form>
    
</body>
</html>