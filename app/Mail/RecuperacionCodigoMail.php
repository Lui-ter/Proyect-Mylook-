<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperacionCodigoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;
    public $expiraEn;

    public function __construct($codigo, $expiraEn = 5){
        $this->codigo = $codigo;
        $this->expiraEn = $expiraEn;
    }

    public function build(){
        return $this
            ->subject('Código de recuperación')
            ->view('Correo.correo');
    }

    public function attachments(): array{
        return [];
    }
}
