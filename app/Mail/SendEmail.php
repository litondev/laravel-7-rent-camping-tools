<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject;
    public $content;

    public function __construct($subject,$content)
    {
        // SUBJECT
        $this->subject = $subject;
        
        // CONTENT DALAM BENTUK HTML
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.send-email')
        ->subject(config('app.site_name').' - '.$this->subject)
        ->with([
           "content" => $this->content
        ]);    
    }
}
