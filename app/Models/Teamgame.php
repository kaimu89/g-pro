<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongGame;
use App\Traits\belongTeam;

class Teamgame extends Model
{
    use belongTeam;
    use belongGame;
}
