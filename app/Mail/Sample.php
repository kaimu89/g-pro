<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sample extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $text;

    protected $hello;
    protected $good;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($name = "test", $text = "testtest", )
    // {
    //     $this->title = sprintf('%sさん、ありがとうございます。', $name);
    //     $this->text = $text;
    // }

    public function __construct($hello, $good)
    {
        $this->hello = $hello;
        $this->good = $good;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.sample')
        //     ->text('emails.sample_plain')
        //     ->subject($this->title)
        //     ->with([
        //         'text' => $this->text,
        //     ]);

        $this->from('ok89.bado@gmail.com');
        return $this
            ->subject('登録ありがとうございます')
            ->with(["hello" => $this->hello, "good" => $this->good])
            ->view('mail');
    }
}
