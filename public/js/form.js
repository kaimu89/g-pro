$(function () {

    //関数にしようとしたが動かない。
    /*function input(value) {
        $('.tx-' + value).on('input', function () {
            $('.fo-' + value).val($('.tx-' + value).val());
        });
        console.log($('.fo-' + value).val());
    }*/
    //関数実行　動かない
    //input('name');

    $('.tx-name').on('input', function () {
        var name = $('.tx-name').val();

        $('.fo-name').val(name);

    });

    $('.tx-mail').on('input', function () {
        var mail = $('.tx-mail').val();

        $('.fo-mail').val(mail);

    });

    $('.tx-top').on('input', function () {
        var top = $('.tx-top').val();

        $('.fo-top').val(top);

    });

    $('.tx-des').on('input', function () {
        var des = $('.tx-des').val();

        $('.fo-des').val(des);

    });

    var name = $('.tx-name').val();
    var mail = $('.tx-mail').val();
    var top = $('.tx-top').val();
    var des = $('.tx-des').val();

    $('.fo-name').val(name);
    $('.fo-mail').val(mail);
    $('.fo-top').val(top);
    $('.fo-des').val(des);



    //誕生日
    var year = $('.year option:selected').val();
    var month = $('.month option:selected').val();
    var day = $('.day option:selected').val();

    var birthday = year + "-" + month + "-" + day;

    console.log(birthday);
});




誕生日を変更した場合のコード

function birthday(value) {

    $(value).change(function () {
        var year = $(value + ' option:selected').val();

        // console.log(year);

        return year;

    });

    // console.log(value);

}

var year = birthday('.year');
var month = birthday('.month');
var day = birthday('.day');

console.log(year);
console.log(month);
console.log(day);


var reback = document.getElementById('reback');

reback.addEventListener('click', sample, false);


function sample() {

    console.log(year);

    var birthdayday = year + "-" + month + "-" + day;

    console.log(birthdayday);
}


// playerのappの条件を出す関数

$('.app-span').on('click', function () {
    $('.conditionsbox').css('display', 'block');
});
