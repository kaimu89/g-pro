$(function () {

    //font start これはmenuを開く閉じるを設定

    //一旦コメントアウト

    // $(".font").on('touchstart', function () {

    //     if ($('.modal,.app').hasClass("none")) {
    //         $('.modal,.app').removeClass('none');
    //     } else {
    //         $('.modal,.app').addClass('none');
    //         $('.r1').addClass('none1');
    //         $('.r2').addClass('none2');
    //         $('.r3').addClass('none3');

    //     }

    // });

    // $(".modal").on('touchstart', function () {
    //     $('.modal,.app').addClass('none');
    //     $('.r1').addClass('none1');
    //     $('.r2').addClass('none2');
    //     $('.r3').addClass('none3');
    // });

    $(".font").on('click', function () {

        if ($('.modal,.app').hasClass("none")) {
            $('.modal,.app').removeClass('none');
            $('.app-noti').addClass('none');
        } else {
            $('.modal,.app').addClass('none');
            $('.r1').addClass('none');
            $('.r2').addClass('none');
            $('.r3').addClass('none');
        }
    });

    $('.app-bell').on('click', function () {

        if ($('.modal,.app-noti').hasClass("none")) {
            $('.modal,.app-noti').removeClass('none');
            $('.app').addClass('none');
            $('.r1').addClass('none');
            $('.r2').addClass('none');
            $('.r3').addClass('none');
        } else {
            $('.modal,.app-noti').addClass('none');
        }
    });

    $(".modal").on('click', function () {
        $('.modal,.app').addClass('none');
        $('.modal,.app-noti').addClass('none');
        $('.r1').addClass('none');
        $('.r2').addClass('none');
        $('.r3').addClass('none');
    });

    //font end

    //ここはメニュの中のメニュ

    //タッチ　一旦コメントアウト
    // $(".regi").on('touchstart', function () {

    //     if ($('.r1').hasClass("none1")) {
    //         $('.r1').removeClass('none1');

    //         if (!$('.r2').hasClass("none2")) {
    //             $('.r2').addClass('none2');
    //         }
    //         if (!$('.r3').hasClass("none3")) {
    //             $('.r3').addClass('none3');
    //         }
    //     } else {
    //         $('.r1').addClass('none1');
    //     }
    // });

    // $(".recr").on('touchstart', function () {
    //     if ($('.r2').hasClass("none2")) {
    //         $('.r2').removeClass('none2');

    //         if (!$('.r1').hasClass("none1")) {
    //             $('.r1').addClass('none1');
    //         }

    //         if (!$('.r3').hasClass("none3")) {
    //             $('.r3').addClass('none3');
    //         }
    //     } else {
    //         $('.r2').addClass('none2');
    //     }
    // });

    // $(".use").on('touchstart', function () {

    //     if ($('.r3').hasClass("none3")) {
    //         $('.r3').removeClass('none3');

    //         if (!$('.r1').hasClass("none1")) {
    //             $('.r1').addClass('none1');
    //         }

    //         if (!$('.r2').hasClass("none2")) {
    //             $('.r2').addClass('none2');
    //         }
    //     } else {
    //         $('.r3').addClass('none3');
    //     }
    // });

    //クリック
    $(".regi").on('click', function () {
        if ($('.r1').hasClass("none")) {
            $('.r1').removeClass('none');

            if (!$('.r2').hasClass("none")) {
                $('.r2').addClass('none');
            }

            if (!$('.r3').hasClass("none")) {
                $('.r3').addClass('none');
            }
        } else {
            $('.r1').addClass('none');
        }
    });

    $(".recr").on('click', function () {
        if ($('.r2').hasClass("none")) {
            $('.r2').removeClass('none');

            if (!$('.r1').hasClass("none")) {
                $('.r1').addClass('none');

                if (!$('.r3').hasClass("none")) {
                    $('.r3').addClass('none');
                }
            }
        } else {
            $('.r2').addClass('none');
        }
    });

    $(".use").on('click', function () {
        if ($('.r3').hasClass("none")) {
            $('.r3').removeClass('none');

            if (!$('.r1').hasClass("none")) {
                $('.r1').addClass('none');
            }

            if (!$('.r2').hasClass("none")) {
                $('.r2').addClass('none');
            }
        } else {
            $('.r3').addClass('none');
        }
    });




    $('.pc-bell').on('click', function () {
        if ($('.pc-notice').hasClass('none')) {
            $('.pc-notice').removeClass('none');
            $('.u-menu').addClass('none');
        } else {
            $('.pc-notice').addClass('none');
        }
    });


    //これはユーザーメニュ、pc画面
    $(".user").on('click', function () {
        if ($('.u-menu').hasClass("none")) {
            $('.u-menu').removeClass('none');
            $('.pc-notice').addClass('none');
        } else {
            $('.u-menu').addClass('none');
        }
    });

    $(document).on('click touchstart', function (event) {

        if (!$(event.target).closest('.pc-bell').length) {
            $('.pc-notice').addClass('none');
        }
    });

    $(document).on('click touchstart', function (event) {

        if (!$(event.target).closest('.user').length) {
            $('.u-menu').addClass('none');
        }
    });

});