<?php 

class Servicios{

    private $method_of_payment = ['Webpay',
                                  'Paypal',
                                  'Mercado Pago',
                                  'VentiPay',
                                  'Flow',
                                  'PayU',
                                  'Transferencia',
                                  'One Pay',
                                  'Stripe',
                                  'Skrill',
                                  'Pago Facil',
                                  'JumpSeller'];
    private $dependencies = ['Webpay' => 'webpay/webpay-plus-sdk',
                             'Paypal' => 'paypal/rest-api-sdk-php',
                             'Mercado Pago' => 'mercadopago/dx-php',
                             'VentiPay' => 'stripe/stripe-php',
                             'Flow' => 'skrill/skrill-api',
                             'PayU' => '',
                             'One Pay' => '',
                             'Stripe' => '',
                             'Skrill' => '',
                             'Pago Facil' => '',
                             'JumpSeller' => ''];

    private $method_default = 'Transferencia';
    private $config = [];
    private $type_enviroment = AMBIENTE_PAGO; //Esta puede variar dependiendo el metodo de pago

    
    
    public function __construct($selected_method, $config = []){
        //Comprobar si existe el metodo de pago seleccionado
        if(in_array($selected_method, $this->method_of_payment)){
            if(isset($this->dependencies[$selected_method])){
                $this->installDependencies($this->dependencies[$selected_method]);
            }else{
                die(sprintf('No hay dependencia configurada para el metodo de pago: %s', $selected_method));
            }
        }else{
            die(sprintf('Metodo de pago no reconocido: %s', $selected_method));
        }
    }

    function installDependencies($package){
        if(!$this->isPackageIntall($package)){
            echo sprintf("instalando paquete: %s ",$package).PHP_EOL;
            exec(sprintf('composer require %s',$package));
        }else{
            echo sprintf("El paquete %s ya esta instalado. \n",$package).PHP_EOL;
        }
    }

    function isPackageIntall($package){
        $output = [];
        exec(sprintf('composer show %s',$package),$output);

        foreach($output as $line){
            if(strpos($line, $package) !== false){
                return true;
            }
        }
        return false;
    }

    function checkDependencies(){
        
    }

}