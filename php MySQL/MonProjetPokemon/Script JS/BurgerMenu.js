let BurgerMenuToggle = document.getElementById("BurgerMenuToggle"); // Selectionne le bouton du menu

// Donne une vlasse faisant apparaitre et disparaitre le menu apres avoir cliqué sur le bouton
BurgerMenuToggle.addEventListener("click", () => { 
    menu.classList.toggle("active");
    BurgerMenuToggle.classList.toggle("active");
});