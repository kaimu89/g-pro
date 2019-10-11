<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongTeam;
use App\Traits\hasOneTeamGame;
use App\Traits\hasManyUser;

class Child extends Model
{
    use belongTeam;
    use hasOneTeamGame;
    use hasManyUser;
}
