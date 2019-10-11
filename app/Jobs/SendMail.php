<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $title;
    protected $body;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email, $title, $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('ok89.bado@gmail.com')->send(new Contact($this->name, $this->email, $this->title, $this->body));
    }
}
