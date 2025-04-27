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

if (isset($_POST['card_id'])) { // si on reçois un id alors on la met en variable
    $card_id = $_POST['card_id']; // variable recevant cette id se nommant card_id
} else {
    echo json_encode(['error' => 'ID de carte manquant']); // sinon on renvoie une erreur
    exit();
}

if (!empty($_SESSION['id']) && !empty($card_id)) { // si on est connécté avec un id de session et que on a reçus un id de carte
  
  $verify = $pdo -> prepare("SELECT user_id, card_id FROM users_favorite WHERE user_id = ? AND card_id = ?"); // on fait une requete
  $verify -> execute([$_SESSION['id'], $card_id]); // on execute la requete visant a verifier si on a pas deja cette carte en favoris
  $verifydata = $verify -> fetch(PDO::FETCH_ASSOC); // on recupere la response en tableaux associatif
  
  
  if (!$verifydata) { // si on a rien reçu c'est que on ne l'a pas deja en BDD donc on peut l'envoyer
    $addcard = $pdo -> prepare("INSERT INTO users_favorite (user_id, card_id) VALUES (?, ?)"); // requete pour l'envoyer
    $addcard -> execute([$_SESSION['id'], $card_id]); // on creer une ligne avec le user_id et le card_id
  } else {
    $deletecard = $pdo -> prepare("DELETE FROM users_favorite WHERE user_id = ? AND card_id = ?"); // si deja la, au clic on supprime la ligne
    $deletecard -> execute([$_SESSION['id'], $card_id]); // on execute
  }
  echo json_encode(["success" => true, "card_id" => $card_id]); // ligne pour envoyer le succes au JS
}

?>
