<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTeamChildLogController extends Controller
{
    //マイチームの部門チーム編集ページ表示
    public function show(Request $request)
    {
        $child_id = $request->child;
        $child = Child::find($child_id)->load('teamgame.game');
        $users = $child->users;

        return [
            "child" => $child,
            "users" => $users,
        ];
    }

    //マイチームの部門チーム編集情報を取得
    public function change(Request $request)
    {
        $child_id = $request->child;
        $child = Child::find($child_id);

        //解散させる
        if (isset($request->disband)) {

            if (isset($child->users[0])) {
                foreach ($child->users as $us) {
                    if ($us->leader == '0') {
                        $user = $us;
                        $user->leader = null;
                        $user->save();
                    }
                }
            }

            $child->delete();

            return redirect('/myteam');
        }

        //脱退させる
        if (isset($request->leave)) {
            $user_id = $request->leave;
            $user = User::find($user_id);

            if ($user->leader == '0') {
                $user->leader = null;

                $bye_child = $user->child;

                $user->child_id = null;
                $user->save();

                if (isset($bye_child->users[0])) {
                    $bye_child->users[0]->leader = '0';
                    $bye_child->users[0]->save();
                }
            }

            $user->child_id = null;
            $user->save();

            return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
        }

        //このようにしてメソッドを分岐できる。
        //メソッドを呼び出すときは、$this->ﾒｿｯﾄﾞで出来る。
        if (isset($request->btn_leader)) {
            $this->leader($request, $child);

            if ($this->leader($request, $child)) {
                return $this->leader($request, $child);
            }

            //leader()のなかにreturnをしても効かない こっちに書く
            //チームリーダーならページはそのまま
            if (isset(Auth::user()->team_id)) {
                return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
                //childリーダーならリーダー変更後トップページに
            } elseif (isset(Auth::user()->child_id)) {
                return redirect('/myteam');
            }
        } elseif (isset($request->btn_member)) {
            $this->member($request, $child);

            if ($this->member($request, $child)) {
                return $this->member($request, $child);
            }

            //member()のなかにreturnをしても効かない こっちに書く
            return redirect()->route('routeMyTeamChild', ['child' => $child->id]);
        } elseif (isset($request->change)) {
            $this->info($request, $child);

            if ($this->info($request, $child)) {
                return $this->info($request, $child);
            }

            //member()のなかにreturnをしても効かない こっちに書く
            return redirect('/myteam');
        }
    }



    public function info(Request $request, $child)
    {
        //ok
        $rules = [
            'name' => ['required', 'string', 'max:50', 'unique:teams,name', Rule::unique('children')->ignore($child->id)],
            'mail' => ['required', 'email', 'max:255',],
            'top' => ['required', 'string', 'max:50',],
            'description' => ['nullable', 'string',],
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('routeMyTeamChild', ['child' => $child->id])->withErrors($validator)->withInput();
        }

        $child->name = $request->name;
        $child->mail = $request->mail;
        $child->top = $request->top;
        $child->description = $request->description;
        $child->save();
    }



    public function leader(Request $request, $child)
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

            return redirect()->route('routeMyTeamChild', ['child' => $child->id])->withErrors($validator)->withInput();
        }

        //リーダー交代
        if (Auth::user()->leader == '0') {
            $users = $child->users;
            foreach ($users as $us) {
                if ($us->leader == "0") {
                    $user = $us;
                }
            }
            $user->leader = null;
            $user->save();

            $leader_id = $request->leader;
            $leader = User::find($leader_id);
            $leader->leader = '0';
            $leader->save();
        }
    }

    public function member(Request $request, $child)
    {
        //メンバー追加
        //ユーザーがいるかどうか、ユーザーがチームに所属しているかどうかはバリデーションで判断する
        //childに参加出来るのは、無所属とchildの親チームのメンバーのみとする。
        //childの親チームをメンバーに出来るのは、チームリーダーのみとする。
        //つまりchildリーダーは無所属だけを追加できるとする。

        //ok
        $rules = [
            "add_member" => [
                'required',
                'exists:users,user_name',
                function ($attribute, $value, $fail) {
                    $member = User::where('user_name', $value)->first();
                    if (isset(Auth::user()->team_id)) {
                        if (isset($member->team_id) && $member->team_id != Auth::user()->team_id) {
                            return $fail('既に他のチームに所属しています。');
                        }
                        if (isset($member->child_id) && $member->child->team->id != Auth::user()->team_id) {
                            return $fail('既に他のチームの部門に所属しています。');
                        }
                        if (isset($member->child_id) && $member->child->team->id == Auth::user()->team_id) {
                            return $fail('既にチームの部門に所属しています。');
                        }
                    }
                    if (isset(Auth::user()->child_id)) {
                        if (isset($member->team_id) && $member->team_id == Auth::user()->child->team->id) {
                            return $fail('部門にチームメンバーを追加できるのはチームリーダーのみです。');
                        }

                        if (isset($member->team_id) && $member->team_id != Auth::user()->child->team->id) {
                            return $fail('既に他のチームに所属しています。');
                        }

                        if (isset($member->child_id) && $member->child_id != Auth::user()->child_id) {
                            return $fail('既に他の部門に所属しています。');
                        }
                        if (isset($member->child_id) && $member->child_id == Auth::user()->child_id) {
                            return $fail('既にこの部門に所属しています。');
                        }
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
            return redirect()->route('routeMyTeamChild', ['child' => $child->id])->withErrors($validator)->withInput();
        }





        //$request->add_memberはユーザー名
        $add_member = $request->add_member;
        $member = User::where('user_name', $add_member)->first();

        if (isset($member->team_id)) {
            $member->team_id = null;
            $member->child_id = $child->id;
            $member->save();
        }

        if (!isset($child->users[0])) {
            $member->leader = '0';
        }

        $member->child_id = $child->id;
        $member->save();
    }
}
