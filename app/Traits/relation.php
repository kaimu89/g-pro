<?php

namespace App\Traits;

trait hasManyUser
{
    public function users()
    {
        return $this->hasMany("App\Models\User");
    }
}

trait belongUser
{
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}

//
trait hasManyPlayer
{
    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }
}

trait hasOnePlayer
{
    public function player()
    {
        return $this->hasOne("App\Models\Player");
    }
}

trait belongPlayer
{
    public function player()
    {
        return $this->belongsTo("App\Models\Player");
    }
}

trait belongTeam
{
    public function team()
    {
        return $this->belongsTo("App\Models\Team");
    }
}

trait belongGame
{
    public function game()
    {
        return $this->belongsTo("App\Models\Game");
    }
}

//
trait hasManyPosition
{
    public function positions()
    {
        return $this->hasMany('App\Models\Position');
    }
}

trait belongPosition
{
    public function position()
    {
        return $this->belongsTo("App\Models\Position");
    }
}


//
trait hasManyRank
{
    public function ranks()
    {
        return $this->hasMany('App\Models\Rank');
    }
}

trait belongRank
{
    public function rank()
    {
        return $this->belongsTo("App\Models\Rank");
    }
}


trait hasManyTeamGame
{
    public function teamgames()
    {
        return $this->hasMany("App\Models\Teamgame");
    }
}

trait hasOneTeamGame
{
    public function teamgame()
    {
        return $this->hasOne("App\Models\Teamgame");
    }
}


trait hasManyRecruit
{
    public function recruits()
    {
        return $this->hasMany("App\Models\Recruit");
    }
}

trait belongRecruit
{
    public function recruit()
    {
        return $this->belongsTo("App\Models\Recruit");
    }
}


trait hasManyMember
{
    public function members()
    {
        return $this->hasMany("App\Models\Member");
    }
}

trait belongStaff
{
    public function staff()
    {
        return $this->belongsTo("App\Models\Staff");
    }
}

trait hasManyChild
{
    public function childs()
    {
        return $this->hasMany('App\Models\Child');
    }
}
trait belongChild
{
    public function child()
    {
        return $this->belongsTo("App\Models\Child");
    }
}

trait hasManyScoutTeam
{
    public function scoutteams()
    {
        return $this->hasMany('App\Models\ScoutTeam');
    }
}
// trait hasManyFromUserToTeam
// {
//     public function fromusertoteams()
//     {
//         return $this->hasMany('App\Models\FromUserToTeam');
//     }
// }

trait belongScoutTeam
{
    public function scoutteam()
    {
        return $this->belong('App\Models\ScoutTeam');
    }
}

// trait belongFromUserToTeam
// {
//     public function fromusertoteam()
//     {
//         return $this->belongsTo("App\Models\FromUserToTeam");
//     }
// }

trait hasManyScoutUser
{
    public function scoutusers()
    {
        return $this->hasMany('App\Models\ScoutUser');
    }
}

// trait hasManyFromTeamToUser
// {
//     public function fromteamtousers()
//     {
//         return $this->hasMany('App\Models\FromTeamToUser');
//     }
// }

trait belongScoutUser
{
    public function scoutuser()
    {
        return $this->belong('App\Models\ScoutUser');
    }
}

// trait belongFromTeamToUser
// {
//     public function fromteamtouser()
//     {
//         return $this->belongsTo("App\Models\FromTeamToUser");
//     }
// }
