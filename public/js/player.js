$(function () {

    $('.player-name-leader').on('click', function () {

        $('.banner-box').removeClass('none');

        var data_id = event.target.getAttribute('data-id');

        $('.scout-input').val(data_id);

    });

    $('.cancel').on('click', function () {
        $('.banner-box').addClass('none');
    });



});