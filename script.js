$(document).ready(function() {


    const scrollPage = document.querySelector(".scrollPage");
    const desBtn = document.querySelector(".design");
    const supBtn = document.querySelector(".supply");
    const impBtn = document.querySelector(".implement");
    const followBtn = document.querySelector(".follow");
    var scrollLink = $('.scroll');



    $('#autoWidth').lightSlider({
        autoWidth: true,
        loop: true,
        item: 3,
        autoWidth: false,
        slideMove: 1, // slidemove will be 1 if loop is true
        slideMargin: 10,

        addClass: '',
        mode: "slide",
        useCSS: true,
        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
        easing: 'linear', //'for jquery animation',////

        speed: 400, //ms'
        auto: false,
        slideEndAnimation: true,
        pause: 2000,

        keyPress: false,
        controls: true,
        prevHtml: '',
        nextHtml: '',

        rtl: false,
        adaptiveHeight: false,

        vertical: false,
        verticalHeight: 500,
        vThumbWidth: 100,

        thumbItem: 10,
        pager: true,
        gallery: false,
        galleryMargin: 5,
        thumbMargin: 5,
        currentPagerPosition: 'middle',

        enableTouch: true,
        enableDrag: true,
        freeMove: true,
        swipeThreshold: 40,

        responsive: [],

        onBeforeStart: function(el) {},
        onSliderLoad: function(el) {},
        onBeforeSlide: function(el) {},
        onAfterSlide: function(el) {},
        onBeforeNextSlide: function(el) {},
        onBeforePrevSlide: function(el) {},
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        }
    });

    // Smooth scrolling
    scrollLink.click(function(e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: $(this.hash).offset().top - 120
        }, 1000);
    })

    // Active link switching
    $(window).scroll(function() {
            var scrollbarLocation = $(this).scrollTop();

            scrollLink.each(function() {

                var sectionOffset = $(this.hash).offset().top - 120;

                if (sectionOffset <= scrollbarLocation) {
                    $(this).parent().addClass('active');
                    $(this).parent().siblings().removeClass('active');
                }
            });

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



    barba.init({
        sync: true,

        transitions: [{

            async leave(data) {
                const done = this.async();
                // create your stunning leave animation here
                setTimeout(function() {
                    transitAnimation();
                }, 2000);
                await delay(4000); // 3000 = 3 sec
                done();
            },
            async enter(data) {
                // create your amazing enter animation here
            }
        }]
    });

});

function delay(n) {

    n = n || 4000;
    return new Promise((done) => {
        setTimeout(() => {
            done();
        }, n);
    });
}

function transitAnimation() {
    gsap.to(".loader.main", {
        duration: 1,
        scaleX: 1,
        transformOrigin: "left",
        ease: "power1.inOut"
    });
    gsap.to(".loader.main", {
        duration: 1,
        scaleX: 0,
        transformOrigin: "right",
        ease: "power1.inOut",
        delay: 2
    });

    gsap.to(".loader.sub", {
        duration: 1.4,
        scaleX: 1,
        transformOrigin: "left",
        ease: "power1.inOut"
    });
    gsap.to(".loader.sub", {
        duration: 1.4,
        scaleX: 0,
        transformOrigin: "right",
        ease: "power1.inOut",
        delay: 1.6
    });
}