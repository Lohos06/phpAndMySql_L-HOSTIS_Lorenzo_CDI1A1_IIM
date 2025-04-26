let allPokemonData = []; // On stock les pokemon de l'api

async function getAllPokemon(limit = 1025) { // la fonction pour recuperer les pokemons
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
    displayPokemon(allPokemonData); // on affiche tout les pokemon de depart

  } catch (error) { // on envoir dans la console erreur si il y en a une
    console.error("Erreur :", error);
  }
}

// fonction pour afficher les pokemons filtrés
function displayPokemon(pokemonArray) {
    
    
    let container = document.getElementById("pokemon-container"); // on selectionne le recepatcle a carte
    container.innerHTML = ""; // on vide la liste pour reafficher seulement les pokemons concernés

    pokemonArray.forEach(data => { // On creer une carte pour cahque pokemon de pokemon array
        let card = document.createElement("div"); // on creer une div pour un pokemon
        card.classList.add("pokemon-card"); // on lui ajoute la classe carte
        console.log(data);

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


        let heart = document.createElement("span"); // on creer une div span pour l'icone du coeur
        heart.classList.add("heart"); // on lui ajoute la classe coeur pour le css
        heart.innerHTML = `🤍`; // on remplis le span d'un coeur vide

        heart.addEventListener("click", function () { // ecouteur d'eveneemnt : au click sur le coeur
            card.classList.toggle("favorite"); // on toggle la classe favorit a la carte
        if (heart.innerText === "🤍") { // si le coeur est vide on le remplit
            heart.innerText = "❤️"
        } else {
            heart.innerText = "🤍" // sinon on le vide
        }
        });

        icons.appendChild(heart); // on met l'icone en enfant de la carte

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
getAllPokemon();