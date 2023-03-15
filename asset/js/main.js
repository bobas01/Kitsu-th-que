//slide

let rightArrow = document.getElementById('rightArrow');
let leftArrow = document.getElementById('leftArrow');
let windowSlider = document.getElementById('window-slider').offsetWidth;

let listSlide = document.getElementById('list-slide')
let slide = document.getElementsByClassName('slide');
let nbSlide = slide.length;
let mLeft = 0;


rightArrow.addEventListener('click', function () {
   if (mLeft - 280 == 280 * -4) {

      this.click.stopPropagation()
   }
   else {
      mLeft -= 280;
      listSlide.style.marginLeft = mLeft + 'px';
   }
});



leftArrow.addEventListener('click', function () {
   if (mLeft + 280 == 280) {

      this.click.stopPropagation()
   }
   else {
      mLeft += 280;
      listSlide.style.marginLeft = mLeft + 'px';
   }

});

//swipe

let currentSlide = 0;


function nextSlide() {
   slide[currentSlide].style.display = "none";
   currentSlide = (currentSlide + 1) % nbSlide;
   slide[currentSlide].style.display = "block";
}

function prevSlide() {
   slide[currentSlide].style.display = "none";
   currentSlide = (currentSlide - 1 + nbSlide) % nbSlide;
   slide[currentSlide].style.display = "block";
}



listSlide.addEventListener("touchstart", handleTouchStart, false);
listSlide.addEventListener("touchmove", handleTouchMove, false);


let xDown = null;
let yDown = null;

function handleTouchStart(evt) {
   xDown = evt.touches[0].clientX;
   yDown = evt.touches[0].clientY;
}

function handleTouchMove(evt) {
   if (!xDown || !yDown) {
      return;
   }

   let xUp = evt.touches[0].clientX;
   let yUp = evt.touches[0].clientY;

   let xDiff = xDown - xUp;
   let yDiff = yDown - yUp;


   if (Math.abs(xDiff) > Math.abs(yDiff)) {
      if (xDiff > 0) {

         nextSlide();
      } else {

         prevSlide();
      }
   }

   xDown = null;
   yDown = null;
}

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const connexion = document.getElementById('connexion')

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

connexion.addEventListener('click', function(){
   container.classList.toggle('active');
})






