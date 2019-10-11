<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruit;
use App\Http\Requests\MyTeamRecruitRequest as RecruitRequest;

class MyTeamRecruitController extends Controller
{
    //マイチームの募集変更ページを表示
    public function show(Request $request, Recruit $recruit)
    {
        // $recruit_id = $request->recruit;
        // $recruit = Recruit::find($recruit_id);
        $positions = $recruit->game->positions;
        $ranks = $recruit->game->ranks;

        return $recruit->load('team');

        // return [
        //     "recruit" => $recruit->load('team'),
        //     "positions" => $positions,
        //     "ranks" => $ranks,
        // ];
    }

    //マイチームの募集変更情報を取得
    public function change(RecruitRequest $request, Recruit $recruit)
    {
        // return $request->all();

        // $recruit_id = $request->recruit;
        // $recruit = Recruit::find($recruit_id);

        if (isset($recruit->staff_id)) {
            $recruit->staff_id = $request->staff_id;
            $recruit->content = $request->content;
            $recruit->ab_skill = $request->ab_skill;
            $recruit->wel_skill = $request->wel_skill;
            $recruit->description = $request->description;
            $recruit->save();

            return 'OK';

            // return redirect("/myteam");
        }

        //正規表現を用いて年齢をつける。

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == 0) {
            $recruit->position_id = $request->position_id;

            if (preg_match('/up/', $request->rank_id)) {
                $replace = substr($request->rank_id, 0, strlen($request->rank_id) - 2);
                $recruit->rank_id = $replace;
                $recruit->rank_status = 1;
            } else {
                $recruit->rank_id = $request->rank_id;
                $recruit->rank_status = null;
            }
            $recruit->age = $request->age;
            $recruit->house = $request->house;
            $recruit->description = $request->description;
            $recruit->save();

            // return redirect("/myteam");
            return 'OK';
        }

        if (isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == 1) {
            $recruit->position_id = $request->position_id;
            $recruit->rank_id = $request->rank_id;
            $recruit->description = $request->description;
            $recruit->save();

            // return redirect("/myteam");
            return;
        }
    }
}
