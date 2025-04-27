let allPokemonData = []; // On stock les pokemon de l'api

async function getAllPokemon(limit = 10) { // la fonction pour recuperer les pokemons
  try {
    let response = await fetch(`https://pokeapi.co/api/v2/pokemon?limit=${limit}`); //on recupere les pokemons et leur url d'infos depuis l'api avec pour limite le parametre de la fonction
    let data = await response.json(); // on le transforme en Json 
    
    let pokemonList = data.results; // on prends ce que nous donne data et le transform en liste de pokemon

    let promises = pokemonList.map(async (pokemon) => {
        let data = await fetch(pokemon.url).then (res => res.json());
        data.apiUrl = pokemon.url;
        return data;
    });
    
    allPokemonData = await Promise.all(promises); // on fait toute les requetes en parralelle avec promise all
    return allPokemonData;

  } catch (error) { // on envoir dans la console erreur si il y en a une
    console.error("Erreur :", error);
  }
}

let favorites = []; // liste qui acceuilera les favorit de la BDD


async function loadfavorites() { // fonction pour charger les favori
    try {
        let response = await fetch('../fichier de traitement php/get_favorites.php'); // on active le fichier php et recupere la liste des favoris
        let data = await response.json(); // on met cette liste en json
        favorites = data; // on la met dans le tableaux favorites
        console.log(favorites); // on console log ce tableau pour verifier son arrivée
    } catch (error) {
        console.error("Erreur :", error); // si erreur on renvoie l'erreur
    }
}





// fonction pour afficher les pokemons filtrés
function displayPokemon(pokemonArray) {
    
    
    let container = document.getElementById("pokemon-container"); // on selectionne le recepatcle a carte
    container.innerHTML = ""; // on vide la liste pour reafficher seulement les pokemons concernés

    pokemonArray.forEach(data => { // On creer une carte pour cahque pokemon de pokemon array
        let card = document.createElement("div"); // on creer une div pour un pokemon
        card.classList.add("pokemon-card"); // on lui ajoute la classe carte

        let types = data.types.map(typeInfo => typeInfo.type.name).join(", "); // on transforme en forme lisible son ou ses types
        let stats = data.stats.map(stat => `<li>${stat.stat.name}: ${stat.base_stat}</li>`).join(""); // de meme avec ses stats
        // on injecte dans cette div les infos nous interessant, ici le nom, l'image, les types et stats
        card.innerHTML = `
            <h3>${data.name}</h3>
            <img src="${data.sprites.front_default}" alt="${data.name}">
            <p><strong>Type(s) :</strong> ${types}</p>
            <ul>${stats}</ul>
        `;

        let icons = document.createElement("div");
        icons.classList.add("icons");


        let heart = document.createElement("span"); // Créer l'élément coeur
        heart.classList.add("heart"); // Ajouter la classe pour les styles
        
        // si l'id de la card est inclue dans la liste d'id reçus correspondant au favoris dans la BDD
        if (favorites.includes(data.id)) {
            heart.innerText = "❤️"; // alors au chargement on met deja le coeur rouge
            card.classList.add('favorite'); // et on ajoute la classe favorite
        } else {
            heart.innerText = "🤍"; // sinon on laisse le coeur blanc
        }
        
        heart.addEventListener("click", function () { // on regarde quand on clic sur un coeur
            var card_id = data.id; // creation de la variable card_id
        
            if (favorites.includes(data.id)) { // quand le coeur est deja dans les favoris de la BDD
                if (confirm("Veux-tu vraiment retirer ce Pokémon de tes favoris ?")) {  // On demande confirmation pour la retirer
                    card.classList.remove('favorite'); // on retire la classe favorite
                    heart.innerText = "🤍"; // on vide le petit coeur
                    favorites = favorites.filter(id => id !== card_id); // on adapte la liste en local
                }
            } else {
                card.classList.add('favorite'); // si elle ne l'est pas c'est qu'on veut la mettre don on lui met la classe favorit
                heart.innerText = "❤️"; // on remplis le coeur
                favorites.push(card_id); //on la met dans la liste locale
            }
        
            fetch("../fichier de traitement php/favoriteset.php", { // ici on envoie les infos au php
                method: "POST", // methode POST
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded" // type de contenu envoyé
                },
                body: "card_id=" + card_id // on envoie une variable card_id avec pour valeur card_id
            })
            .then(response => response.json()) // on analyse la reponse du serveur
            .then(data => {
                console.log("Réponse du serveur :", data);// debug aussi
                if (data.success) {
                    console.log("Favori mis à jour pour la carte ID:", data.card_id); // test pour le debug
                }
            })
            .catch(error => {
                console.error('Erreur lors de la requête:', error); // on recuper l'erreur si ça ne marche pas
            });
        });
        
        icons.appendChild(heart); // Ajouter le coeur à l'élément card
        

        let info = document.createElement("span"); // on creer une div span pour l'icone d'info
        info.classList.add("info"); // on lui ajoute la classe info pour le css
        info.innerHTML = `ℹ️`; // l'icone

        info.addEventListener("click", function () { // l'affichage au clique 
            localStorage.setItem("PokemonApiUrl", data.apiUrl) // on stock en local storage la fiche pour l'envoyer a la page de detail
            window.open("../FIche individuelle/index.html") // on ouvre la page de detail
        });

        icons.appendChild(info); // on met l'icone en enfant de la carte

        card.appendChild(icons);

        container.appendChild(card); // on dit que cette carte est enfant de container pour qu'elle soit au bon endroit
    });
}

// fonction pour filtrer les pokemons
function filterPokemon() {
    let searchText = document.getElementById("searchBar").value.toLowerCase(); // on verifie l'etat de la barre de recherche
    let selectedType = document.getElementById("typeFilter").value; // de meme avec le filtre de types
    let selectedStat = document.getElementById("statFilter").value; // le filtre de stat aussi

    let filteredPokemon = allPokemonData.filter(pokemon => { // on verifie que le pokemon valide les filtres
        let matchesName = pokemon.name.includes(searchText); // ici que les lettre de la barre de recherche soit dans son nom
        let matchesType = selectedType ? pokemon.types.some(t => t.type.name === selectedType) : true; // ici qu'il a le type du filtre types
        return matchesName && matchesType; // on renvoie les pokemons qui passe ces deux filtres
    });

    // On trie par la stat choisie
    if (selectedStat) {
        filteredPokemon.sort((a, b) => { // on fait la difference de chaque stats pour etablie si un pokemon en a plus ou moins qu'un autre
            let statA = a.stats.find(stat => stat.stat.name === selectedStat).base_stat;
            let statB = b.stats.find(stat => stat.stat.name === selectedStat).base_stat;
            return statB - statA; // On trie de façon decroissante
        });
    }

    displayPokemon(filteredPokemon); // On affiche les pokemon qui ont passés les filtres
}

// on detecte les changement d'etats des filtres
document.getElementById("searchBar").addEventListener("input", filterPokemon); // on indique de reactualiser la liste de pokemon si la barre de recherche change
document.getElementById("typeFilter").addEventListener("change", filterPokemon); // de meme avec le filtre de type
document.getElementById("statFilter").addEventListener("change", filterPokemon); // encore de meme avec celui des stats

// On lance l'affichage des pokemons

async function initialization() {
    await getAllPokemon();
    await loadfavorites();
    displayPokemon(allPokemonData);
}

initialization();
