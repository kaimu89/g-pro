<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyTeamNoticeController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $team = $user->team;

        $notices = $team->fromusertoteams;


        return view("newproject.myteamNotice", [
            "notices" => $notices,
        ]);
    }

    public function reject(Request $request)
    {
        dd($request->reject);

        return redirect('myteam/notice');
    }
}
