<?php 

namespace Bimp\Framework\Services\Payment;

use Bimp\Framework\Services\PaymentServices;

class Transferencia extends PaymentServices {
    private array $detalles;

    function __construct(array $datos){
        parent::__construct('Transferencia', '');
        $this->detalles = [
            'Banco' => $datos['Banco'] ?? 'Banco no definido',
            'Cuenta' => $datos['Cuenta'] ?? 'Cuenta no definido',
            'Titular' => $datos['Titular'] ?? 'Titular no definido',
            'RUT' => $datos['Rut'] ?? 'Rut no definido',
            'Correo' => $datos['Correo'] ?? 'Correo no definido',
        ];
    }

    public function Process(array $config): void {
        echo "Procesando pago con Webpay...\n";
    }

    public function Render(string $url): string {
        return "<div class='card' style='width: 18rem; margin: 10px;'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$this->Name()."</h5>
                        <p class='card-text'>Paga de forma segura con Webpay.</p>
                        <a href='$url' class='btn btn-primary'>Seleccionar</a>
                    </div>
                </div>";
    }

}