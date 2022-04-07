<?php

namespace App\Mail;

use App\Models\Unidade;
use App\Models\Biblioteca;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaFichaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $biblioteca;
    private $usuarioSolicitante;
    private $unidade;


    public function __construct(Biblioteca $biblioteca, User $usuarioSolicitante, $unidade)
    {
        $this->biblioteca = $biblioteca;
        $this->usuarioSolicitante = $usuarioSolicitante;
        $this->unidade = $unidade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $biblioteca = $this->biblioteca;
        $usuarioSolicitante = $this->usuarioSolicitante;
        $unidade = $this->unidade;
        $this->subject("Alerta ficha catalográfica");
        $this->to($biblioteca->email, $biblioteca->nome);
        return $this->markdown('mails.alerta_ficha', compact("usuarioSolicitante","biblioteca", 'unidade'));
    }
}
