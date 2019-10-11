<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlayerNoticeController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $player = $user->player;

        $notices = $player->fromteamtousers;

        // dd($notices);

        return view("newproject.myplayerNotice", [
            "notices" => $notices,
        ]);
    }
}
