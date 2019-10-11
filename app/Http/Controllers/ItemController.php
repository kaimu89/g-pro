<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Staff;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Team;

class ItemController extends Controller
{
    public function item()
    {
        $ages = [0 => "指定しない", 1 => "10代前半", 2 => "10代後半", 3 => "20代前半", 4 => "20代後半"];
        $games = Game::all();
        $positions = Position::select('id', 'name', 'game_id')->get();
        $ranks = Rank::select('id', 'name', 'game_id')->get();
        $staffs = Staff::select('id', 'name')->get();
        $teams = Team::with('teamgames.game')->get();

        return [
            "ages" => $ages,
            "games" => $games,
            "positions" => $positions,
            "ranks" => $ranks,
            "staffs" => $staffs,
            "teams" => $teams,
        ];
    }

    public function team()
    {
        $teams = Team::with('teamgames.game')->get();

        return $teams;
    }
}
