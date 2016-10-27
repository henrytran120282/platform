(function($){
	"use strict";
	function sr_mobile_device()
    {
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('.sr-mainmenu .sub-menu').addClass('onmobile');
        } else {
            $('.sr-mainmenu .sub-menu').removeClass('onmobile');
            $('.sr-mainmenu .sub-menu').each(function() { 
                $(this).removeAttr('style');
            });
        }
    }
    
    // MENU STICKY
    function sr_menu_sticky()
    {
       
    }
    
    // BACK TO TOP
    function sr_back_top_top()
    {
        if ( $('.sr-top').length )
        {
            var scrollTrigger = 800;
            $(window).on('scroll', function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.sr-top').addClass('show');
                } else {
                    $('.sr-top').removeClass('show');
                }
            });
            
            $('.sr-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
    }

    $(document).ready(function() {
        sr_mobile_device();
        sr_menu_sticky();
        sr_back_top_top();
        
        
        if ( $('.toggle-mainmenu').length )
        {
            $('.toggle-mainmenu').click( function(){
                $('#nav-wrapper').toggle();
            } );
        }
        
        $('#nav-wrapper .caret').click( function() {
            var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');
            $submenu.toggle();
            return false;
        });
        
        /** MOBILE MENU */
        if ( $('.mobile-menu .togole-mainmenu').length ) {
            $('.mobile-menu .togole-mainmenu').click( function(){
                $('.sr-mainmenu').slideToggle(250);
            } );
        }
        
        $('.sr-mainmenu .caret').click( function() {
            var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu').slideToggle(250);
            return false;
        });
        
        // Show admin bar
        if($('#wpadminbar').length){
            $('body').addClass('show-adminbar');
        }
        
    });
})(jQuery);	