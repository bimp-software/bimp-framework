<?php 

class Transbank extends Servicios{

    private $method_selected = ['Webpay', 'One Pay'];
    private $config = [];
    private $webpay;

    function __construct($selected_method, $config = [], $ambiente){
        parent::__construct($selected_method, $config);

        if(in_array($selected_method, $this->method_selected)){
            $this->config = $config;

            if($selected_method === 'Webpay'){
                $this->type_enviroment = "prueba";
                $this->init($selected_method);
            }
        }else{
            die(sprintf('Metodo de pago no soportado por Transbank: %s', $selected_method));
        }
    }

    private function init($method){
        if($this->type_enviroment == "prueba"){
            if($method == "Webpay"){

            }elseif($method == "One Pay"){

            }else{
                die(sprintf("MEtodo de pago no esta en lo seleccionado. intenta nuevamente %s", $method));
            }
        }
    }

    private function prueba(){

    }

    /*
    private function init(){
        try {
            if(!$this->isPackageIntall('webpay/webpay-plus-sdk')){
                die('La librería de Webpay no está instalada. Asegúrate de que se haya ejecutado composer para instalar las dependencias.');
            }
    
            if(!class_exists('Transbank\Webpay\WebpayPlus\Transaction')){
                require_once LIBS.'/vendor/autoload.php';
            }
    
            if(!class_exists('Transbank\Webpay\WebpayPlus\Transaction')){
                throw new Exception('No se pudo cargar la clase WebpayPlus Transaction. Verifica la instalación de la librería.');
            }
    
            // Cargar la configuración específica para Webpay
            $webpayConfig = array_merge([
                'commerce_code' => 'TUS_COMMERCE_CODE',
                'api_key' => 'TUS_API_KEY',
                'environment' => 'INTEGRACION' // Puede ser 'PRODUCCION' para entornos reales
            ], $this->config);
    
            $this->webpay = new Transbank\Webpay\WebpayPlus\Transaction();
    
            echo "Webpay inicializado correctamente." . PHP_EOL;
        } catch (Exception $e) {
            die(sprintf("Error al inicializar Webpay: %s", $e->getMessage()));
        }
    }
    */
    public function create($buy_order, $session_id, $amount, $return_url){
        try {
            if (!isset($this->webpay)) {
                throw new Exception('Webpay no está inicializado. Asegúrate de haber llamado a initializeWebpay correctamente.');
            }
    
            if (empty($buy_order) || strlen($buy_order) > 26) {
                throw new Exception('El parámetro buy_order es inválido. Debe tener un máximo de 26 caracteres.');
            }
    
            if (empty($session_id) || strlen($session_id) > 61) {
                throw new Exception('El parámetro session_id es inválido. Debe tener un máximo de 61 caracteres.');
            }
    
            if (!is_numeric($amount) || $amount <= 0 || $amount > 999999999999.99) {
                throw new Exception('El parámetro amount es inválido. Debe ser un valor decimal positivo con máximo 2 decimales.');
            }
    
            if (empty($return_url) || strlen($return_url) > 256 || !filter_var($return_url, FILTER_VALIDATE_URL)) {
                throw new Exception('El parámetro return_url es inválido. Debe ser una URL válida con un máximo de 256 caracteres.');
            }
    
            // Crear transacción con Webpay
            $response = $this->webpay->create($buy_order, $session_id, $amount, $return_url);
    
            // Validar que la respuesta contenga el token y URL de pago
            if (!isset($response->token) || !isset($response->url)) {
                throw new Exception('Error al crear la transacción. No se recibió un token o URL válida desde Webpay.');
            }
    
            // Registro de transacción exitosa
            $this->log(sprintf("Transacción creada exitosamente. Token: %s, URL de pago: %s", $response->token, $response->url));
    
            // Devolver el token y URL para redirigir al usuario
            return [
                'token' => $response->token,
                'url' => $response->url
            ];
    
        } catch (Exception $e) {
            // Manejo de errores
            $this->logError(sprintf("Error al crear la transacción Webpay: %s", $e->getMessage()));
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }



}