<?php

class Csrf{

    private $length = 32; //Longitud de nuestro token
    private $token; //token
    private $token_expiration; // Tiempo de expiracion
    private $expiration_time = 60 * 5; // 5 minutos de expiracion

    //Crear nuestro token si no existe y es el primer ingreso al sitio
    public function __construct(){
        if(!isset($_SESSION['csrf_token'])){
            $this->generate();
            $_SESSION['csrf_token'] = [
                'token' => $this->token,
                'expiration' => $this->token_expiration
            ];
            return $this;
        }

        $this->token = $_SESSION['csrf_token']['token'];
        $this->token_expiration = $_SESSION['csrf_token']['expiration'];
        
        return $this;
    }

    /**
     * Metodo para generar un nuevo token
     * @return void
     */
    private function generate(){
        if(function_exists('bin2hex')){
            $this->token = bin2hex(random_bytes($this->length));
        }elseif(function_exists('mcrypt_create_iv')){
            $this->token = bin2hex(mcrypt_create_iv($this->length, MCRYPT_DEV_URANDOM));
        }else{
            $this->token = bin2hex(openssl_random_pseudo_bytes($this->length));
        }

        $this->token_expiration = time() + $this->expiration_time;
        return $this;
    }

    /**
     * Validar el token de la peticion con el del sistema
     * @param string $csrf_token
     * @param boolean $validate_expiration
     * @return void;
     */
    public static function validate($csrf_token, $validate_expiration = false){
        $self = new self();

        //Validando el tiempo de expiracion del token
        if($validate_expiration && $self->get_expiration() < time()){
            return false;
        }

        if($csrf_token !== $self->get_token()){
            return false;
        }

        return true;
    }

    /**
     * Metodo para obtener el token
     * @return void
     */
    public function get_token(){
        return $this->token;
    } 

    /**
     * Metodo para obtener la expiracion del token
     * @return void
     */
    public function get_expiration(){
        return $this->token_expiration;
    }

}