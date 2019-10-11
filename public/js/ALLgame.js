$(function () {

    $.ajax({
        type: 'GET',
        url: 'http://homestead.test/json',
        dataType: 'json'
    }).done(function (json) {

        //pcの画面の選択項目
        var game = $('.game option:selected').val();

        for (var i = 0; i < json.positions.length; i++) {
            if (game == (json["positions"][i].game_id)) {
                $('.position')
                    .append("<option class=position-op value=" + json["positions"][i].id + ">" + json["positions"][i].name + "</option>");
            }
        }

        for (var i = 0; i < json.ranks.length; i++) {
            if (game == (json["ranks"][i].game_id)) {
                $('.rank')
                    .append("<option class=rank-op value=" + json["ranks"][i].id + ">" + json["ranks"][i].name + "</option>");
            }
        }

        $(".game").change(function () {
            $(".position-op").remove();
            $(".rank-op").remove();

            var game = $(".game option:selected").val();

            for (var i = 0; i < json.positions.length; i++) {
                if (game == (json["positions"][i].game_id)) {
                    $('.position')
                        .append("<option class=position-op value=" + json["positions"][i].id + ">" + json["positions"][i].name + "</option>");
                }
            }

            for (var i = 0; i < json.ranks.length; i++) {
                if (game == (json["ranks"][i].game_id)) {
                    $('.rank')
                        .append("<option class=rank-op value=" + json["ranks"][i].id + ">" + json["ranks"][i].name + "</option>");
                }
            }

        });
        //pcはここまで


        //appの画面の選択項目
        var game = $('.app-game option:selected').val();

        for (var i = 0; i < json.positions.length; i++) {
            if (game == (json["positions"][i].game_id)) {
                $('.app-position')
                    .append("<option class=position-op value=" + json["positions"][i].id + ">" + json["positions"][i].name + "</option>");
            }
        }

        for (var i = 0; i < json.ranks.length; i++) {
            if (game == (json["ranks"][i].game_id)) {
                $('.app-rank')
                    .append("<option class=rank-op value=" + json["ranks"][i].id + ">" + json["ranks"][i].name + "</option>");
            }
        }

        $(".app-game").change(function () {
            $(".position-op").remove();
            $(".rank-op").remove();

            var game = $(".app-game option:selected").val();

            for (var i = 0; i < json.positions.length; i++) {
                if (game == (json["positions"][i].game_id)) {
                    $('.app-position')
                        .append("<option class=position-op value=" + json["positions"][i].id + ">" + json["positions"][i].name + "</option>");
                }
            }

            for (var i = 0; i < json.ranks.length; i++) {
                if (game == (json["ranks"][i].game_id)) {
                    $('.app-rank')
                        .append("<option class=rank-op value=" + json["ranks"][i].id + ">" + json["ranks"][i].name + "</option>");
                }
            }

        });
        //appはここまで


    });

});
