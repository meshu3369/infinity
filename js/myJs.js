/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$("document").ready(function () {
    $("#dropdown1").mouseover(function () {
        $("#mydropdownMenu1").slideDown();
        $("#mydropdownMenu1").show(500);

    });
    $("#dropdown1").mouseleave(function () {
        $("#mydropdownMenu1").slideUp(500);

    });
    $("#dropdown2").mouseover(function () {
        $("#mydropdownMenu2").slideDown();
        $("#mydropdownMenu2").show(500);

    });
    $("#dropdown2").mouseleave(function () {
        $("#mydropdownMenu2").slideUp(500);

    });

    $("#t1").tabs();

    //$("#productTab").tabs();



    $('.flexslider').flexslider({
        animation: "slide"
    });

    new WOW().init();



    $(".fancybox").fancybox();
    //code for owl carousel....
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        nav: true,
        margin: 10,
        autoplay: true,
        mouseDrag: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            960: {
                items: 4
            },
            1200: {
                items: 4
            }
        }
    });
    owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY > 0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });
    /* end of owl carousel plugin initialization data */









//    my editing 

    $(".owl-prev").text("");
    $(".owl-prev").append("<i class='fa fa-chevron-left'></i>");

    $(".owl-next").text("");
    $(".owl-next").append("<i class='fa fa-chevron-right'></i>");

//     for magnifying icon

    $(".linktofancy").css("opacity", "0");


    $(".linktofancy").mouseover(function () {
        $(this).stop().animate({
            opacity: .8
        }, "slow");
        
      
    });

    $(".linktofancy").mouseleave(function () {
        $(this).stop().animate({
            opacity: 0
        }, "slow");
    });


    function mytabs(tabs_name, a, b, c) {

        /* my product tabs jqeury ..... author: meshu */
        $(a).show();
        $(b).hide();
        $(c).hide();

        $(tabs_name + " ul li:nth-child(1)").click(function () {
            $(a).show();
            $(a).addClass("animation");
            $(c).removeClass("animation");
            $(b).removeClass("animation");
            $(b).hide();
            $(c).hide();
        });
        $(tabs_name + " ul li:nth-child(2)").click(function () {
            $(b).show();
            $(b).addClass("animation");
            $(a).removeClass("animation");
            $(c).removeClass("animation");
            $(a).hide();
            $(c).hide();
        });
        $(tabs_name + " ul li:nth-child(3)").click(function () {
            $(c).show();
            $(c).addClass("animation");
            $(b).removeClass("animation");
            $(a).removeClass("animation");
            $(a).hide();
            $(b).hide();
        });

    }
    function mytabs2(tabs_name, a, b, c, d) {

        /* my product tabs jqeury ..... author: meshu */
        $(a).show();
        $(a).addClass("active-menu");
        $(b).hide();
        $(c).hide();
        $(d).hide();

        $(tabs_name + " ul li:nth-child(1)").click(function () {
            $(a).show();
            $(a).addClass("animation active-menu");
            $(c).removeClass("animation active-menu");
            $(b).removeClass("animation active-menu");
            $(d).removeClass("animation active-menu");
            $(b).hide();
            $(c).hide();
            $(d).hide();
        });
        $(tabs_name + " ul li:nth-child(2)").click(function () {
            $(b).show();
            $(b).addClass("animation active-menu");
            $(a).removeClass("animation active-menu");
            $(c).removeClass("animation active-menu");
            $(d).removeClass("animation active-menu");
            $(a).hide();
            $(c).hide();
            $(d).hide();
        });
        $(tabs_name + " ul li:nth-child(3)").click(function () {
            $(c).show();
            $(c).addClass("animation active-menu");
            $(b).removeClass("animation active-menu");
            $(a).removeClass("animation active-menu");
            $(d).removeClass("animation active-menu");
            $(a).hide();
            $(b).hide();
            $(d).hide();
        });
        $(tabs_name + " ul li:nth-child(4)").click(function () {
            $(d).show();
            $(d).addClass("animation active-menu");
            $(b).removeClass("animation active-menu");
            $(a).removeClass("animation active-menu");
            $(d).removeClass("animation active-menu");
            $(a).hide();
            $(b).hide();
            $(d).hide();
        });

    }
    mytabs("#productTab", "#product1", "#product2", "#product3");
    mytabs("#offerTab", "#offer1", "#offer2", "#offer3");
    mytabs2("#dash", "#dash1", "#dash2", "#dash3", "#dashboard");



    var el, newPoint, newPlace, offset;

    // Select all range inputs, watch for change
    $("input[type='range']").change(function () {

        // Cache this for efficiency
        el = $(this);

        // Measure width of range input
        width = el.width();

        // Figure out placement percentage between left and right of input
        newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));

        // Janky value to get pointer to line up better
        offset = -1.3;

        // Prevent bubble from going beyond left or right (unsupported browsers)
        if (newPoint < 0) {
            newPlace = 0;
        } else if (newPoint > 1) {
            newPlace = width;
        } else {
            newPlace = width * newPoint + offset;
            offset -= newPoint;
        }

        // Move bubble
        el
                .next("output")
                .css({
                    left: newPlace,
                    marginLeft: offset + "%"
                })
                .text(el.val());
    })
            // Fake a change to position bubble at page load
            .trigger('change');

});