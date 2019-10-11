<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

use App\Jobs\SendMail;

class ContactController extends Controller
{
    // public function show()
    // {

    //     return view("newproject.contact", []);
    // }

    // public function contact(ContactRequest $request)
    // {
    //     $name = $request->name;
    //     $mail = $request->mail;
    //     // $category = $request->category;
    //     $title = $request->title;
    //     $body = $request->body;

    //     return view("newproject.confirm", [
    //         "name" => $name,
    //         "mail" => $mail,
    //         // "category" => $category,
    //         "title" => $title,
    //         "body" => $body,
    //     ]);
    // }

    public function contact(ContactRequest $request)
    {
        if ($request->contact) {
            return 'OK';
        }

        if ($request->confirm) {

            $name = $request->name;
            $email = $request->email;
            $title = $request->title;
            $body = $request->body;

            // Mail::to('ok89.bado@gmail.com')->send(new Contact($name, $email, $title, $body));

            SendMail::dispatch($name, $email, $title, $body);

            return 'OK';
        }
    }
}
