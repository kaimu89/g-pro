<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RecruitProRequest;
use App\Models\Recruit;

class RecruitTeamProController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $teamgames = $user->team->teamgames;

        return [
            "user" => $user,
            "teamgames" => $teamgames->load('game'),
        ];
    }

    public function create(RecruitProRequest $request)
    {
        $user = Auth::user();
        $recruit = new Recruit;
        $recruit->team_id = $user->team->id;
        $recruit->game_id = $request->game;
        $recruit->position_id = $request->position;
        $recruit->rank_id = $request->rank;
        $recruit->age = $request->age;
        $recruit->house = $request->house;
        $recruit->description = $request->description;
        $recruit->save();

        return $recruit;
    }
}
