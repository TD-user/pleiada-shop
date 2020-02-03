$(document).ready(function(){

    //send to subscribers
    $("#send-letter-btn").on("click", function (event) {
        event.preventDefault();
        let letterId = $(this).attr('letter-id');
        $.ajax({
            url: '/letter/get-subscribers',
            type: 'GET',
            beforeSend: function() {
                $("#status-wrapper").text("отримання електронних адрес...");
                $("#progress-bar").css("width", '0%');
            },
            success: function (result) {
                $("#status-wrapper").text("адреси отримано...");
                let subscribers = JSON.parse(result);
                let lenght = subscribers.length;
                let counter = 0;

                $("#status-wrapper").text("триває надсилання листів, не закривайте сторінку... (" + counter + "/" + lenght + ")" );

                subscribers.forEach(function (element) {
                    $.ajax({
                        url: '/letter/send-letter',
                        data: {id: letterId, email: element},
                        type: 'GET',
                        beforeSend: function() {

                        },
                        success: function (result) {
                            if(result == 1) {
                                counter++;
                                let width = counter / lenght * 100;
                                $("#status-wrapper").text("триває надсилання листів, не закривайте сторінку... (" + counter + "/" + lenght + ")" );
                                $("#progress-bar").css("width", width + '%');
                            }
                        },
                        error: function (result) {

                        }
                    });
                });


            },
            error: function (result) {
                $("#status-wrapper").text("помилка при отриманні адрес");
            }
        });
    });


    //send test letter
    $("#send-test-letter-btn").on("click", function (event) {
        event.preventDefault();
        let letterId = $(this).attr('letter-id');
        let email = $("#test-letter-email").val();

        if(email == '') {
            alert("Поле email не може бути порожнім");
            return false;
        }

        $.ajax({
            url: '/letter/send-test-letter',
            data: {id: letterId, email: email},
            type: 'GET',
            beforeSend: function() {
                $("#test-status-wrapper").text("триває відправка...");
            },
            success: function (result) {
                if(result == 1) {
                    $("#test-status-wrapper").text("тестовий лист надіслано");
                }
                else {
                    $("#test-status-wrapper").text("сталася помилка");
                }
            },
            error: function (result) {
                $("#test-status-wrapper").text("сталася помилка");
            }
        });
    });

});