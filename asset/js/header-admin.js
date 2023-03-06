//menu logo

const logo = document.getElementById('logo');
const mainMenu = document.getElementById('main-menu')

logo.addEventListener('click', function () {
    mainMenu.classList.toggle('active');
 
 })