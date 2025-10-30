jQuery(function ($) {
    "use strict";
    var windowWidth = $(window).width();
    $('.award-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: false,
        speed: 750,
        autoplaySpeed: 9000,
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]

    });    
    
});