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

/******** PRIVACY POLICY ********/

  window.addEventListener('load', function() {
    window.cookieconsent.initialise({
        palette: {
            popup: { background: "#000" },
            button: { background: "#f1d600" }
        },
        theme: "classic",
        content: {
            message: "This website uses cookies to ensure you get the best experience on our website.",
            dismiss: "Accept",
            link: "Learn more",
            href: "/privacy-policy"
        },
        type: 'opt-in', // Change to 'opt-in' for GDPR compliance
        elements: {
            messagelink: '<span id="cookieconsent:desc" class="cc-message">{{message}} <a aria-label="learn more about cookies" tabindex="0" class="cc-link" href="{{href}}" target="_blank">{{link}}</a></span>',
            allow: '<button aria-label="allow cookies" tabindex="0" class="cc-btn cc-allow">{{dismiss}}</button>',
            deny: '<button aria-label="deny cookies" tabindex="0" class="cc-btn cc-deny">Decline</button>',
        },
        onInitialise: function (status) {
            if (status == cookieconsent.status.allow) myScripts();
        },
        onStatusChange: function(status, chosenBefore) {
            if (status == cookieconsent.status.allow) myScripts();
        },
    });
});

function myScripts() {
    // Your scripts that require cookies go here
}