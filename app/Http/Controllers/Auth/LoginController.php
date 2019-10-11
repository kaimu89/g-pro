<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        return $user->load([
            'player.game',
            'player.position',
            'player.rank',
            'player.scoutusers.team',
            'team.users',
            'team.childs.users',
            'team.childs.teamgame.game',
            'team.recruits.game',
            'team.recruits.position',
            'team.recruits.rank',
            'team.recruits.staff',
            'team.teamgames.game',
            'team.scoutteams.player',
            'team.scoutteams.user',
        ]);
    }

    protected function loggedOut(Request $request)
    {
        // セッションを再生成する
        $request->session()->regenerate();

        return response()->json();
    }
}
