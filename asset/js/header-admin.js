//menu logo

const logo = document.getElementById('logo');
const mainMenu = document.getElementById('main-menu');

logo.addEventListener('click', function () {
    mainMenu.classList.toggle('active');
 
});

const addCat = document.getElementById('add-category');
const list = document.getElementById('list-category');
addCat.addEventListener('click', function () {
    list.style.display = "block";
    document.querySelector('body').style.overflow = 'hidden';
 
});

const cancels = document.querySelectorAll('.annuler');
cancels.forEach(function(cancel) {
  cancel.addEventListener('click', function() {
    list.style.display = "none";
    img.style.display = "none";
  });
});

const addImg = document.getElementById('add-img');
const img = document.getElementById('upload-img');
addImg.addEventListener('click', function () {
    img.style.display = "block";
    document.querySelector('body').style.overflow = 'hidden';
 
});

