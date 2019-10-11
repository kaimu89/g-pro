<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Recruit;

class MyTeamShowController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        //チームに所属しているか 部門に所属しているか
        if (isset($user->team_id)) {
            $team = $user->team;
            $mainMembers = $team->users;
            $recruits = $team->recruits()->paginate(6);
            $childs = $team->childs;
        } elseif (isset($user->child_id)) {
            $team = $user->child->team;
            $mainMembers = $team->users;
            $recruits = $team->recruits()->paginate(6);
            $childs = $team->childs;
        }

        //エラーになったためコメントアウト。　さらにvueでは使用してなかったため
        // foreach ($childs as $child) {

        //     $childs_with[] = $child->load(["teamgame.game", 'users']);
        // }

        return [
            "user" => $user,
            "team" => $team->load('teamgames.game'),
            //vueで使ってないためコメントアウト
            // "mainMembers" => $mainMembers,
            "recruits" => $recruits->load(['staff', 'game', 'position', 'rank']),
            //vueで使ってないためコメントアウト
            "childs" => $childs->load(["teamgame.game", 'users']),
        ];
    }

    public function change(Request $request)
    {
        $user = Auth::user();


        //チーム脱退時処理
        if (isset($request->leave) && (isset($user->team_id) || isset($user->child_id))) {

            //チームか部門かでチームに所属していた場合
            if (isset($user->team_id)) {
                //リーダーだった場合
                if ($user->leader == 0) {
                    $user->leader = null;

                    $bye_team = $user->team;

                    $user->team_id = null;
                    $user->save();

                    //自分がリーダーでやめた場合他の人にリーダー
                    if (isset($bye_team->users[0])) {
                        $bye_team->users[0]->leader = 0;
                        $bye_team->users[0]->save();
                    } else {
                        $bye_team->delete();
                    }
                }
                $user->team_id = null;
                $user->save();
                //部門に所属していた場合
            } elseif (isset($user->child_id)) {
                if ($user->leader == 0) {
                    $user->leader = null;

                    $bye_team = $user->child;

                    $user->child_id = null;
                    $user->save();

                    //自分がリーダーでやめた場合他の人にリーダー
                    if (isset($bye_team->users[0])) {
                        $bye_team->users[0]->leader = 0;
                        $bye_team->users[0]->save();
                    }
                }
                $user->child_id = null;
                $user->save();
            }
            return;
        }

        //チームロゴを変更する処理
        if (isset($request->logo) && isset($user->team_id) && Auth::user()->leader == 0) {
            $team = Auth::user()->team;
            $team->picture = $request->logo;
            $team->save();

            return;
        }

        //募集リストを消去する
        if (isset($request->delete) && isset($user->team) && $user->leader == 0) {
            $recruit = Recruit::find($request->delete);

            $id = $recruit->id;

            $recruit->delete();

            return $id;
        }

        // return redirect("/");
    }
}
