<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecommendationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recommendations;

    public function __construct($recommendations)
    {
        $this->recommendations = $recommendations;

    }

    public function build()
    {
        return $this->subject('Ваши персонализированные рекомендации')
                    ->view('emails.recommendations');
    }
}