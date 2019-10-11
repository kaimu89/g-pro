<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recruit;
use App\Models\Child;
use App\Models\Teamgame;
use App\Models\Team;


class MyTeamController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        //チームに所属しているか 部門に所属しているか
        if (isset($user->team_id)) {
            $team = $user->team;
            $mainMembers = $user->team->users;
            $recruits = $user->team->recruits;
            $childs = $user->team->childs;
        } elseif (isset($user->child_id)) {
            $team_id = $user->child->team_id;
            $team = Team::find($team_id);
            $mainMembers = $team->users;
            $recruits = $team->recruits;
            $childs = $team->childs;
        }

        return view("newproject.myteamShow", [
            "user" => $user,
            "team" => $team->with('teamgames')->get(),
            "mainMembers" => $mainMembers,
            "recruits" => $recruits,
            "childs" => $childs,
        ]);
    }

    public function showchange(Request $request)
    {
        $user = Auth::user();


        //チーム脱退時処理
        if (isset($request->leave)) {

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
            return redirect('/');
        }

        //チームロゴを変更する処理
        if (isset($request->logo) && isset($user->team_id) && Auth::user()->leader == 0) {
            $team = Auth::user()->team;
            $team->picture = $request->logo;
            $team->save();

            return redirect('/myteam');
        }

        //募集リストを消去する
        if (isset($request->delete) && isset($user->team) && $user->leader == 0) {
            Recruit::find($request->delete)->delete();

            return redirect('/myteam#recruit');
        }

        return redirect("/");
    }


    //マイチーム変更ページ表示
    public function input()
    {
        $user = Auth::user();
        $team = $user->team;
        $user_game = $user->team->teamgame->game;


        $childs = $user->team->childs;

        foreach ($childs as $value) {
            $childs_games[] = $value->teamgame->game->id;
        }

        $user_teamgames = $user->team->teamgames;

        foreach ($user_teamgames as $user_teamgame) {
            $user_games[] = $user_teamgame->game->id;
        }

        $no_childs = array_diff($user_games, $childs_games);

        return view("newproject.myteamEdit", [
            "games" => $this->games,
            "user" => $user,
            "team" => $team,
            "no_childs" => $no_childs,
            "user_games" => $user_games,
            "user_game" => $user_game,
        ]);
    }


    //マイチーム変更ページ 更新内容を取得
    public function change(Request $request)
    {
        $user = Auth::user();

        $team = Auth::user()->team;
        $team->name = $request->name;
        $team->mail = $request->mail;
        $team->url = $request->hp;
        $team->top = $request->top;
        $team->description = $request->description;
        $team->save();

        //リクエストの値とchildで使われている値を結合して
        //それを既存のプロゲームと比べることで
        //差異を見つける

        $pro_ids = $request->pro_game;

        $childs = $user->team->childs;

        foreach ($childs as $child) {
            $childgames[] = $child->teamgame->game->id;
        }

        if (isset($pro_ids) && isset($childgames)) {
            $fusion = array_merge($pro_ids, $childgames);
        } elseif (isset($pro_ids)) {
            $fusion = $pro_ids;
        } elseif (isset($childgames)) {
            $fusion = $childgames;
        }

        $proteamgames = $user->team->teamgames;

        foreach ($proteamgames as $proteamgame) {
            $progames[] = $proteamgame->game->id;
        }


        $deletes = array_diff($progames, $fusion);

        $adds = array_diff($fusion, $progames);


        if (isset($deletes)) {

            $teamgames = Teamgame::where('team_id', $user->team->id)->WhereIn("game_id", $deletes)->get();

            foreach ($teamgames as $teamgame) {
                $teamgame->delete();
            }
        }

        if (isset($adds)) {

            foreach ($adds as $add) {
                $teamgamee = new Teamgame;
                $teamgamee->team_id = $user->team->id;
                $teamgamee->game_id = $add;
                $teamgamee->save();
            }
        }



        if (isset($request->ama_game)) {
            $teamGame = $user->team->teamgame;
            $teamGame->game_id = $request->game_name;
            $teamGame->save();
        }

        return redirect('/myteam');
    }


    //メンバー変更ページ表示
    public function member(Request $request)
    {
        $users = Auth::user()->team->users;

        return view("newproject.myteamMember", [
            "users" => $users,
        ]);
    }


    //メンバー変更情報取得
    public function memberchange(MyTeamMemberRequest $request)
    {

        //リーダー交代
        if (isset($request->leader)) {
            $leader_id = $request->leader;
            $leader = User::find($leader_id);
            $leader->leader = 0;
            $leader->save();
            $user = Auth::user();
            $user->leader = null;
            $user->save();

            return redirect('/myteam');
        }

        //脱退させる
        if (isset($request->leave)) {
            $user_id = $request->leave;

            $user = User::find($user_id);
            $user->team_id = null;
            $user->save();

            return redirect('/myteam/member');
        }

        //メンバー追加
        //ユーザーがいるかどうか、ユーザーがチームに所属しているかどうかはバリデーションで判断する

        //ここのバリデーションをやる まだ終わってない

        if ($request->add_member) {
            $add_member = $request->add_member;

            $team_id = Auth::user()->team_id;

            $member = User::where('user_name', $add_member)->first();

            if (isset($member->leader)) {
                $member->leader = null;

                if (isset($member->child->users[0])) {
                    $member->child->users[0]->leader = 0;
                    $member->child->users[0]->save();
                }
            }
            if (isset($member->child_id)) {
                $member->child_id = null;
            }
            $member->team_id = $team_id;
            $member->save();

            return redirect('/myteam/member');
        }
    }

    //マイチームの募集変更ページを表示
    public function recruit(Request $request)
    {
        $recruit_id = $request->recruit;
        $recruit = Recruit::find($recruit_id);
        $positions = $recruit->game->positions;
        $ranks = $recruit->game->ranks;

        return view("newproject.myteamRecruit", [
            "ages" => $this->ages,
            "staffs" => $this->staffs,
            "recruit" => $recruit,
            "positions" => $positions,
            "ranks" => $ranks,
        ]);
    }

    //マイチームの募集変更情報を取得
    public function recruitchange(Request $request)
    {
        $recruit_id = $request->recruit;
        $recruit = Recruit::find($recruit_id);

        if (isset($recruit->staff_id)) {
            $recruit->staff_id = $request->staff;
            $recruit->content = $request->content;
            $recruit->ab_skill = $request->ab_skill;
            $recruit->wel_skill = $request->wel_skill;
            $recruit->description = $request->description;
            $recruit->save();

            return redirect("/myteam");
        }

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == 0) {
            $recruit->position_id = $request->position;
            $recruit->rank_id = $request->rank;
            $recruit->age = $request->age;
            $recruit->house = $request->house;
            $recruit->description = $request->description;
            $recruit->save();

            return redirect("/myteam");
        }

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $request->team->proama == 1) {
            $recruit->position_id = $request->position;
            $recruit->rank_id = $request->rank;
            $recruit->description = $request->description;
            $recruit->save();

            return redirect("/myteam");
        }
    }


    //マイチームの部門チーム編集ページ表示
    public function child(Request $request)
    {
        $child_id = $request->child;
        $child = Child::find($child_id);
        $users = $child->users;

        return view("newproject.myteamChild", [
            "child" => $child,
            "users" => $users,
        ]);
    }

    //マイチームの部門チーム編集情報を取得
    public function childchange(Request $request)
    {

        $child_id = $request->child;
        $child = Child::find($child_id);

        //リーダー交代
        if (isset($request->leader)) {
            $users = $child->users;
            foreach ($users as $value) {
                if ($value->leader == "0") {
                    $user = $value;
                }
            }
            $user->leader = null;
            $user->save();

            $leader_id = $request->leader;
            $leader = User::find($leader_id);
            $leader->leader = 0;
            $leader->save();

            return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
        }

        //脱退させる
        if (isset($request->leave)) {
            $user_id = $request->leave;

            $user = User::find($user_id);
            $user->child_id = null;
            $user->save();

            return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
        }

        //メンバー追加
        //ユーザーがいるかどうか、ユーザーがチームに所属しているかどうかはバリデーションで判断する

        if (isset($request->add_member)) {

            $add_member = $request->add_member;

            $team_id = Auth::user()->team_id;


            $member = User::where('user_name', $add_member)->first();

            if (isset($member->leader)) {
                $member->leader = null;

                if (isset($member->child->users[0])) {
                    $member->child->users[0]->leader = 0;
                }
            }
            if (isset($member->child_id)) {
                $member->child_id = null;
            }
            $member->team_id = $team_id;
            $member->save();

            return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
        }

        $child->name = $request->name;
        $child->mail = $request->mail;
        $child->top = $request->top;
        $child->description = $request->description;
        $child->save();

        return redirect("/myteam");
    }
}
