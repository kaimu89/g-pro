<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongTeam;
use App\Traits\belongPlayer;

class ScoutUser extends Model
{
    use belongTeam;
    use belongPlayer;
}
