<?php 

namespace Bimp\Framework\Services\Payment;

use Bimp\Framework\Services\PaymentServices;

class Webpay extends PaymentServices {
    function __construct(){
        parent::__construct('Webpay', 'webpay/webpay-plus-sdk');
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