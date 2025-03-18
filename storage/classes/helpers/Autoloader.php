<?php

namespace Bimp\Framework\Helpers;

class Autoloader {

    /**
     * Metodo encargado de ejecutar el autocargador de forma estatica
     * @return void
     */
    public static function init() : void {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($class){
        $class = str_replace('Bimp\\Framework\\','', $class);
        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

        $path = [
            APP,
            ASSETS,
            CONFIG,
            DATABASE,
            DOCS,
            PUBLICO,
            RESOURCES,
            STORAGE,

            //CARPETAS DE APP
            CONTROLLERS,
            MODELS,
            PROVIDERS,

            /* SubCarpetas de ASSETS */
            FAVICON,
            FONT,
            IMG,
            PLUGINS,
            UPLOAD,

            //CARPETAS DE DATABASE
            FACTORIES,
            MIGRATIONS,
            SEEDERS,

            //CARPETAS DE RESOURCES
            CSS,
            JS,
            VIEW,
            INCLUDES,
            
            //CARPETA DE STORAGE
            CLASSES,
            CORE,
            FUNCTIONS,
            LIBS,
            SETTINGS,

            //SUBCARPETAS DE CLASSES
            API,
            AUTH,
            CACHE,
            CONSOLE,
            COOKIES,
            DB,
            FLASHER,
            HELPERS,
            INTERFACES,
            MAIL,
            MAKE,
            MODULES,
            REDIRECT,
            ROUTER,
            SECURITY,
            SERVER,
            SERVICES,

            //SUBCARPETAS DE DB
            CMD,
            CONNECTORS,
            MIGRATION,
            QUERY,
            SCHEMA,
        ];

        foreach($path as $dir){
            $file = $dir . $class . '.php';

            if(file_exists($file)){
                require_once $file;
                return;
            }
        }
    }
}