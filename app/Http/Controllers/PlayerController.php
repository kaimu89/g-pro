<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;
use App\Models\FromTeamToUser;

class PlayerController extends Controller
{
    public function show(Request $request)
    {
        // if (isset($request->app) || isset($request->pc)) {

        $game = $request->game;
        $position = $request->position;
        $rank = $request->rank;
        $proama = $request->proama;
        // $age = $request->age;

        if (is_null($game) && is_null($position) && is_null($rank) && is_null($proama)) {
            $players = Player::with('user', 'game', 'position', 'rank')->orderBy('id', 'desc')->paginate(10);

            // $players->withPath(request()->fullUrl());

            return [
                // "games" => $this->games,
                'players' => $players,
                // "ages" => $this->ages,
            ];
        } else {


            $query = Player::query();

            if (isset($game)) {
                $query->where("game_id", $game);
            }

            if (isset($position)) {
                $query->where("position_id", $position);
            }

            if (isset($rank)) {
                $query->where("rank_id", $rank);
            }

            if (isset($proama)) {
                $query->where("proama", $proama);
            }

            // if (isset($age)) {
            //     $query->whereBetween("age", [$age + 9, $age + 13]);
            // }

            $players = $query->with('user', 'game', 'position', 'rank')->paginate(10);

            //検証中
            // $players->withPath(request()->fullUrl());

            return [
                // "games" => $this->games,
                'players' => $players,
                // "ages" => $this->ages,
            ];
        }
        // }

        // $players = Player::with('user', 'position', 'rank')->orderBy('id', 'desc')->paginate(5);


        // return [
        //     // "games" => $this->games,
        //     // 'positions' => $this->positions,
        //     // 'ranks' => $this->ranks,
        //     'players' => $players,
        //     // "ages" => $this->ages,
        // ];
    }

    public function scout(Request $request)
    {
        $player_id = $request->scout;

        $user = Auth::user();

        if (isset(Auth::user()->team_id) && Auth::user()->leader == '0') {
            $notice = new FromTeamToUser;
            $notice->team_id = $user->team->id;
            $notice->player_id = $player_id;
            $notice->look = true;
            $notice->save();
        }

        return $notice;
    }
}
