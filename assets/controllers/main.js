/* PARALLAX & SLIDER*/

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