<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Recruit;
use App\Models\FromUserToTeam;

use Illuminate\Support\Facades\Auth;

class FindTeamController extends Controller
{


    public function show(Request $request)
    {
        // if (isset($request->pc) || isset($request->app)) {

        //こっから-----------------------

        //これはpcとappで送信フォームが別なために分けて処理をしている　していることは同じ
        // if (isset($request->pc)) {
        //     $proama0 = $request->input("proamaP.0");
        //     $proama1 = $request->input("proamaP.1");
        // } elseif (isset($request->app)) {
        //     $proama0 = $request->input("proamaA.0");
        //     $proama1 = $request->input("proamaA.1");
        // }

        //$proama0は最初のcheckboxだが、２個目をcheckして１個目をcheckしない場合も
        //２個目の値が$proama0に入ってしまう。これを処理するために下記のような書き方になっている。

        //$proama1に値がある場合は、両方に値がある場合に限る。
        // if (isset($proama1)) {
        //     $pro = $proama0;
        //     $ama = $proama1;
        // } else {
        //     //$proama1に値がない場合、$proama0に値が入るパターンはプロの値が入るパターンと一般の値が
        //     //入ってしまうパターンがある。これを処理する。
        //     if ($proama0 == 'プロ') {
        //         $pro = $proama0;
        //         $ama = null;
        //     } elseif ($proama0 == '一般') {
        //         $pro = null;
        //         $ama = $proama0;
        //     } elseif ($proama0 == null) {
        //         $pro = null;
        //         $ama = null;
        //     }
        // }

        // //こっちもcheckboxなので上記と一緒の処理
        // $job0 = $request->input("job.0");
        // $job1 = $request->input("job.1");


        // if (isset($job1)) {
        //     $r_player = $job0;
        //     $r_staff = $job1;
        // } else {
        //     if ($job0 == '選手') {
        //         $r_player = $job0;
        //         $r_staff = null;
        //     } elseif ($job0 == 'スタッフ') {
        //         $r_player = null;
        //         $r_staff = $job0;
        //     } elseif ($job0 == null) {
        //         $r_player = null;
        //         $r_staff = null;
        //     }
        // }

        //ここまでlaravelでの処理

        $pro = $request->pro;
        $ama = $request->ama;

        if ($pro == "" || $pro == "false") {
            $pro = null;
        }

        if ($ama == "" || $ama == "false") {
            $ama = null;
        }



        if ($pro == true && $ama == true) {
            $pro = null;
            $ama = null;
        } elseif ($pro == true && $ama == null) {
            $pro = true;
            $ama = null;
        } elseif ($pro == null && $ama == true) {
            $pro = null;
            $ama = true;
        } elseif ($pro == null && $ama == null) {
            $pro = null;
            $ama = null;
        }

        $player = $request->player;
        $staff = $request->staff;

        if ($player == "" || $player == "false") {
            $player = null;
        }

        if ($staff == "" || $staff == "false") {
            $staff = null;
        }



        if ($player == true && $staff == true) {
            $player = null;
            $staff = null;
        } elseif ($player == true && $staff == null) {
            $player = true;
            $staff = null;
        } elseif ($player == null && $staff == true) {
            $player = null;
            $staff = true;
        } elseif ($player == null && $staff == null) {
            $player = null;
            $staff = null;
        }


        $team = $request->team;
        $game = $request->game;
        $position = $request->position;
        $rank = $request->rank;
        $house = $request->house;
        $age = $request->age == 0 ? null : $request->age;

        if (is_null($pro)  && is_null($ama)  && is_null($player) && is_null($staff) && is_null($team) && is_null($game) && is_null($position) && is_null($rank) && is_null($age) && is_null($house)) {
            $recruits = Recruit::with(['position', 'rank', 'team', 'staff', 'game'])->orderBy('id', 'desc')->paginate(7);

            // $recruits->withPath(request()->fullUrl());
            return [
                // "ages" => $this->ages,
                // "games" => $this->games,
                "recruits" => $recruits,
                "request" => $request->all(),
                "pro" => $pro,
                "ama" => $ama,
                "team" => $team,
                "player" => $player,
                "staff" => $staff,
                "game" => $game,
                "position" => $position,
                "rank" => $rank,
                "age" => $age,
                "house" => $house,
            ];
        } else {

            $query = Recruit::query();

            if (isset($pro) && !isset($ama)) {
                $pro_teams = Team::where("proama", 0)->get()->pluck('id');
                $query->whereIn("team_id", $pro_teams);
            }

            if (!isset($pro) && isset($ama)) {
                $ama_teams = Team::where("proama", 1)->get()->pluck('id');
                $query->whereIn("team_id", $ama_teams);
            }

            if (isset($player) && !isset($staff)) {
                $query->whereNull("staff_id");
            }

            if (!isset($player) && isset($staff)) {
                $query->whereNull("position_id");
            }

            if (isset($team)) {
                $query->where("team_id", $team);
            }

            if (isset($game)) {
                $query->where("game_id", $game);
            }

            if (isset($position)) {
                $query->where("position_id", $position);
            }

            if (isset($rank)) {
                $query->where("rank_id", $rank);
            }

            if (isset($age)) {
                $query->where("age", $age);
            }

            if (isset($house)) {
                $query->where("house", $house);
            }

            $recruits = $query->with(['position', 'rank', 'team', 'staff', 'game'])->orderBy('id', 'desc')->paginate(7);

            // $recruits->withPath(request()->fullUrl());

            return  [
                // "ages" => $this->ages,
                // "games" => $this->games,
                "recruits" => $recruits,
            ];
        }


        // $recruits = Recruit::with(['position', 'rank', 'team', 'staff', 'game'])->orderBy('id', 'desc')->paginate(7);

        // return [
        //     "recruits" => $recruits,
        // ];
    }

    public function oubo(Request $request)
    {
        //送られてきたidに関連するrecruit
        $recruit = Recruit::find($request->oubo);
        //recruit先のチーム
        $team = $recruit->team;


        //ログインされているかとplayerに登録されているかが必要だが
        //playerに登録されているかはmiddlewareで判断する。
        if (Auth::check()) {
            $notice = new FromUserToTeam;
            $notice->recruit_id = $recruit->id;
            $notice->team_id = $team->id;
            if (isset($recruit->staff_id)) {
                $notice->user_id = Auth::id();
            } elseif (isset($recruit->position_id) && isset($recruit->rank_id)) {
                $notice->player_id = Auth::user()->player->id;
            }
            $notice->save();
        }

        return redirect('findteam');
    }
}
