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

    $("div.curt-products").on('click', '.del-from-cart', function (event) {
        event.preventDefault();
        let productId = $(this).attr('data-id');
        let wrapperDiv = $(this).closest("div.curt-products");
        let cartInfo = [];
        $(".curt-product").each(function (index) {
            cartInfo.push({
                product_id: $(this).attr('data-id'),
                count: parseInt($(this).find(".curn-number-products").eq(0).text())
            });
        });

        $.ajax({
            url: '/user/del-from-cart',
            data: {productId: productId, json: JSON.stringify(cartInfo)},
            type: 'GET',
            success: function (result) {
                let data = JSON.parse(result);
                $(".cart-counter").text(data.count);
                wrapperDiv.empty();
                wrapperDiv.html(data.partial);
            },
            error: function (result) {

            }
        });
    });

    $("#citiesNp").change(function () {
        let Ref = $(this).val();
        $('#order-address').val( $("option:selected", this).text() + ": ");
        $.ajax({
            url: '/user/get-warehouses',
            data: {ref: Ref},
            type: 'GET',
            beforeSend: function(){
                $("#select-warehouse-np").empty();
                $("#select-warehouse-np").attr('disabled', 'disabled');
            },
            success: function (result) {
                let data = JSON.parse(result);
                if(data != null) {
                    // console.log(result);
                    $("#select-warehouse-np").removeAttr('disabled');
                    $("#select-warehouse-np").empty();
                    $("#select-warehouse-np").append($("<option></option>")
                        .attr("value", '')
                        .text(''));
                    for (let i = 0; i < data.data.length; i++) {
                        $("#select-warehouse-np").append($("<option></option>")
                            .attr("value", data.data[i].Description)
                            .text(data.data[i].Description));
                    }
                }
            },
            error: function (result) {
                $("#select-warehouse-np").empty();
                $("#select-warehouse-np").attr('disabled', 'disabled');
            }
        });
    });



});