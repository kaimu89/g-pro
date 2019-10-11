<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Team;
use App\Models\Notice;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return view("newproject.index", []);
    }

    public function show(Request $request)
    {
        $notices = Notice::all();


        return view("newproject.try", [
            "notices" => $notices,
            "item" => "apple",
        ]);
    }

    public function create(Request $request)
    {
        $notice = new Notice;

        $notice->team_id = $request->team_id;

        $notice->save();

        $notices = Notice::select('id')->get();

        echo $notices;
    }

    public function jsontry()
    {
        $notices = Notice::select("id")->get();
        return response()->json([
            "notices" => $notices,
        ]);
    }

    public function more(Request $request)
    {
        $morest = $request->session()->pull('more');

        return view("newproject.try3", [
            "morest" => $morest,
        ]);
    }

    public function json()
    {
        $positions = Position::select("id", "name", "game_id")->get();
        $ranks = Rank::select("id", "name", "game_id")->get();
        $teams = Team::select("id", "name", "proama")->get();

        return response()->json([
            "positions" => $positions,
            "ranks" => $ranks,
            "teams" => $teams,
        ]);
    }
}
