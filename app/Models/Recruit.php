<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongTeam;
use App\Traits\belongGame;
use App\Traits\belongPosition;
use App\Traits\belongRank;
use App\Traits\belongStaff;

class Recruit extends Model
{
    use belongTeam;
    use belongGame;
    use belongPosition;
    use belongRank;
    use belongStaff;

    /*
    public function getAgeAttribute()
    {
        switch ($this->attributes['age']) {
            case 0:
                return "10~14歳";
            case 1:
                return "15~19歳";
            case 2:
                return "20~24歳";
            case 3:
                return "25~29歳";
        }
    }
    public function getHouseAttribute()
    {
        switch ($this->attributes['house']) {
            case 0:
                return "あり";
            case 1:
                return "なし";
        }
    } */
}
