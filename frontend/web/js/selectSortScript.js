$(document).ready(function(){

    $("#sort-selection").on("change", function () {
        let sort = $(this).val();

        console.log(window.location.href);

        $.ajax({
            url: window.location.href,
            data: {sort: sort},
            type: 'GET',
            success: function (result) {
            },
            error: function (result) {

            }
        });
    });

});