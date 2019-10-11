<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sample;

class SampleController extends Controller
{
    public function sample()
    {
        $name = 'ララベル太郎';
        $text = 'これからもよろしくお願いいたします。';
        $to = 'ok89k.o_o@yahoo.ne.jp';
        Mail::to($to)->send(new Sample($name, $text));
    }
}
