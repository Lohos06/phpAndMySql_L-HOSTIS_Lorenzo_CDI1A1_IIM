document.addEventListener('DOMContentLoaded', function () {

apiUrl = localStorage.getItem("PokemonApiUrl")
console.log(apiUrl)

let part1 = document.getElementById('part1')
let part2 = document.getElementById('part2')
let part3 = document.getElementById('part3')
let part4 = document.getElementById('part4')


async function displayPokemonDetails() {
    let response = await fetch(apiUrl);
    data = await response.json();

    console.log(data)

    let pokemonDetails1 = `
    
    <h1>${data.name.charAt(0).toUpperCase() + data.name.slice(1)}</h1>
                <img src="${data.sprites.front_default}" alt="${data.name}" />
                <p><strong>Types:</strong> ${data.types.map(type => type.type.name).join(", ")}</p>
                <p><strong>Taille:</strong> ${data.height / 10} m</p>
                <p><strong>Poids:</strong> ${data.weight / 10} kg</p>
                <h3>Stats:</h3>
                <ul>
                    ${data.stats.map(stat => `<li><strong>${stat.stat.name.charAt(0).toUpperCase() + stat.stat.name.slice(1)}:</strong> ${stat.base_stat}</li>`).join("")}
                </ul>
    `

    let pokemonDetails2 = `
                <h3>Capacités:</h3>
                <ul>
                    ${data.abilities.map(ability => `<li>${ability.ability.name}</li>`).join("")}
                </ul>
    `

    let pokemonDetails3 = `
                <h3>Mouvements:</h3>
                <ul>
                    ${data.moves.slice(0, 10).map(move => `<li>${move.move.name}</li>`).join("")}
                </ul>
    `

    let pokemonDetails4 = `
                <h3>Sprites:</h3>
                <p><img src="${data.sprites.back_default}" alt="${data.name} back view" /></p>
                <p><img src="${data.sprites.front_shiny}" alt="${data.name} shiny front view" /></p>
                <p><img src="${data.sprites.back_shiny}" alt="${data.name} shiny back view" /></p>
                <h3>Formes:</h3>
                <ul>
                    ${data.forms.map(form => `<li>${form.name}</li>`).join("")}
                </ul>
    `

    part1.innerHTML = pokemonDetails1;
    part2.innerHTML = pokemonDetails2;
    part3.innerHTML = pokemonDetails3;
    part4.innerHTML = pokemonDetails4;
}

displayPokemonDetails();

});