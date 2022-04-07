<?php

namespace App\Mail;

use App\Models\Requisicao_documento;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaFichaGerada extends Mailable
{
    use Queueable, SerializesModels;

    private $usuario;
    private $documento;

    public function __construct(User $usuario, Requisicao_documento $documento)
    {
        $this->usuario = $usuario;
        $this->documento = $documento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $documento = $this->documento;
        $usuario = $this->usuario;
        $this->subject("Atualização no status da ficha catalográfica.");
        $this->to($usuario);
        return $this->view('mails.alerta_ficha_aluno', compact("usuario", "documento"));
    }
}
