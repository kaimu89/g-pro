$(function () {

    $(".pro-title").hide();
    $(".pro-top").hide();
    $(".ama-title").hide();
    $(".ama-top").hide();
    $('.pro-hp').hide();

    var check = $('input[name="proama"]:checked').val();

    if (check == 0) {
        $(".pro-title").show();
        $(".pro-top").show();
        $('.pro-hp').show();
        $(".ama-title").hide();
        $(".ama-top").hide();
    }

    if (check == 1) {
        $(".ama-title").show();
        $(".ama-top").show();
        $(".pro-title").hide();
        $(".pro-top").hide();
        $('.pro-hp').hide();
    }

    $('input[name="proama"]').change(function () {
        var proama = $(this).val();

        if (proama == 0) {
            $(".pro-title").show();
            $(".pro-top").show();
            $('.pro-hp').show();
            $(".ama-title").hide();
            $(".ama-top").hide();
        }

        if (proama == 1) {
            $(".ama-title").show();
            $(".ama-top").show();
            $(".pro-title").hide();
            $(".pro-top").hide();
            $('.pro-hp').hide();
        }
    });
});