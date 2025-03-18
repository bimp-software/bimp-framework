<?php

namespace Bimp\Framework;

use Dotenv\Dotenv;

use Bimp\Framework\Helpers\Autoloader;
use Bimp\Framework\Router\Routes;

class App {

    function __construct() {
        $this->init_composer();
        $this->init_var_env();
        $this->init_config();
        $this->init_autoload();
        $this->init_functions();
        $this->init_session();

        $this->init_router();
    }

    /**
     * Inicializa composer
     * @return void
     * @throws Exception
     */
    function init_composer() : void {
        $file = 'vendor/autoload.php';
        if(!is_file($file)){ die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $file)); }
        require_once $file;
        return;
    }

    /**
     * Cargar variables de entorno automaticamente
     * @return void
     * @throws Exception 
     */
    function init_var_env() : void {
        $path = dirname(__DIR__, 2);
        if(!file_exists($path.'/.env')){ die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $path)); }
        $global = Dotenv::createImmutable($path);
        $global->load();
        return;
    }

    /**
     * Cargar archivo de la configuracion del sistema 
     * @return void
     * @throws Exception
     */
    function init_config() : void {
        $file = 'storage/settings/Settings.php';
        if (!is_file($file)) { die(sprintf("Error al cargar la configuración del proyecto. %s", $file)); }
        require_once $file;
        return;
    }

    function init_functions() : void {
        $file = [ FUNCTIONS.'core_function.php', FUNCTIONS.'custom_function.php' ];
        foreach($file as $f){
            if(!is_file($f)){ die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $f)); }
            require_once $f;
        }
        return;
    }

    /**
     * Metodo para iniciar la sesion en el sistema
     * @return void
     */
    function init_session() : void {
        if(session_status() === PHP_SESSION_NONE) {
            ob_start();
            session_start();
        }
        return;
    }


    /**
     * Carga de clases de forma automatica
     * @return void
     * @throws Exception
     */
    function init_autoload() : void {
        Autoloader::init();
        return;
    }


    function init_router() : void {
        $router = new Routes();
        $router->dispatch();
    }
}
