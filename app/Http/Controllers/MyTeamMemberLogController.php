<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

//これは元々MyTeamMemberControllerである
//vue.jsを入れる事で使わなくなったため名前にLogを入れて記念に残す。
//formの中にformがある際にこのようにメソッドを分岐してたためこのような
//書き方になっている。しかしvueの場合それはいらないためこのファイルは使わなくなった
//vueを使うためのファイルを新たに作ったが、このファイルは貴重なため残す。

class MyTeamMemberLogController extends Controller
{
    //メンバー変更ページ表示
    public function show(Request $request)
    {
        $users = Auth::user()->team->users;

        return view("newproject.myteamMember", [
            "users" => $users,
        ]);
    }

    public function change(Request $request)
    {
        //脱退させる
        if (isset($request->leave)) {
            $user_id = $request->leave;

            $user = User::find($user_id);
            $user->team_id = null;
            $user->save();

            return redirect('/myteam/member');
        }

        //このようにしてメソッドを分岐できる。
        //メソッドを呼び出すときは、$this->ﾒｿｯﾄﾞで出来る。
        if (isset($request->btn_leader)) {
            $this->leader($request);

            //returnしたものはこっちで受け取るのでここからreturnするにはこっちにreturnされたものをreturnしてあげること
            if ($this->leader($request)) {
                return $this->leader($request);
            };

            //leader()のなかにreturnをしても効かない こっちに書く
            return redirect('/myteam');
        } elseif (isset($request->btn_member)) {
            $this->member($request);

            //returnしたものはこっちで受け取るのでここからreturnするにはこっちにreturnされたものをreturnしてあげること
            if ($this->member($request)) {
                return $this->member($request);
            };

            //member()のなかにreturnをしても効かない こっちに書く
            return redirect('/myteam/member');
        }
    }


    //メンバー変更情報取得
    public function leader(Request $request)
    {

        //ok
        $rules = [
            "leader" => ['required', 'exists:users,id',],
        ];
        $messages = [
            'leader.required' => 'メンバーをいずれか選択して下さい',
            'leader.exists' => '登録されているユーザーから選んで下さい',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect('/myteam/member')->withErrors($validator)->withInput();
        }

        //リーダー交代
        //選択したプレイヤーにリーダー０をつける。
        $leader_id = $request->leader;
        $leader = User::find($leader_id);
        $leader->leader = 0;
        $leader->save();
        //自分のリーダーをnullにする。
        $user = Auth::user();
        $user->leader = null;
        $user->save();
    }

    public function member(Request $request)
    {
        //メンバー招待
        //招待出来るのは無所属とchildのみとする。
        //ユーザーがいるかどうか、ユーザーがチームに所属しているかどうかはバリデーションで判断する

        //ok
        $rules = [
            "add_member" => [
                'required',
                'exists:users,user_name',
                function ($attribute, $value, $fail) {
                    $member = User::where('user_name', $value)->first();

                    if (isset($member->team_id) && $member->team_id == Auth::user()->team_id) {
                        return $fail('既にチームに所属しています。');
                    }

                    if (isset($member->team_id) && $member->team_id != Auth::user()->team_id) {
                        return $fail('既に他のチームに所属しています。');
                    }
                    if (isset($member->child_id) && $member->child->team->id != Auth::user()->team_id) {
                        return $fail("既に他のチームの部門に所属しています。");
                    }
                }
            ],
        ];

        $messages = [
            'add_member.required' => 'ユーザー名を入力して下さい',
            'add_member.exists' => 'そのユーザー名は登録されてません'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect('/myteam/member')->withErrors($validator)->withInput();
        }


        //ユーザー名
        $add_member = $request->add_member;
        //ユーザー名に関連したユーザー
        $member = User::where('user_name', $add_member)->first();

        $user = Auth::user();

        //チームid
        $team_id = $user->team_id;

        //childに所属しているか
        if (isset($member->child_id)) {
            //childのリーダーだったら取り消す。
            if (isset($member->leader)) {
                $member->leader = null;
                //他のchildのプレイヤーにリーダーを渡す。
                if (isset($member->child->users[0])) {
                    $member->child->users[0]->leader = 0;
                    $member->child->users[0]->save();
                }
            }
            $member->child_id = null;
        }

        //そしてチームに所属する。
        $member->team_id = $team_id;
        $member->save();
    }
}
