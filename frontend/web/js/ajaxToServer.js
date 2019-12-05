$(document).ready(function(){
    $(".add-to-favourite").on('click', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        let parentDiv = $(this).parent();
        $.ajax({
            url: '/user/add-to-favourite',
            data: {productId: productId},
            type: 'GET',
            success: function (result) {
                $(".favourite-counter").text(result);
                parentDiv.addClass("selected");
            },
            error: function (result) {

            }
        });
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





});