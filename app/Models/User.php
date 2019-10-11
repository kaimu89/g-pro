<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\belongTeam;
use App\Traits\hasOnePlayer;
use App\Traits\belongChild;
use App\Traits\hasManyScoutTeam;
use App\Traits\hasManyScoutUser;

class User extends Authenticatable
{
    use Notifiable;

    use belongTeam;
    use hasOnePlayer;
    use belongChild;

    use hasManyScoutTeam;
    use hasManyScoutUser;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    // protected $fillable = [
    //     'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
