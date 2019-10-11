<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RecruitStaffRequest;
use App\Models\Staff;
use App\Models\Recruit;
use Illuminate\Auth\Recaller;

class RecruitStaffController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $teamgames = $user->team->teamgames;

        foreach ($teamgames as $teamgame) {
            $games[] = $teamgame->game;
        }

        return [
            // "staffs" => $this->staffs,
            "user" => $user,
            "games" => $games,
        ];
    }

    public function create(RecruitStaffRequest $request)
    {
        $user = Auth::user();

        $recruit = new Recruit;
        $recruit->team_id = $user->team->id;
        if (isset($request->game)) {
            $recruit->game_id = $request->game;
        } else {
            $recruit->game_id = $user->team->teamgame->game->id;
        }
        $recruit->staff_id = $request->staff;
        $recruit->content = $request->content;
        $recruit->ab_skill = $request->ab_skill;
        $recruit->wel_skill = $request->wel_skill;
        $recruit->description = $request->description;
        $recruit->save();

        return $recruit;
    }
}
