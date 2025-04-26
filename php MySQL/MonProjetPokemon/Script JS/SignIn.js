// Exécution du script une fois que la page est entièrement chargée
document.addEventListener("DOMContentLoaded", () => {
    // Sélection des éléments du formulaire et des champs d'entrée
    let email = document.getElementById("email"); // Champ pour l'email

    email.value = localStorage.getItem("email")

    email.addEventListener("input", function () {
        localStorage.setItem("email", email.value);
    });

});