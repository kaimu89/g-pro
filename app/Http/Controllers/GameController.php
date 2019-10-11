<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function show()
    {
        $games = Game::paginate(5);

        return $games;
    }
}
