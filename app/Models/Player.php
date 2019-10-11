<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminame\Database\Eloquent\Builder;
use App\Traits\belongUser;
use App\Traits\belongGame;
use App\Traits\belongPosition;
use App\Traits\belongRank;
use App\Traits\hasManyScoutUser;

class Player extends Model
{
    use belongUser;
    use belongGame;
    use belongPosition;
    use belongRank;
    use hasManyScoutUser;


    //これ入れないと違う場所の変更が入る
    /* public function getGameIdAttribute()
    {
        switch ($this->attributes['game_id']) {
            case 1:
                return "lol";

            case 2:
                return "PUBG";

            case 3:
                return "シャドバ";

            case 4:
                return "スマブラ";

            case 5:
                return "ストファイ";

            case 6:
                return "FN";

            case 7:
                return "イカ2";

            case 8:
                return "CS:GO";

            case 9:
                return "シージ";

            case 10:
                return "OW";
        }
    } */
}
