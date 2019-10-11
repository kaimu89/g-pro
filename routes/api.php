<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/taken', function () {
    return csrf_token();
});

Route::get('/reflesh-token', function (Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});

Route::get("/item", "ItemController@item")->name("item");
Route::get("/item/team", "ItemController@team");

Route::get("/option", "OptionController@option")->name("option");

Route::get("/team", "TeamController@show")->name("routeTeam");

Route::get("/game", "GameController@show")->name("routeGame");

Route::get("/player", "PlayerController@show")->name("routePlayer");
Route::post("/player", "PlayerController@scout");

Route::get("/findteam", "FindTeamController@show")->name("routeFindTeam");

Route::get("/add/player", "AddPlayerController@show")->name("routeAddPlayer");
Route::post("/add/player", "AddPlayerController@create");

Route::get("/add/team", "AddTeamController@show")->name("routeAddTeam");
Route::post("/add/team", "AddTeamController@create");
Route::post("/add/team/file", "AddTeamController@file");

Route::get("/add/pro", "AddTeamController@pro")->name("routeAddPro");
Route::post("/add/pro", "AddTeamController@addPro");

Route::get("/recruit/team/gene", "RecruitTeamAmaController@show")->name("routeRecruitTeamAma");
Route::post("/recruit/team/gene", "RecruitTeamAmaController@create");

Route::get("/recruit/team/pro", "RecruitTeamProController@show")->name("routeRecruitTeamPro");
Route::post("/recruit/team/pro", "RecruitTeamProController@create");

Route::get("/recruit/staff", "RecruitStaffController@show")->name("routeRecruitStaff");
Route::post("/recruit/staff", "RecruitStaffController@create");

Route::get("/profile", "ProfileController@show")->name("routeProfile");
Route::post("/profile/edit", "ProfileController@change");
Route::post("/profile/email", "ProfileController@emailchange");

Route::get("/myteam", "MyTeamShowController@show")->name("routeMyTeam");
Route::post("/myteam", "MyTeamShowController@change");

Route::get("/myteam/child/{child}", "MyTeamChildController@show")->name("routeMyTeamChild");

Route::post("/myteam/child/change/{child}", "MyTeamChildController@change");
Route::post("/myteam/child/breakup/{child}", "MyTeamChildController@breakUp");
Route::post("/myteam/child/edit/{child}", "MyTeamChildController@edit");
Route::post("/myteam/child/leader/{child}", "MyTeamChildController@leader");
Route::post("/myteam/child/add/{child}", "MyTeamChildController@member");
Route::post("/myteam/child/leave/{child}", "MyTeamChildController@leave");

Route::post("/myteam/edit", "MyTeamEditController@change");

Route::post("/myteam/member/leader", "MyTeamMemController@leader");
Route::post("/myteam/member/edit", "MyTeamMemController@leave");
Route::post("/myteam/member/add", "MyTeamMemController@member");

Route::get("/myteam/recruit/{recruit}", "MyTeamRecruitController@show")->name("routeMyTeamRecruit");
Route::post("/myteam/recruit/{recruit}", "MyTeamRecruitController@change");

Route::get("/myplayer", "MyPlayerController@show")->name("routeMyPlayer");
Route::post("/myplayer/edit", "MyPlayerController@change");


Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/contact', 'ContactController@contact')->name('logout');

Route::get('/user', function () {

    return Auth::user() ? Auth::user()->load([
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
    ]) : Auth::user();
    // if (!!Auth::user()) {
    //     return Auth::user()->load(['player.game', 'player.position', 'player.rank']);
    // } else {
    //     return Auth::user();
    // }
})->name('user');
