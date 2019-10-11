<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RecruitAmaRequest;
use App\Models\Game;
use App\Models\Staff;
use App\Models\Recruit;

class RecruitTeamAmaController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $teamgame = $user->team->teamgame->game;
        $teampositions = $teamgame->positions;
        $teamranks = $teamgame->ranks;

        return  [
            "user" => $user,
            "teamgame" => $teamgame,
            "teampositions" => $teampositions,
            "teamranks" => $teamranks,
        ];
    }

    public function create(RecruitAmaRequest $request)
    {
        $user = Auth::user();

        $recruit = new Recruit;
        $recruit->team_id = $user->team->id;
        $recruit->game_id = $user->team->teamgame->game->id;
        $recruit->position_id = $request->position;
        $recruit->rank_id = $request->rank;
        $recruit->description = $request->description;
        $recruit->save();

        return $recruit;
    }
}
