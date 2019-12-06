$(document).ready(function(){
    $(".add-to-favourite").on('click', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        let parentDiv = $(this).parent();
        let thisButton = $(this);
        if($(this).hasClass('selected')) {
            $.ajax({
                url: '/user/del-from-favourite',
                data: {productId: productId},
                type: 'GET',
                success: function (result) {
                    $(".favourite-counter").text(result);
                    parentDiv.removeClass("selected");
                    thisButton.removeClass("selected");
                },
                error: function (result) {

                }
            });
        }
        else {
            $.ajax({
                url: '/user/add-to-favourite',
                data: {productId: productId},
                type: 'GET',
                success: function (result) {
                    $(".favourite-counter").text(result);
                    parentDiv.addClass("selected");
                    thisButton.addClass("selected");
                },
                error: function (result) {

                }
            });
        }
    });

    $(".del-from-favourite").on('click', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        let parentDiv = $(this).closest("div.main-outer-good");
        $.ajax({
            url: '/user/del-from-favourite',
            data: {productId: productId},
            type: 'GET',
            success: function (result) {
                $(".favourite-counter").text(result);
                parentDiv.remove();
            },
            error: function (result) {

            }
        });
    });

    $(".add-to-cart").on('click', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        $.ajax({
            url: '/user/add-to-cart',
            data: {productId: productId},
            type: 'GET',
            success: function (result) {
                $(".cart-counter").text(result);
            },
            error: function (result) {

            }
        });
    });

    $("div.main-catalog").on('click', '.del-from-cart', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        let wrapperDiv = $(this).closest("div.main-catalog");
        $.ajax({
            url: '/user/del-from-cart',
            data: {productId: productId},
            type: 'GET',
            success: function (result) {
                let data = JSON.parse(result);
                console.log(data);
                $(".cart-counter").text(data.count);
                wrapperDiv.empty();
                wrapperDiv.html(data.partial);
            },
            error: function (result) {

            }
        });
    });


});