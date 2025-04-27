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

$getfavorites = $pdo -> prepare("SELECT card_id FROM users_favorite WHERE user_id = ?"); // on recupere la liste des id des cartes mise en favoris
$getfavorites -> execute([$_SESSION['id']]); // on execute la requete

$favorites = $getfavorites -> fetchAll(PDO::FETCH_COLUMN); // on fetch toute les lignes

echo json_encode($favorites); // on met en json ces favoris
?>