// Exécution du script une fois que la page est entièrement chargée
document.addEventListener("DOMContentLoaded", () => {
    // Sélection des éléments du formulaire et des champs d'entrée
    let username = document.getElementById("username"); // Champ pour le username
    let email = document.getElementById("email"); // Champ pour l'email


    // local storage pour qu'on retape pas tout si on recharge.
    username.value = localStorage.getItem("username")

    username.addEventListener("input", function () {
        localStorage.setItem("username", username.value);
    });


    email.value = localStorage.getItem("email")

    email.addEventListener("input", function () {
        localStorage.setItem("email", email.value);
    });

});