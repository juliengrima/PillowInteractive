/******** PARALLAX & SLIDER ********/

document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    const parallaxContainer = document.querySelector('.parallax-container');
    const parallaxContent = document.querySelector('.parallax-content');

    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        const parallaxSpeed = 0.5; // Ajustez la vitesse du parallax ici
        parallaxContent.style.transform = `translateY(${scrollPosition * parallaxSpeed}px)`;
    });
});

$(document).ready(function() {
    $('#parallax').mousemove(function(e) {
        // Récupérer la largeur et la hauteur du conteneur parallax
        var w = $(this).width();
        var h = $(this).height();

        // Calculer le décalage parallax en fonction de la position de la souris
        var offsetX = 0.5 - e.pageX / w; // Valeur entre -0.5 et 0.5
        var offsetY = 0.5 - e.pageY / h; // Valeur entre -0.5 et 0.5

        // Appliquer le décalage parallax au contenu parallax
        $('.parallax-mouse-content').css({
            'transform': 'translate(' + offsetX * 50 + 'px, ' + offsetY * 50 + 'px)'
        });
    });
});

/******** POPOVERS ********/

$(document).ready(function(){
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  });