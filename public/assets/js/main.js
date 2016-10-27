'use strict';

$(function() {


  // Dropdown fix
  $('.dropdown > a[tabindex]').keydown(function(event) {
    // 13: Return

    if (event.keyCode == 13) {
      $(this).dropdown('toggle');
    }
  });


  $('.dropdown-submenu > a').submenupicker();

   $(".dropdown").hover(            
    function() {
        $('.dropdown-menu:first-child', this).stop( true, true ).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");                
    },
    function() {
        $('.dropdown-menu:first-child', this).stop( true, true ).fadeOut("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");                
    });

   $(".dropdown-submenu").hover(            
    function() {
        $('.dropdown-menu:first-child', this).stop( true, true ).fadeIn("fast");
        $(this).toggleClass('open');
    },
    function() {
        $('.dropdown-menu:first-child', this).stop( true, true ).fadeOut("fast");
        $(this).toggleClass('open');
    });

});