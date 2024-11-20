<?php

namespace App\Mail;

use App\Models\Empresa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaEmpresaMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $empresa;

    /**
     * Cria uma nova instância do e-mail.
     */
    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * Constrói a mensagem.
     */
    public function build()
    {
        return $this->subject('Nova Empresa Criada')
                    ->view('emails.nova_empresa');
    }
}
