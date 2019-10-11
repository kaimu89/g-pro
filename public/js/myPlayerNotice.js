$(function () {


    //スカウト のバナーを開く
    $('.ok-btn').on('click', function () {

        var data_id = event.target.getAttribute('data-id');

        $('.scout-' + data_id).removeClass('none');

    });

    //スカウト のバナーを閉じる
    $('.scout-close-btn').on('click', function () {

        $('.banner-box').addClass('none');
    });

    //断る のバナーを開く
    $('.no-btn').on('click', function () {

        $('.reject').removeClass('none');
    });

    //断る のバナーを閉じる
    $('.reject-close-btn').on('click', function () {

        $('.reject').addClass('none');
    });

});