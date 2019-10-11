<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileEditRequest;
use App\Http\Requests\ProfileEmailRequest;
use App\Http\Requests\ProfilePasswordRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return [
            "user" => $this->user,
            "games" => $this->games,
        ];
    }

    public function input()
    {

        for ($i = 2019; $i >= 1980; $i--) {
            $years[] = $i;
        }

        for ($i = 1; $i <= 12; $i++) {
            $months[] = $i;
        }

        for ($i = 1; $i <= 31; $i++) {
            $days[] = $i;
        }

        return view("newproject.profileEdit", [
            "user" => $this->user,
            "years" => $years,
            "months" => $months,
            "days" => $days,
        ]);
    }

    public function change(ProfileEditRequest $request)
    {
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->gender = $request->gender;
        $user->twitter = $request->twitter;
        $user->birthday = $request->birthday;
        $user->save();

        return $user;
    }

    public function email()
    {
        $user = Auth::user();

        return view("newproject.profileEmail", [
            "user" => $user,
        ]);
    }

    public function emailchange(ProfileEmailRequest $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function password()
    {
        return view("newproject.profilePassword", []);
    }

    public function passwordchange(ProfilePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();


        return $user;
    }
}
