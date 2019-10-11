<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddTeamRequest;
use App\Http\Requests\AddProRequest;
use App\Models\Team;
use App\Models\Teamgame;
use App\Models\Child;
use App\Models\Game;

class AddTeamController extends Controller
{
    public function show()
    {
        return view("newproject.addTeam", [
            "games" => $this->games,
        ]);
    }

    public function create(AddTeamRequest $request)
    {
        // return $request->all();

        $team = new Team;
        $team->name = $request->name;

        $team->proama = $request->proama;
        $team->email = $request->email;
        $path = $request->file->store('public/logo');
        $team->picture = "/logo/" . basename($path);
        if (isset($request->pro_top)) {
            $team->top = $request->pro_top;
        } elseif (isset($request->ama_top)) {
            $team->top = $request->ama_top;
        }
        $team->hp = $request->hp;
        $team->description = $request->description;
        $team->save();

        $user = Auth::user();
        $user->team_id = $team->id;
        $user->leader = "0";
        $user->save();


        if ($request->ama_game) {
            $teamgame = new Teamgame;
            $teamgame->team_id = $team->id;
            $teamgame->game_id = $request->ama_game;
            $teamgame->save();

            return $team;
        }

        if ($request->pro_game) {
            $progames =  explode(",", $request->pro_game);

            foreach ($progames as $progame) {
                $teamgame = new Teamgame;
                $teamgame->team_id = $team->id;
                $teamgame->game_id = $progame;
                $teamgame->save();
            }

            return $team;
        }

        return $team;
    }

    public function pro()
    {
        $user = Auth::user();

        $teamgames = $user->team->teamgames;

        //チームゲームid
        foreach ($teamgames as $teamgame) {
            $team_id[] = $teamgame->game->id;
        }

        if (isset($user->team->childs[0])) {

            $childs = $user->team->childs;

            foreach ($childs as $child) {
                $child_id[] = $child->teamgame->game->id;
            }

            $sum = array_merge($child_id, $team_id);


            //被ってるかどうかを判断する 被ってたらその数を配列にする
            $cnt_list = array_count_values($sum);
            //被ってない1の数だけを取得。被ってるのは切り捨て
            foreach ($cnt_list as $key => $val) {
                if ($val == 1) $games_id[] = $key;
            }

            if (isset($games_id)) {
                $games = Game::whereIn("id", $games_id)->get();

                return [
                    "user" => $user,
                    "games" => $games,
                ];
            }
            return '登録ゲーム全部にchildが登録されてるよ';
        } else {

            //これは1つもchildが作られてない時にチームゲーム
            //をそのまま表示する

            foreach ($teamgames as $teamgame) {
                $games[] = $teamgame->game;
            }

            return  [
                "user" => $user,
                "games" => $games,
            ];
        }
    }

    public function addPro(AddProRequest $request)
    {
        $user = Auth::user();

        $team = new Child;
        $team->team_id = $user->team->id;
        $team->name = $request->name;
        if (isset($request->top)) {
            $team->top = $request->top;
        } else {
            $team->top = $user->team->top;
        }
        if (isset($request->mail)) {
            $team->email = $request->email;
        } else {
            $team->email = $user->team->email;
        }
        $team->description = $request->description;
        $team->save();

        $teamgame = new Teamgame;

        $teamgame->child_id = $team->id;
        $teamgame->game_id = $request->game;
        $teamgame->save();

        return $team;

        // return redirect("/myteam");
    }
}
