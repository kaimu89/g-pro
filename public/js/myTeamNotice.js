$(function () {

    //連絡する のバナーを開く
    $('.ok-btn').on('click', function () {

        var data_id = event.target.getAttribute('data-id');

        $('.judge-' + data_id).removeClass('none');

        $('.reject-input').val(data_id);

        $('.reject').addClass('none');

    });

    //お断り のバナーを開く
    $('.no-btn').on('click', function () {

        $('.reject').removeClass('none');

        $('.judge').addClass('none');
    });

    //連絡する バナーをとじる
    $('.oubo-close-btn').on('click', function () {

        $('.banner-box').addClass('none');
    });


    //お断り バナーをとじる
    $('.reject-close-btn').on('click', function () {

        $('.banner-box').addClass('none');
    });


});