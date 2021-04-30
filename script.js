$(document).ready(function() {

    var scrollLink = $('.scroll');

    // Smooth scrolling
    scrollLink.click(function(e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: $(this.hash).offset().top - 120
        }, 1000);
    });

    // Active link switching
    $(window).scroll(function() {
            var scrollbarLocation = $(this).scrollTop();

            scrollLink.each(function() {

                var sectionOffset = $(this.hash).offset().top - 120;

                if (sectionOffset <= scrollbarLocation) {
                    $(this).parent().addClass('active');
                    $(this).parent().siblings().removeClass('active');
                }
            })

        })
        //smaller header on scroll
    $(window).scroll(function() {
            if ($(window).scrollTop()) {
                $('header').addClass('smallHeader');
            } else {
                $('header').removeClass('smallHeader');
            }
        })
        //text slider for about page

    const SlidePage = document.querySelector(".slidePage");
    const forwardBtn = document.querySelector(".moveForward");
    const backBtn = document.querySelector(".goBack");
    const bullet = document.querySelector(".circle");
    backBtn.disabled = true;
    var margin = 0;
    forwardBtn.addEventListener('click', function() {

        switch (margin) {
            case 0:
                SlidePage.style.marginLeft = "-25%";
                margin -= 25;
                $(".circle.two").parent().addClass('current');
                $(".circle.two").parent().siblings().removeClass('current');
                break;

            case -25:
                SlidePage.style.marginLeft = "-50%";
                margin -= 25;
                $(".circle.three").parent().addClass('current');
                $(".circle.three").parent().siblings().removeClass('current');
                break;


        }
    });

    backBtn.addEventListener('click', function() {
        switch (margin) {
            case -50:
                SlidePage.style.marginLeft = "-25%";
                margin += 25;
                $(".circle.two").parent().addClass('current');
                $(".circle.two").parent().siblings().removeClass('current');

                break;

            case -25:
                SlidePage.style.marginLeft = "0%";
                margin += 25;
                $(".circle.one").parent().addClass('current');
                $(".circle.one").parent().siblings().removeClass('current');
                break;
        }

    });

    // slider for services page
    const scrollPage = document.querySelector(".scrollPage");
    const desBtn = document.querySelector(".design");
    const supBtn = document.querySelector(".supply");
    const impBtn = document.querySelector(".implement");
    const followBtn = document.querySelector(".follow");

    desBtn.addEventListener('click', function() {
        scrollPage.style.marginTop = "0%";
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });
    supBtn.addEventListener('click', function() {
        scrollPage.style.marginTop = "-60%";
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });
    impBtn.addEventListener('click', function() {
        scrollPage.style.marginTop = "-116%";
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });
    followBtn.addEventListener('click', function() {
        scrollPage.style.marginTop = "-180%";
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });


});