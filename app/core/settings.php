<?php

////////////////////////////////
// 2024 - Bimp Framework
// Archivo de configuración principal
////////////////////////////////

// Definir el uso horario o timezone del sistema
// Esto garantiza que todas las funciones de fecha y hora operen correctamente en la zona horaria deseada
date_default_timezone_set('America/Santiago');

// Configuración de desarrollo
// Cambia a 'true' si estás utilizando Prepros como servidor local
define('PREPROS', false);

// Configuración del idioma del sitio
// Se establece según la configuración del framework
define("SITE_LANG", $this->lng);

// Información del framework
// Definimos el nombre y la versión del framework provenientes de la clase principal
define('BIMP_NAME'    , $this->framework);
define('BIMP_VERSION' , $this->version);

// Información del sitio
// Se configura el nombre y versión del sitio desde la configuración del framework
define('SITE_NAME'   , 'Bimp Framework');
define('SITE_VERSION', '1.1.0');
define('SITE_LOGO'   , 'icono-bimp.png');   

// Configuración de la URL del sitio
// Detecta si el sitio está en HTTPS o HTTP y genera la URL correctamente
// También define el puerto en caso de que se use Prepros
define('PORT'       , '8848');
define('PROTOCOL'   , isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
define('HOST'       , $_SERVER['HTTP_HOST'] === 'localhost' ? (PREPROS ? 'localhost:'.PORT : 'localhost') : $_SERVER['HTTP_HOST']);
define('REQUEST_URI', $_SERVER["REQUEST_URI"]);
define('URL'        , PROTOCOL.'://'.HOST.BASEPATH);
define('CUR_PAGE'   , PROTOCOL.'://'.HOST.REQUEST_URI);

// Definición de rutas de directorios y archivos
// Se establecen constantes para facilitar la referencia a los directorios del framework

define('DS',DIRECTORY_SEPARATOR);
define('ROOT', getcwd().DS);

define('APP', ROOT.'app'.DS);
define('CLASSES', APP.'classes'.DS);
define('CONFIG', APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('FUNCTIONS', APP.'functions'.DS);
define('MODELS', APP.'models'.DS);
define('LIBS', APP.'libs'.DS);
define('LOGS', APP.'logs'.DS);

define('TEMPLATES',ROOT.'templates'.DS);
define('INCLUDES',TEMPLATES.'includes'.DS);
define('MODULES',TEMPLATES.'modules'.DS);
define('VIEWS',TEMPLATES.'views'.DS);

define('IMAGES_PATH'             , ROOT . 'assets' . DS . 'images' . DS);

// Rutas de componentes
// Se establecen rutas específicas para la ubicación de los componentes reutilizables
define('COMPONENTS', TEMPLATES.'components'.DS);

// Rutas de archivos estáticos o assets
// Se definen rutas de acceso a los archivos CSS, imágenes, JavaScript y otros recursos
define('ASSETS',URL.'assets/');
define('CSS',ASSETS.'css/');
define('FAVICON',ASSETS.'favicon/');
define('FONTS',ASSETS.'fonts/');
define('IMG',ASSETS.'images/');
define('JS',ASSETS.'js/');
define('PLUGINS',ASSETS.'plugins/');
define('UPLOADED',ASSETS.'uploads/');
define('CV',UPLOADED.'cv/');

// Rutas de almacenamiento de archivos subidos
define('UPLOADS',ROOT.'assets'.DS.'uploads'.DS);
define('CVS',ROOT.'assets'.DS.'uploads'.DS.'cv'.DS);

// Configuración de base de datos
// Se definen las credenciales de conexión para entornos de desarrollo
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'bimp');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8');

// Configuración del ambiente de pago
// Se puede cambiar a 'producción' cuando el sitio esté en producción
define('AMBIENTE_PAGO', 'prueba');

// Configuración de controladores y métodos por defecto
// Se establecen los valores predeterminados para manejar las solicitudes y errores
define('DEFAULT_CONTROLLER','home');
define('DEFAULT_ERROR_CONTROLLER','error');
define('DEFAULT_METHOD','index');
