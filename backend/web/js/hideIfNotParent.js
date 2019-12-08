$(document).ready(function(){
    $("#categories-id_parent").change(function () {
        console.log($(this).val());
        if($(this).val() != 0)
            $(".hide-if-not-parent").css('display', 'none');
        else
            $(".hide-if-not-parent").css('display', 'block');
    });
});