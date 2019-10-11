<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MyPlayerEditRequest;
use App\Models\Game;

class MyPlayerController extends Controller
{
    public function show()
    {
        $player = Auth::user()->player;


        return [
            "player" => $player->load(['game', 'position', 'rank']),
        ];
    }

    public function input()
    {
        $user = Auth::user();
        $player = $user->player;
        $game = $player->game;
        $positions = $game->positions;
        $ranks = $game->ranks;

        return view("newproject.myplayerEdit", [
            "allgames" => $this->games,
            "user" => $user,
            "player" => $player,
            "game" => $game,
            "positions" => $positions,
            "ranks" => $ranks,
        ]);
    }

    public function change(MyPlayerEditRequest $request)
    {
        $player = Auth::user()->player;
        $player->ign = $request->ign;
        $player->proama = $request->proama;
        $player->game_id = $request->game_id;
        $player->position_id = $request->position_id;
        $player->rank_id = $request->rank_id;
        $player->description = $request->description;
        $player->save();

        return $player;
    }
}
