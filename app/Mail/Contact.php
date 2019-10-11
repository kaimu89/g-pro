<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $title;
    protected $body;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->email);
        return $this
            ->subject($this->title)
            ->with([
                "name" => $this->name,
                "body" => $this->body,
            ])
            ->view('mail');
    }
}
