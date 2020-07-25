$('.owl-carousel').owlCarousel({
    loop:false,
    margin: 10,
    nav: true,
    dots: true,
    navText: ["<i class=\"fas fleche fa-chevron-left\"></i>","<i class=\"fas fleche fa-chevron-right\"></i>"],

    responsive:{
        0:{
            items:1,

            mouseDrag: true,
            freeDrag: true
        },
        600:{
            items:2,


            mouseDrag: true,
            freeDrag: false
        },
        1000:{
            items:3,


            mouseDrag: true,
            freeDrag: false
        },



    },


})

