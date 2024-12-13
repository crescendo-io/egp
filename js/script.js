$(window).on('load',function(){
    $('.burger-menu').click(function(){
       $('.main-menu').slideToggle(100);
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        $('html, body').toggleClass('open');
    });


    $('.arrow-sub').click(function(){
        var el = $(this);

        el.parent().find('.submenu').slideToggle(100);
    })

    $('.filter-buttons-toggle').click(function(){
       $('.filters-form').slideToggle();
    });

    $('.filters-form').on('change', function(){
        $('.filters-form').submit();
    });

    setTimeout(function(){
        $('.loader').fadeOut();
    },500);

});