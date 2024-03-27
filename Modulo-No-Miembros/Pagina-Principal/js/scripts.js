const carouselContainer = document.querySelector('.carousel-container');
const carouselSlides = document.querySelectorAll('.carousel-slide');

let currentIndex = 0;

function nextSlide() {
    // Oculta la diapositiva actual
    carouselSlides[currentIndex].style.display = 'none';

    // Calcula el índice de la siguiente diapositiva
    currentIndex = (currentIndex + 1) % carouselSlides.length;

    // Muestra la siguiente diapositiva
    carouselSlides[currentIndex].style.display = 'block';
}

// Muestra la primera diapositiva al principio
carouselSlides[currentIndex].style.display = 'block';

setInterval(nextSlide, 6000); // Cambia de imagen cada 3 segundos
