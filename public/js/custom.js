// ISOTOPE FILTER
jQuery(document).ready(function($){

    if ( $('.iso-box-wrapper').length > 0 ) {

        var $container  = $('.iso-box-wrapper'),
            $imgs       = $('.iso-box img');

        $container.imagesLoaded(function () {
            $container.isotope({
                layoutMode: 'fitRows',
                itemSelector: '.iso-box'
            });

            $imgs.load(function(){
                $container.isotope('reLayout');
            });
        });

        // filter items on button click
        $('.filter-wrapper li a').click(function(){
            var $this = $(this), filterValue = $this.attr('data-filter');

            $container.isotope({
                filter: filterValue,
                animationOptions: { duration: 750, easing: 'linear', queue: false }
            });

            if ( $this.hasClass('selected') ) { return false; }

            $this.closest('.filter-wrapper').find('.selected').removeClass('selected');
            $this.addClass('selected');
            return false;
        });
    }

    // MAIN NAVIGATION
    $('.main-navigation').onePageNav({
        scrollThreshold: 0.2,
        scrollOffset: 75,
        filter: ':not(.external)',
        changeHash: true
    });

    // NAVIGATION VISIBLE ON SCROLL
    mainNav();
    $(window).scroll(function () { mainNav(); });

    function mainNav() {
        var top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
        if (top > 40) {
            $('.sticky-navigation').stop().animate({ opacity: '1', top: '0' });
        } else {
            $('.sticky-navigation').stop().animate({ opacity: '0', top: '-75' });
        }
    }

    // NAVBAR TOGGLE (replaces Bootstrap collapse plugin)
    $('[data-toggle="collapse"]').click(function(){
        var $target = $($(this).data('target'));
        $target.toggleClass('in');
    });

    // HIDE MOBILE MENU AFTER CLICKING A LINK
    $('.navbar-collapse a').click(function(){
        $('.navbar-collapse').removeClass('in');
    });

    // PREVENT PLACEHOLDER PORTFOLIO LINKS FROM JUMPING TO TOP
    $('.portfolio-link[href="#"]').click(function(e){ e.preventDefault(); });
});
