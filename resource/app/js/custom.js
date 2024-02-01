(function($){
	"use strict";

	/**
     * ----------------------------------------------
     * Nav BAr
     * ----------------------------------------------
     */
     
     $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 15) {
            $(".navbar").addClass("nav2");
        } else {
            $(".navbar").removeClass("nav2");
        }
    });
    /**
     * ----------------------------------------------
     * header-slider
     * ----------------------------------------------
     */

     $('.header-slider').owlCarousel({
            loop:true,
            margin:0,
            mouseDrag:false,
            autoplay:true,
            nav:false,
            dots:true,
            autoplay:true,
            // animateOut: 'fadeOut',
            responsiveClass:true,
            // navText:["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
             items:1  
        })

})(jQuery); 

$(document).ready(function() {
          $('.collapse.in').prev('.panel-heading').addClass('active');
          $('#accordion, #bs-collapse')
            .on('show.bs.collapse', function(a) {
              $(a.target).prev('.panel-heading').addClass('active');
            })
            .on('hide.bs.collapse', function(a) {
              $(a.target).prev('.panel-heading').removeClass('active');
            });
        });