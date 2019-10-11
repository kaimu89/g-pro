<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{

    // public function __construct()
    // {
    //     // 認証が必要
    //     $this->middleware('auth')->except(['index']);
    // }

    public function show()
    {
        //eagerロードを使用する時
        //呼び出したいものをモデルにwithにはその関連を,複数あったら配列にする、ネストだったら.を使用する。
        //withの中にはモデルの中にあるリレーションに使用しているメソッド名を書く。
        //belongだったら必然的に単体名になるし、hasManyとかだったら複数となる。

        $teams = Team::with('teamgames.game')->orderBy('name', 'asc')->paginate(6);

        return $teams;
    }

    public function explain($name)
    {
        $team = Team::where('name', $name)->first();

        return view("newproject.explain", [
            "team" => $team,
        ]);
    }

    public function back()
    {
        return back();
    }
}
