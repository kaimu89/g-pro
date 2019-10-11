<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamGame;
use App\Http\Requests\MyTeamEditRequest;

class MyTeamEditController extends Controller
{
    //マイチーム変更ページ表示
    public function show()
    {
        $user = Auth::user();
        $team = $user->team;
        $user_game = $user->team->teamgame->game;

        //チームのゲームを取得。
        $user_teamgames = $user->team->teamgames;

        //チームのゲームidをまとめる。
        foreach ($user_teamgames as $user_teamgame) {
            $user_games[] = $user_teamgame->game->id;
        }

        if (isset($user->team->childs[0])) {
            //チームに関連しているchild
            $childs = $user->team->childs;

            //childのゲームidをまとめる。
            foreach ($childs as $cil) {
                $childs_games[] = $cil->teamgame->game->id;
            }

            //チームのゲームの中でどれだけchildが作られているかを判断する
            //array_diffを使うとちーむのゲームの中でchildが作られていないゲームが取り出せる。

            /*ゲームタイトルで表示するのはゲームタイトル全部(チームが選択しているチームにはチェック)
しかしchildがあるゲームを消すことが出来ないので表示しないようにしている。*/

            $no_childs = array_diff($user_games, $childs_games);

            return  [
                // "games" => $this->games,
                // "team" => $team,
                "childs_games" => $childs_games,
                "no_childs" => $no_childs,
                "user_games" => $user_games,
                "user_game" => $user_game,
            ];
        } else {
            return [
                // "games" => $this->games,
                // "team" => $team,
                "user_games" => $user_games,
                "user_game" => $user_game,
            ];
        }
    }


    //マイチーム変更ページ 更新内容を取得
    public function change(MyTeamEditRequest $request)
    {
        $user = Auth::user();


        $team = Auth::user()->team;
        $team->name = $request->name;
        $team->email = $request->email;
        $team->hp = $request->hp;
        $team->top = $request->top;
        $team->description = $request->description;
        $team->save();


        if (isset($request->pro_game)) {

            //リクエストの値とchildで使われている値を結合して
            //それを既存のプロゲームと比べることで
            //差異を見つける

            //選択されたゲーム(childがあるゲームは表示していないため値に含まれない)
            //ゲームid 注意点としては追加するゲームだけでなく減らす場合もあること。
            $pro_ids = $request->pro_game;

            $childs = $user->team->childs;

            //チームのchildのゲームid
            foreach ($childs as $child) {
                $childgames[] = $child->teamgame->game->id;
            }

            //array_mergeは配列と配列を合体させる。
            //childのゲームidと選択されたゲームidを合体
            if (isset($pro_ids) && isset($childgames)) {
                $fusion = array_merge($pro_ids, $childgames);
            } elseif (isset($pro_ids)) {
                $fusion = $pro_ids;
            } elseif (isset($childgames)) {
                $fusion = $childgames;
            }

            $proteamgames = $user->team->teamgames;

            //チームのゲームid
            foreach ($proteamgames as $proteamgame) {
                $progames[] = $proteamgame->game->id;
            }

            //チームのゲームidと合体されたidを比較して減少していたら消す。
            $deletes = array_diff($progames, $fusion);

            //チームのゲームidと合体されたidを比較して増加していたら増やす。
            $adds = array_diff($fusion, $progames);


            //減らす処理
            if (isset($deletes)) {

                $teamgames = Teamgame::where('team_id', $user->team->id)->WhereIn("game_id", $deletes)->get();

                foreach ($teamgames as $teamgame) {
                    $teamgame->delete();
                }
            }
            //増やす処理
            if (isset($adds)) {

                foreach ($adds as $add) {
                    $teamgamee = new Teamgame;
                    $teamgamee->team_id = $user->team->id;
                    $teamgamee->game_id = $add;
                    $teamgamee->save();
                }
            }
        }

        //一般のゲームにおいて変更があった場合
        if (isset($request->ama_game)) {
            $teamGame = $user->team->teamgame;
            $teamGame->game_id = $request->ama_game;
            $teamGame->save();
        }

        return [
            "team" => $team,
            "teamgame" => Teamgame::where('team_id', $user->team->id),
        ];
    }
}
