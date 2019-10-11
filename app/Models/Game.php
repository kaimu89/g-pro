<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\hasManyPosition;
use App\Traits\hasManyRank;
use App\Traits\hasManyPlayer;
use App\Traits\hasManyTeamGame;

class Game extends Model
{
    use hasManyPosition;
    use hasManyRank;
    use hasManyPlayer;
    use hasManyTeamGame;
}
