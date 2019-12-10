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

    $("div.curt-products").on('click', '.curt-minus', function (e) {
        let count = parseInt($(e.target).parent().children('.curn-number-products').text());
        if(count > 1)
            $(e.target).parent().children('.curn-number-products').text(--count);

        let price = parseFloat($(e.target).parent().prev(".curt-price").children(".price-value").text());
        $(e.target).parent().next(".curt-summary-price").children(".total-value").text((price*count).toFixed(2));

        let totals = $(".total-value");
        let sum = 0;
        for(let i = 0; i < totals.length; i++) {
            sum += parseFloat($(totals[i]).text());
        }
        $("#full-cart-value").text(sum.toFixed(2));

    });

    $("div.curt-products").on('click', '.curt-plus', function (e) {
        let count = parseInt($(e.target).parent().children('.curn-number-products').text());
        let maxcount = parseInt($(e.target).attr('maxcount'));
        if(count < maxcount)
            $(e.target).parent().children('.curn-number-products').text(++count);

        let price = parseFloat($(e.target).parent().prev(".curt-price").children(".price-value").text());
        $(e.target).parent().next(".curt-summary-price").children(".total-value").text((price*count).toFixed(2));

        let totals = $(".total-value");
        let sum = 0;
        for(let i = 0; i < totals.length; i++) {
            sum += parseFloat($(totals[i]).text());
        }
        $("#full-cart-value").text(sum.toFixed(2));
    });


    $("#oneClickOrder").submit(function () {
        let orderInfo = [];
        $(".curt-product").each(function (index) {
            orderInfo.push({
                product_id: $(this).attr('data-id'),
                name: $(this).find(".curt-info-title a").eq(0).text().trim(),
                price: parseFloat($(this).find(".price-value").eq(0).text()),
                count: parseInt($(this).find(".curn-number-products").eq(0).text()),
                summa: parseFloat($(this).find(".total-value").eq(0).text()),
            });
        });
        let total = parseFloat($("#full-cart-value").text());
        $("#oneclickorder-total").val(total);
        $("#oneclickorder-products_json").val(JSON.stringify(orderInfo));
        return true;
    });

    $("#mainFormOrder").submit(function () {
        let orderInfo = [];
        $(".curt-product").each(function (index) {
            orderInfo.push({
                product_id: $(this).attr('data-id'),
                name: $(this).find(".curt-info-title a").eq(0).text().trim(),
                price: parseFloat($(this).find(".price-value").eq(0).text()),
                count: parseInt($(this).find(".curn-number-products").eq(0).text()),
                summa: parseFloat($(this).find(".total-value").eq(0).text()),
            });
        });
        let total = parseFloat($("#full-cart-value").text());
        $("#order-total").val(total);
        $("#order-products_json").val(JSON.stringify(orderInfo));


        return true;
    });

    $("#select-method-delivery").change(function () {
        if($(this).val() == 2) {
            $(".nova-poshta-block").css('display', 'block');
            $(".self-shop-visit").css('display', 'none');
        }
        else if($(this).val() == 1) {
            $(".nova-poshta-block").css('display', 'none');
            $(".self-shop-visit").css('display', 'block');
            $('#order-address').val('Самовивіз з магазину');
            $('#order-methoddelivery').val('Самовивіз з магазину');
            $('#order-methodpayment').val('Оплата при отриманні товару в магазині');
        }
        else {
            $(".nova-poshta-block").css('display', 'none');
            $(".self-shop-visit").css('display', 'none');
            $('#order-address').val('');
            $('#order-methoddelivery').val('');
            $('#order-methodpayment').val('');

        }
    });


});