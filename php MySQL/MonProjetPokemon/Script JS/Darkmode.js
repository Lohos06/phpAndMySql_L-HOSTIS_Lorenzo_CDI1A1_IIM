document.addEventListener("DOMContentLoaded", function() {

// Declaration des elements qui changeront en darkmode

let darkModeToggle = document.getElementById('darkModeToggle'); // Sélectionne le bouton pour activer ou désactiver le mode sombre
let body = document.body;
let header = document.getElementById('header');
let menu = document.getElementById('menu');
let logo = document.getElementById('logo');
let menulinks = Array.from(document.querySelectorAll('a'));
let signUp = document.getElementById('sign_up');
let footer = document.getElementById('footer');

// Les elements specifique a CardList et MyCards
let searchBar = document.getElementById("searchBar");
let statFilter = document.getElementById("statFilter");
let typeFilter = document.getElementById("typeFilter");
let pokemoncards = document.getElementsByClassName("pokemon-card");

// Les element specifiques au formulaire
let form = document.getElementById("registrationForm");
let pseudo = document.getElementById("pseudo");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirmPassword");
let Radios = Array.from(document.querySelectorAll('input[type="radio"]'));
let submit = document.getElementById("submit");

// Les elements specifiques a la Landing Page
let pokemonBackground = document.getElementById("PokemonBackground");
let Accroche = document.getElementById("Accroche");
let boosters = document.getElementById("boosters")
let letter = document.getElementById("letter")
let start = document.getElementById("start");
let Titles = Array.from(document.getElementsByClassName('Title'));
let commentaires = Array.from(document.getElementsByClassName("comentaire"));
let prix = Array.from(document.getElementsByClassName('prix'));

// Les elements de la modale
let exchangeButton = document.getElementById('exchangeButton');
let exchangeFrom = document.getElementById('exchangeForm');

// Les elements de la fiche individuelle
let ficheIndividuelle = document.getElementById('ficheIndividuelle')


let darkmode = localStorage.getItem("darkmode"); // Initialisation du localstorage pour le dark mode

if (darkmode === "true") { // Si le darkmode est activé dans le local storage, il sera activé dés le chargement du site
  activatedarkmode();
  darkModeToggle.innerHTML = "desactiver le darkmode"
}

else {
    deactivatedarkmode();
    darkModeToggle.innerHTML = "activer le darkmode"
}

darkModeToggle.addEventListener("click", () => { // Change le contenu du localstorage en fonction de si le darkmode est actif ou non

  darkmode = localStorage.getItem("darkmode");

  if (darkmode !== "true") {
    localStorage.setItem("darkmode","true");
    darkModeToggle.innerHTML = "desactiver le darkmode"
    activatedarkmode();
  }
  
  else {
    localStorage.setItem("darkmode","false");
    deactivatedarkmode();
    darkModeToggle.innerHTML = "activer le darkmode"
  } 

});

// Fonction pour activer le darkmode
function activatedarkmode() {
  darkModeToggle.classList.add('dark-mode');
  body.classList.add('dark-mode');
  header.classList.add('dark-mode');
  menu.classList.add('dark-mode');
  logo.classList.add('dark-mode');
  signUp.classList.add('dark-mode');
  footer.classList.add('dark-mode');

  menulinks.forEach(a => { // on boucle sur chaque lien pour toute leur donner la classe darkmode
    a.classList.add('dark-mode');
  });  

  if (searchBar) searchBar.classList.add('dark-mode');
  if (statFilter) statFilter.classList.add('dark-mode');
  if (typeFilter) typeFilter.classList.add('dark-mode');
  if (exchangeButton) exchangeButton.classList.add('dark-mode');

  Array.from(pokemoncards).forEach(card => {
    card.classList.add('dark-mode');
  });

  if(form) form.classList.add('dark-mode')
  if(pseudo) pseudo.classList.add('dark-mode');
  if(email) email.classList.add('dark-mode');
  if(password) password.classList.add('dark-mode');
  if(confirmPassword) confirmPassword.classList.add('dark-mode');

  Radios.forEach(radio => {
    radio.classList.add('dark-mode');
  });

  if(submit) submit.classList.add('dark-mode');


  if(pokemonBackground) pokemonBackground.classList.add('dark-mode');
  if(Accroche) Accroche.classList.add('dark-mode');
  if(boosters) boosters.classList.add('dark-mode');
  if(letter) letter.classList.add('dark-mode');
  if(start) start.classList.add('dark-mode');

  Titles.forEach(Title => {
    Title.classList.add('dark-mode');
  });

  commentaires.forEach(commentaire => {
    commentaire.classList.add('dark-mode');
  });

  prix.forEach(prix => {
    prix.classList.add('dark-mode');
  });

  if(exchangeButton) exchangeButton.classList.add('dark-mode');
  if(exchangeFrom) exchangeFrom.classList.add('dark-mode');

  if(ficheIndividuelle) ficheIndividuelle.classList.add('dark-mode');
}

// Fonction pour desactiver le darkmode
function deactivatedarkmode() {

  // les elements communs du darkmode
  darkModeToggle.classList.remove('dark-mode');
  body.classList.remove('dark-mode');
  header.classList.remove('dark-mode');
  menu.classList.remove('dark-mode');
  logo.classList.remove('dark-mode');
  signUp.classList.remove('dark-mode');
  footer.classList.remove('dark-mode');

  menulinks.forEach(a => { // on boucle sur chaque lien pour toute leur donner la classe darkmode
    a.classList.remove('dark-mode');
  });  

  // les elements de Card List
  if (searchBar) searchBar.classList.remove('dark-mode'); // On met if car sinon il bloque sur les autres page car ne les trouve pas
  if (statFilter) statFilter.classList.remove('dark-mode');
  if (typeFilter) typeFilter.classList.remove('dark-mode');
  if (exchangeButton) exchangeButton.classList.remove('dark-mode');

  Array.from(pokemoncards).forEach(card => { // on boucle sur chaque carte pour toute leur donner la classe darkmode
    card.classList.remove('dark-mode');
  });  

  // les elements des formulaires d'inscription et connexion
  if(form) form.classList.remove('dark-mode');
  if(pseudo) pseudo.classList.remove('dark-mode');
  if(email) email.classList.remove('dark-mode');
  if(password) password.classList.remove('dark-mode');
  if(confirmPassword) confirmPassword.classList.remove('dark-mode');

  Radios.forEach(radio => {
    radio.classList.remove('dark-mode');
  });

  if(submit) submit.classList.remove('dark-mode');

  if(pokemonBackground) pokemonBackground.classList.remove('dark-mode')
  if(Accroche) Accroche.classList.remove('dark-mode')
  if(boosters) boosters.classList.remove('dark-mode');
  if(letter) letter.classList.remove('dark-mode');
  if(start) start.classList.remove('dark-mode')

  Titles.forEach(Title => {
    Title.classList.remove('dark-mode');
  });

  commentaires.forEach(commentaire => {
    commentaire.classList.remove('dark-mode');
  });

  prix.forEach(prix => {
    prix.classList.remove('dark-mode');
  });

  if(exchangeButton) exchangeButton.classList.remove('dark-mode')
  if(exchangeFrom) exchangeFrom.classList.remove('dark-mode')

  if(ficheIndividuelle) ficheIndividuelle.classList.remove('dark-mode');
}

});

// ce qu'il reste a faire :
// probleme avec le darkmode, ne se reactive pas pour les cartes quand rechargement meme si darkmode est stored.
// filter brightness assombris toute la div, objectif initial assombrir la background image.