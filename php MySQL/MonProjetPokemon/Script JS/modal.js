let closeButton = document.getElementById('closeButton');
let modalExchange = document.getElementById('modalExchange');

exchangeButton.addEventListener('click', function() {
    modalExchange.classList.add('opened');
});

closeButton.addEventListener('click', function () {
    modalExchange.classList.remove('opened');
});