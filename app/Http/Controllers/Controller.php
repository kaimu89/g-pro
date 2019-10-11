<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Game;
use App\Models\Staff;
use App\Models\Position;
use App\Models\Rank;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //ここに書いていく変数のルール
    //ただ表示するだけのもの。またgetとpostなど様々な場所で被ってしまうもの。


    //年齢を表示する際に使用する。
    protected $ages = [0 => "指定しない", 1 => "10代前半", 2 => "10代後半", 3 => "20代前半", 4 => "20代後半"];

    //gameの名前を表示するだけのモノ
    protected $games;

    //positionの名前を表示するだけのモノ
    protected $positions;

    //rankの名前を表示するだけのモノ
    protected $ranks;

    //staffの名前を表示するだけのもの
    protected $staffs;

    //ユーザの変数とそれに対応するコンストラクタ
    protected $user;

    function __construct()
    {
        $this->games = Game::select('id', 'name')->get();

        $this->positions = Position::select('id', 'name', 'game_id')->get();

        $this->ranks = Rank::select('id', 'name', 'game_id')->get();

        $this->staffs = Staff::select('id', 'name')->get();

        //ユーザー変数を渡すにはこのように書かないといけない。
        $this->middleware(function ($request, $next) {

            // ココに書く
            $this->user = \Auth::user();

            return $next($request);
        });
    }
}
