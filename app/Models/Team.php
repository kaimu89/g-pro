<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\hasManyRecruit;
use App\Traits\hasManyTeamGame;
use App\Traits\hasOneTeamGame;
use App\Traits\hasManyMember;
use App\Traits\hasManyUser;
use App\Traits\hasManyChild;
use App\Traits\hasManyScoutTeam;
use App\Traits\hasManyScoutUser;

class Team extends Model
{
    use hasManyRecruit;
    use hasManyTeamGame;
    use hasOneTeamGame;
    use hasManyMember;
    use hasManyUser;
    use hasManyChild;

    use hasManyScoutTeam;
    use hasManyScoutUser;

    // protected $visible = [
    //     'id', 'name', 'proama', 'picture', 'mail', 'hp', 'top', 'description',
    // ];
}
