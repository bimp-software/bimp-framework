<?php

class Router{

    private $url = [];

    public function __construct(){
        $this->filter_url();
    }

    /**
     * Metodo para filtrar y descomponer los elementos de nuetra url y uri
     * @return void
     */
    private function filter_url(){
        if(isset($_GET['uri'])){
            $this->url = $_GET['uri'];
            $this->url = rtrim($this->url, '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/',strtolower($this->url));
            return $this->url;
        }
    }

    /**
     * Metodo para ejecutar y cargar de forma automatica el controlador solicitado por el usuario 
     * su metodo y pasar parametros a el.
     * @return void
     */
    public function dispatch(){
        //Controlador
        if(isset($this->url[0])){
            $current_controller = $this->url[0];
            unset($this->url[0]);
        }else{
            $current_controller = DEFAULT_CONTROLLER; //home
        }

        //Ejecucion del controlador
        $controller = $current_controller.'Controller'; //homeController
        if(!class_exists($controller)){
            $current_controller = DEFAULT_ERROR_CONTROLLER;
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller';//errorController
        }

        //Ejecucion del metodo solicitado
        if(isset($this->url[1])){
            $method = str_replace('-','_',$this->url[1]);

            //Existe o no el metodo dentro de la clase a ejecutar (controlador)
            if(!method_exists($controller, $method)){
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller';//errorController
                $current_method = DEFAULT_METHOD; // index
                $current_controller = DEFAULT_ERROR_CONTROLLER;
            }else{
                $current_method = $method;
            }

            unset($this->url[1]);
        }else{
            $current_method = DEFAULT_METHOD;
        }

        //Creando constantes para utilizar mas adelante
        define('CONTROLLER',$current_controller);
        define('METHOD',$current_method);

        //Ejecutandop controlador y el metodo segun se haga la peticion
        $controller = new $controller;

        //Obteniendo los parametros de la URI
        $params = array_values(empty($this->url) ? [] : $this->url);
        
        //Llamada al metodo que solicita el usuario en curso
        if(empty($params)){
            call_user_func([$controller, $current_method]);
        }else{
            call_user_func_array([$controller, $current_method], $params);
        }
    }

}