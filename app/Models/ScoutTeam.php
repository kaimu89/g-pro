<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongTeam;
use App\Traits\belongUser;
use App\Traits\belongPlayer;
use App\Traits\belongRecruit;

class ScoutTeam extends Model
{
    use belongTeam;
    use belongUser;
    use belongPlayer;
    use belongRecruit;
}
