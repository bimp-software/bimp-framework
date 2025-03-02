<?php

class Bimp{

    /**
     * Nombre del framework
     * @var string
     */
    private $framework = 'Bimp Framework';

    /**
     * Versión del framework
     * @var string
     */
    private $version = '1.1.1';

    /**
     * Idioma predeterminado
     * @var string
     */
    private $lng = 'es';

    /**
     * URL procesada
     * @var array
     */
    private $url = [];

    /**
     * Determina si Composer será utilizado
     * @var bool
     */
    private $use_composer = true;

    /**
     * Entorno de ejecucion (Desarrollo o produccion)
     * @var string
     */
    private $environment = 'desarrollo'; //desarrollo o produccion

    /**
     * Constructor principal
     * Se ejecuta al instanciar la clase
     */    
    function __construct(){
        try {
            $this->init();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Metodo para ejecutar cada metodo  de forma subsecuente
     * @return void
     */
    
    private function init(){

        // Cargar funciones antes de establecer el entorno
        //$this->init_environment();
        
        //Configuracion del entorno de ejecucion        
        $this->init_session();
        $this->init_load_config();
        $this->init_load_function();
        $this->init_load_composer();
        $this->init_autoload();
        $this->init_globals();
        $this->init_csrf();
        $this->init_custom();

        $this->getRouter();
    }

    /**
     * 
     */
    private function init_environment(){
        $environment_validate = ['desarrollo','produccion','testing','staging'];

        if(!in_array($this->environment, $environment_validate)){
            throw new Exception('Entorno no valido: '.$this->environment);
        }


        if($this->environment == 'desarrollo'){
            error_reporting(E_ALL);
            //logger('Entorno de desarrollo activo','info',false);
        }else{
            error_reporting(0);
            //logger('Entorno de produccion activo','info',false);
        }
    }

    /**
     * Metodo para iniciar la sesion en el sistema
     * @return void
     */
    private function init_session(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return;
    }

     /**
     * Carga archivos de configuración del sistema
     * @return void
     * @throws Exception
     */
    private function init_load_config(){

        $config_file = [
            'app/config/bimp_config.php',
            'app/core/settings.php'
        ];

        foreach($config_file as $file){
            if(!is_file($file)){
                die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.',$file, $this->framework));
            }
            require_once $file;
        }

        return;
    }

    /**
     * Carga funciones del sistema y del usuario
     * @return void
     * @throws Exception
     */
    private function init_load_function(){
        $file = 'bimp_core_functions.php';
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.',$file, $this->framework));
        }

        //Cargando el archivo de funciones core
        require_once FUNCTIONS.$file;

        $file = 'bimp_custom_functions.php';
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.',$file, $this->framework));
        }

        //Cargando el archivo de funciones custom
        require_once FUNCTIONS.$file;
        
        return;
    }

    /**
     * Inicializa Composer si está habilitado
     * @return void
     * @throws Exception
     */
    private function init_load_composer() {
        if(!$this->use_composer){
            return;
        }

        $file = LIBS.'vendor'.DS.'autoload.php';
        if(!is_file($file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', $file, $this->framework));
        }

        require_once $file;

        return;
    }

    /**
     * Carga de clases de forma automática
     * @return void
     */
    private function init_autoload(){
        require_once CLASSES.'Autoloader.php';
        Autoloader::init();
        return;
    }

    /**
     * Inicializa el token CSRF para la sesión del usuario
     * @return void
     */
    private function init_csrf(){
        $csrf = new Csrf();
        define('CSRF_TOKEN', $csrf->get_token());
    }

    /**
     * Inicializa variables globales del sistema
     * @return void
     */
    private function init_globals(){
        //Objeto Bimp que sera insertado en el footer como script javascript dinamico para facil acceso.
    }

    /**
     * Carga procesos personalizados del sistema o aplicación
     * @return void
     */
    private function init_custom() {
        // Inicializar procesos personalizados del sistema o aplicación
        $file = 'Transbank.php';
        if(!is_file(CLASSES.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.',$file, $this->framework));
        }

        //Cargando el archivo de funciones custom
        require_once CLASSES.$file;
    }

    /**
     * Inicializa el enrutador y despacha las rutas
     * @return void
     */
    private function getRouter(){
        $router = new Router();
        $router->dispatch();
    }
    
    /**
     * Método estático para ejecutar el framework
     * @return void
     */
    public static function run(){
        $bimp = new self();
        return;
    }
}