$(document).ready(function(){

    $(".img-wrapper a").on("click", function (event) {
        event.preventDefault();
        let id = $(this).attr('data-id');
        let parentDiv = $(this).parent();
        $.ajax({
            url: '/images/delete',
            data: {id: id},
            type: 'GET',
            success: function (result) {
                if(result !== false) {
                    parentDiv.remove();
                }
            },
            error: function (result) {

            }
        });
    });



});