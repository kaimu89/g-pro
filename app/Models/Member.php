<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\belongStaff;

class Member extends Model
{
    protected $table = 'memberes';

    use belongStaff;
}
