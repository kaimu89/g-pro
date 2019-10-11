<?php


Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');

Route::get("/json", "ProjectController@json");

Route::get("/jsontry", "ProjectController@jsontry");
Route::get("/try", "ProjectController@show")->name('try');

Route::post("/try", "ProjectController@create");


Route::get("/try3", "ProjectController@more")->name('try3');

Route::get("/", "ProjectController@index")->name("routeIndex");

Route::get("/team", "TeamController@show")->name("routeTeam");
Route::get("/team/explain/{id}", "TeamController@explain")->name("routeExplain");
Route::get("/team/back", "TeamController@back")->name("routeTeamBack");

Route::get("/team/explain", "TeamController@explain");

Route::get("/game", "GameController@show")->name("routeGame");

Route::get("/player", "PlayerController@show")->name("routePlayer");

Route::get("/findteam", "FindTeamController@show")->name("routeFindTeam");

Route::get("/contact", "ContactController@show")->name("routeContact");
Route::post("/contact/confirm", "ContactController@contact")->name("routeConfirm");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::post("/findteam", "FindTeamController@oubo");

    Route::post("/player", "PlayerController@scout");

    Route::get("/add/player", "AddPlayerController@show")->name("routeAddPlayer")->middleware('playerregister');
    Route::post("/add/player", "AddPlayerController@create");

    Route::get("/add/team", "AddTeamController@show")->name("routeAddTeam")->middleware('teamregister');
    Route::post("/add/team", "AddTeamController@create");

    Route::get("/add/pro", "AddTeamController@pro")->name("routeAddPro");
    Route::post("/add/pro", "AddTeamController@addPro");

    Route::get("/recruit/team/pro", "RecruitTeamProController@show")->name("routeRecruitTeamPro")->middleware('prorecruit');
    Route::post("/recruit/team/pro", "RecruitTeamProController@create");

    Route::get("/recruit/team/gene", "RecruitTeamAmaController@show")->name("routeRecruitTeamAma")->middleware('amarecruit');
    Route::post("/recruit/team/gene", "RecruitTeamAmaController@create");


    Route::get("/recruit/staff", "RecruitStaffController@show")->name("routeRecruitStaff")->middleware('staffrecruit');
    Route::post("/recruit/staff", "RecruitStaffController@create");

    Route::get("/profile", "ProfileController@show")->name("routeProfile");

    Route::get("/profile/edit", "ProfileController@input")->name("routeProfileEdit");
    Route::post("/profile/edit", "ProfileController@change");

    Route::get("/profile/email", "ProfileController@email")->name("routeProfileEmail");
    Route::post("/profile/email", "ProfileController@emailchange");

    Route::get("/profile/password", "ProfileController@password")->name("routeProfilePassword");
    Route::post("/profile/password", "ProfileController@passwordchange");


    Route::get("/myteam", "MyTeamShowController@show")->name("routeMyTeam")->middleware('myteamshow');
    Route::post("/myteam", "MyTeamShowController@change");

    Route::get("/myteam/notice", "MyTeamNoticeController@show")->name("routeMyTeamNotice");
    Route::post("/myteam/notice", "MyTeamNoticeController@reject");

    Route::get("/myteam/edit", "MyTeamEditController@show")->name("routeMyTeamEdit")->middleware('myteamedit');
    Route::post("/myteam/edit", "MyTeamEditController@change");

    Route::get("/myteam/member", "MyTeamMemberController@show")->name("routeMyTeamMember")->middleware('myteamedit');
    Route::post("/myteam/member", "MyTeamMemberController@change");

    Route::get("/myteam/child/{child}", "MyTeamChildController@show")->name("routeMyTeamChild");
    Route::post("/myteam/child/{child}", "MyTeamChildController@change");

    Route::get("/myteam/recruit/{recruit}", "MyTeamRecruitController@show")->name("routeMyTeamRecruit")->middleware('myteamedit');
    Route::post("/myteam/recruit/{recruit}", "MyTeamRecruitController@change");

    Route::get("/myplayer", "MyPlayerController@show")->name("routeMyPlayer")->middleware('myplayer');

    Route::get("/myplayer/notice", "MyPlayerNoticeController@show")->name("routeMyPlayerNotice");

    Route::get("/myplayer/edit", "MyPlayerController@input")->name("routeMyPlayerEdit")->middleware('myplayer');
    Route::post("/myplayer/edit", "MyPlayerController@change");
});

Route::get("/re", function () {
    function i($value)
    {
        echo $value;
    }
    function f($value)
    {
        print_r($value);
    }
});
