$(document).ready(function(){

    $("#sort-selection").on("change", function () {
        let sort = $(this).val();

        $("#form-sort-selection").submit();
    });

});