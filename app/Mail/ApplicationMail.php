<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public string $tpl_html;
    public string $tpl_text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, string $template_html, string $template_text)
    {
        $this->details = $details;
        $this->tpl_html = $template_html;
        $this->tpl_text = $template_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ApplicationMail
    {
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Application Mail')
            ->view($this->tpl_html)
            ->text($this->tpl_text);
    }
}
