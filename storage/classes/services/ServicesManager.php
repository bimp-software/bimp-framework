<?php

namespace Bimp\Framework\Services;

use Bimp\Framework\Services\Payment\Webpay;

class ServicesManager {

    private array $methods = [];
    
    function __construct(){
        $this->methods = [
            'Webpay' => new Webpay(),
        ];
    }

    public function getPayment(string $url = URL."pagar/"): string {
        $render = "<div class='d-flex flex-wrap'>";
        foreach ($this->methods as $method) {
            $render .= $method->Render($url);
        }
        $render .= "</div>";
        return $render;
    }

}