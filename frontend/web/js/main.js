$(document).ready(function(){
    $(".menu-slider").css('display','block');

    $($(".find").children()[0]).on('input',function(){
        if($($(".find").children()[0]).val().length == 0)
            $(".find-close").css('display','none');
        else
            $(".find-close").css('display','block');
    });

    $(".find-close").click(function(){
        $($(".find").children()[0]).val("");
        $(".find-close").css('display','none');
    });

    $("#price-slider").slider({
        min: 0,
        max: 10,
        value: [3, 6]
    });

    $(".nav-list").children().hover(
        function(e){
            var current;
            if($(".nav-list").children().index(e.target)==-1)
                current = $(".nav-list").children().index($(e.target).parent());
            else
                current = $(".nav-list").children().index(e.target);
            $(".popup-nav").eq(current).css("display","block");
            $(".popup-nav").eq(current).css("height",parseInt($(".nav-list").css("height"))+10);
            if($(".bg-black").length == 0)
            {
                $('body').append('<div></div>');
                $('body').children().last().addClass('bg-black');
                $(".bg-black").css("display","block");
                $(".bg-black").css("z-index","49");
            }
        },function(){
            if($('.popup-nav:hover').length == 0){
                $(".popup-nav").css("display","none");
                $(".bg-black").remove();
            }
        });

    $(".popup-nav").hover(function(){},function(){
        $(".popup-nav").css("display","none");
        $(".bg-black").remove();
    });

    $(".hamburger").click(function(){
        if(parseInt($(".side-menu").css("left"))==-320){
            $(".side-menu").css("left","0")
            $('body').append('<div></div>');
            $('body').children().last().addClass('bg-black');
            $(".bg-black").css("display","block");
            $(".bg-black").css("z-index","51");
        }
    });

    $(".side-close").click(function(){
        $(".side-menu").css("left","-320px");
        $(".bg-black").remove();
    });

    $('.product-slider').carousel({
        interval: 3000
    });

    $('.curt-minus').click(function(e){
        let count = $(e.target).parent().children('.curn-number-products').text();
        if(count>1)
            $(e.target).parent().children('.curn-number-products').text(--count);
    });

    $('.curt-plus').click(function(e){
        let count = $(e.target).parent().children('.curn-number-products').text();
        $(e.target).parent().children('.curn-number-products').text(++count);
    });

    // $('.curt-close').click(function(e){
    //     $(e.target).parent().remove();
    // });
});