<!DOCTYPE html> <!-- initialisation du de la page -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Composants Css/Root.css">
    <link rel="stylesheet" href="../Composants Css/Header.css">
    <link rel="stylesheet" href="../Composants Css/cardgenerator.css">
    <link rel="stylesheet" href="../Composants Css/favorite.css">
    <link rel="stylesheet" href="../Composants Css/modal.css">
    <link rel="stylesheet" href="../Composants Css/Footer.css">
    <link rel="stylesheet" href="../Composants Css/Darkmode.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- dispositif pour le responsive -->
    <meta name="description" content="All the Cards in the Game"> <!-- description de la page -->

    <title>Pokemon Trading Center</title> <!-- Nom de la page -->
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
      <button id="sign_up" onclick="window.location.href = '../Sign_up/Index.html';">Sign up</button>
    </nav>
  </header>


  <main> <!-- section principale de la page -->
    <div id="filters"> <!-- zone des filtres -->
      <input type="text" id="searchBar" placeholder="Rechercher un Pokémon..."> <!-- barre de recheche -->
      
      <select id="typeFilter"> <!-- filtre par type -->
          <option value="">Tous les types</option>
          <option value="fire">Feu</option>
          <option value="water">Eau</option>
          <option value="grass">Plante</option>
          <option value="electric">Électrik</option>
          <option value="ice">Glace</option>
          <option value="fighting">Combat</option>
          <option value="psychic">Psy</option>
          <option value="ghost">Spectre</option>
          <option value="dragon">Dragon</option>
          <option value="dark">Ténèbres</option>
          <option value="fairy">Fée</option>
      </select>
  
      <select id="statFilter"> <!-- filtre par stats -->
          <option value="">Trier par stats</option>
          <option value="hp">PV</option>
          <option value="attack">Attaque</option>
          <option value="defense">Défense</option>
          <option value="speed">Vitesse</option>
      </select>
  </div>
  
  <div id="pokemon-container"></div> <!-- le receptacle a carte -->   
      </Section> 
      
      <div id = "modalExchange">
        <form  id = "exchangeForm" action="page de traitement/index.html" method="post">
    
            <span id = "closeButton">Close</span>
    
            <div class="card-column">
                <label for="CardsExchanged">Cartes que vous enverrez</label>
                <div id="yourCards">
                    <input type="text" id = "CardsExchanged" name = "CardsExchanged">
                </div>
            </div>
    
            <div class="card-column">
                <label for="CardsRecieved">Cartes que vous recervrez</label>
                <div id="hisCards">
                    <input type="text" id = "CardsRecieved" name = "CardsRecieved">
                </div>
            </div>
        </form>
      </div>
      <button id = "exchangeButton">Echanger Vos Cartes</button>

  </main>
    <footer id="footer"> <!-- information pour contacter le responsable du site -->
      <div>
        <h3>Nos contacts : Lorenzo.lhostis@edu.devinci.fr</h3>
      </div>
    </footer>

    <script src="../Script JS/modal.js"></script>
    <script src="../Script JS/Darkmode.js"></script>
    <script src="../Script JS/favoritegenerator.js"></script>
    <script src="../Script JS/BurgerMenu.js"></script>

</body>
</html> <!-- fin du document -->