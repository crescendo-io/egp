$(window).on('load',function(){
    $('.burger-menu').click(function(){
       $('.main-menu').slideToggle(100);
       $(this).toggleClass('open');

       $('html, body').animate({ scrollTop: 0 }, 'slow');
       $('html, body').toggleClass('open');
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

