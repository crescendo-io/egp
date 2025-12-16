$(window).on('load',function(){
    $('.burger-menu').click(function(){
       $('.main-menu').slideToggle(100);
       $(this).toggleClass('open');

       $('html, body').animate({ scrollTop: 0 }, 'slow');
       $('html, body').toggleClass('open');
    });

    // Header scroll behavior - cache le pré-header au scroll
    let lastScrollTop = 0;
    const header = $('.header');
    const scrollThreshold = 50;

    $(window).on('scroll', function() {
        const scrollTop = $(this).scrollTop();
        
        // Scroll vers le bas et au-delà du seuil → cacher le pré-header
        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            header.addClass('scrolled');
            $('body').addClass('header-scrolled');
        } 
        // Scroll vers le haut → afficher le pré-header
        else if (scrollTop < lastScrollTop) {
            header.removeClass('scrolled');
            $('body').removeClass('header-scrolled');
        }
        
        lastScrollTop = scrollTop;
    });


    $('#masonry-grid').masonry({
        // options
        itemSelector: '.post-galerie',
        columnWidth: 0
    });

    $('.arrow-sub').click(function(){
        var el = $(this);

        el.parent().find('.submenu').slideToggle(100);
        el.toggleClass('open');
    })

    $('.filter-buttons-toggle').click(function(){
       $('.filters-form').slideToggle();
    });

    setTimeout(function(){
        $('.loader').fadeOut();
    },500);

    $('.filter-group h4').click(function(){
        var el = $(this);

        el.parent().toggleClass('open');
    });


});

document.addEventListener('DOMContentLoaded', function() {
    const marqueeContainer = document.querySelector('.marquee-container');
    const container = document.querySelector('.sentences-pre-header');
    if (!container || !marqueeContainer) return;

    const items = container.querySelectorAll('li');
    if (items.length === 0) return;

    let currentIndex = 0;
    const fadeTime = 400;

    function getTextWidth(text) {
        const measureEl = document.createElement('span');
        measureEl.style.cssText = 'position:absolute;visibility:hidden;white-space:nowrap;font:inherit;';
        measureEl.textContent = text;
        marqueeContainer.appendChild(measureEl);
        const width = measureEl.scrollWidth;
        marqueeContainer.removeChild(measureEl);
        return width;
    }

    function showNextItem() {
        // Retirer la classe active de l'élément précédent
        items.forEach(item => item.classList.remove('active'));

        const currentItem = items[currentIndex];
        const marqueeText = currentItem.querySelector('.marquee-text');
        const containerWidth = marqueeContainer.offsetWidth;
        const text = marqueeText.textContent.trim();
        const textWidth = getTextWidth(text);

        // Calculer la durée basée sur la distance totale
        const baseSpeed = 150; // pixels par seconde
        const totalDistance = containerWidth + textWidth;
        const duration = Math.max(5, totalDistance / baseSpeed);

        // Définir les variables CSS
        currentItem.style.setProperty('--marquee-duration', duration + 's');
        currentItem.style.setProperty('--start-position', containerWidth + 'px');

        // Réinitialiser l'animation
        marqueeText.style.animation = 'none';
        marqueeText.offsetHeight; // Force reflow
        marqueeText.style.animation = '';

        currentItem.classList.add('active');

        // Passer au suivant après la fin de l'animation + petit délai pour le fade
        setTimeout(() => {
            currentIndex = (currentIndex + 1) % items.length;
            showNextItem();
        }, (duration * 1000) + fadeTime);
    }

    // Démarrer le défilement
    showNextItem();
});


jQuery(document).ready(function($) {
    const floatingPhone = $('.floating-phone');
    
    if (floatingPhone.length) {
        floatingPhone.on('click', function(e) {
            $(this).toggleClass('show-number');
        });

        // Fermer le numéro si on clique ailleurs sur la page
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.floating-phone').length) {
                floatingPhone.removeClass('show-number');
            }
        });
    }
}); 

