$(document).ready(function () {
    $('img.img-responsive').click(function () {//додаю галочку на вімічену фотографію
        var a = $(this).attr('class');
        if (a.indexOf('chosen') == -1) {
            $(this).parent().append('<img class="checkIcon" src="../check.png" style="position: absolute;top:0;">');
            $(this).addClass('chosen');
        } else {
            $(this).parent().children('img.checkIcon').remove();
            $(this).removeClass('chosen');
        }


    });
    $('#sendImg').click(function () {
        var chosenImg = $('.chosen');//масив відмічених фотографій
        var images = {};
        for (var i = 0; i < chosenImg.length; i++) {
            images += '/||/' + $(chosenImg[i]).attr('src');//склеюємо ссилки в одну строку
        }

        $.ajax({
                type: 'POST',
                url: '../classes/uploadVkImg.php',
                images: images,
                beforeSend: function (data) {
                    $('#sendImg').attr('disabled', 'disabled'); //відключаєммо кнопку
                },
                success: function (data) {
                    alert(data);
                },
                complete: function (data) {
                    $('#sendImg').removeAttr('disabled');
                }
            }
        );
    })

});
