/*---Go To Top : Aller en haut---*/

mybutton = document.getElementById("myBtn");

// Lorsque l'utilisateur fait défiler vers le bas 20 pixels à partir du haut du document, affichez le bouton
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// Lorsque l'utilisateur clique sur le bouton, faites défiler vers le haut du document
function topFunction() {
  document.body.scrollTop = 0; // Pour Safari
  document.documentElement.scrollTop = 0; // Pour Chrome, Firefox, IE et Opera
}