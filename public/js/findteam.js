$(function () {

    $.ajax({
        type: 'GET',
        url: 'http://homestead.test/json',
        dataType: 'json'
    }).done(function (json) {

        //app画面の処理
        $('input[name="proamaA[]"]').change(function () {
            //$(".team-op").remove();

            var pro = $(".app-pro").prop("checked");
            var ama = $(".app-ama").prop("checked");

            console.log(pro);
            console.log(ama);

            if (pro) {
                if ($('.team-pro').val() == null) {
                    for (var i = 0; i < json.teams.length; i++) {
                        if (json["teams"][i].proama == 0) {
                            $('.app-team')
                                .append("<option class=team-pro value=" + json["teams"][i].id + ">" + json["teams"][i].name + "</option>");
                        }
                    }
                }
                $(".app-house-op").show();
            } else {
                $(".app-house-op").hide();
                $(".team-pro").remove();
            }
            if (ama) {
                if ($('.team-ama').val() == null) {
                    for (var i = 0; i < json.teams.length; i++) {
                        if (json["teams"][i].proama == 1) {
                            $('.app-team')
                                .append("<option class=team-ama value=" + json["teams"][i].id + ">" + json["teams"][i].name + "</option>");
                        }
                    }
                }
            } else {
                $(".team-ama").remove();
            }
        });



        //pc画面の処理
        $('input[name="proamaP[]"]').change(function () {
            //$(".team-op").remove();

            var pro = $(".pc-pro").prop("checked");
            var ama = $(".pc-ama").prop("checked");

            console.log(pro);
            console.log(ama);

            if (pro) {
                if ($('.team-pro').val() == null) {
                    for (var i = 0; i < json.teams.length; i++) {
                        if (json["teams"][i].proama == 0) {
                            $('.team')
                                .append("<option class=team-pro value=" + json["teams"][i].id + ">" + json["teams"][i].name + "</option>");
                        }
                    }
                }
                $(".house-op").show();
            } else {
                $(".house-op").hide();
                $(".team-pro").remove();
            }
            if (ama) {
                if ($('.team-ama').val() == null) {
                    for (var i = 0; i < json.teams.length; i++) {
                        if (json["teams"][i].proama == 1) {
                            $('.team')
                                .append("<option class=team-ama value=" + json["teams"][i].id + ">" + json["teams"][i].name + "</option>");
                        }
                    }
                }
            } else {
                $(".team-ama").remove();
            }
        });

    });

    $('.oubo').on('click', function () {
        $('.confirm').removeClass('none');

        var data_id = event.target.getAttribute('data-id');

        $('.oubo-input').val(data_id);
    });

    $('.cancel').on('click', function () {
        $('.confirm').addClass('none');
    });



});
