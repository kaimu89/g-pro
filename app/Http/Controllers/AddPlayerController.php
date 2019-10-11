<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddPlayerRequest;
use App\Models\Game;
use App\Models\Player;


class AddPlayerController extends Controller
{
    public function show()
    {
        return view("newproject.addPlayer", [
            "games" => $this->games,
        ]);
    }

    public function create(AddPlayerRequest $request)
    {
        $player = new Player;
        $player->user_id = Auth::id();
        $player->ign = $request->ign;
        $player->proama = $request->proama;
        $player->game_id = $request->game;
        $player->position_id = $request->position;
        $player->rank_id = $request->rank;
        $player->description = $request->description;
        $player->save();

        return $player;
    }
}
