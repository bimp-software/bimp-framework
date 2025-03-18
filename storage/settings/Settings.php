<?php
/**
 * Saber si estamos trabajando de forma local o remoto
 */
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));
define('BASEPATH', IS_LOCAL ? $_ENV['APP_NAME'] : $_ENV['APP_URL']);

/**
 * Informacion del sitio
 * Esta es la configuracion principal del framework
 */
define('BF_NAME' , 'Bimp Framework');
define('BF_VERSION', '2.0.0');
define('BF_LOGO', 'bimp.png');

/**
 * Definición de los archivos CSS principales del framework.
 * 
 * - 'main'  → CSS base (Bootstrap, Tailwind, etc.).
 * - 'extra' → Archivos adicionales personalizados.
 *
 * @const ENGINE_CSS Lista de archivos CSS a cargar en la aplicación.
 */
define('ENGINE_CSS',['main' => 'bootstrap','extra' => 'style']);
define('ENGINE_JS',['main' => 'bootstrap','extra' => 'main']);

/**
 * Configuración de la URL del sitio
 * Detectar si el sitio está en HTTPS o HTTP y genera la URl correctamente
 */
define('PROTOCOL'  ,  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http');
define('HOST'      ,  $_SERVER['HTTP_HOST'] === 'localhost' ? 'localhost' : $_SERVER['HTTP_HOST']);
define('REQUEST_URL', $_SERVER['REQUEST_URI']);
define('URL'       ,  PROTOCOL.'://'.HOST.'/'.BASEPATH.'/');
define('CUR_PAGE'  ,  PROTOCOL.'://'.HOST.'/'.REQUEST_URL);

/**
 * Definicion de rutas de directorios y archivos
 * Se establecen constantes para facilitar la referencia a los directorios del framework
 */
define('DS'        ,  DIRECTORY_SEPARATOR);
define('ROOT'      ,  getcwd().DS);

/**
 * Carpetas principales del framework
 */
define('APP'       ,  ROOT.'app'.DS);
define('ASSETS'    ,  URL.'assets'.DS);
define('CONFIG'    ,  ROOT.'config'.DS);
define('DATABASE'  ,  ROOT.'database'.DS);
define('DOCS'      ,  ROOT.'docs'.DS);
define('PUBLICO'   ,  ROOT.'public'.DS);
define('RESOURCES' ,  ROOT.'resources'.DS);
define('STORAGE'   ,  ROOT.'storage'.DS);


/* SubCarpetas de APP */
define('CONTROLLERS',  APP.'controllers'.DS);
define('MODELS'     ,  APP.'models'.DS);
define('PROVIDERS'  ,  APP.'providers');

/* SubCarpetas de ASSETS */
define('FAVICON'    ,  ASSETS.'favicon/');
define('FONT'       ,  ASSETS.'font/');
define('IMG'        ,  ASSETS.'img/');
define('PLUGINS'    ,  ASSETS.'plugins/');
define('UPLOAD'     ,  ASSETS.'upload/');

/* SubCarpetas de  DATABASE */
define('FACTORIES'  ,  DATABASE.'factories'.DS);
define('MIGRATIONS' ,  DATABASE.'migrations'.DS);
define('SEEDERS'    ,  DATABASE.'seeders'.DS);

/* SubCarpetas de RESOURCES */
define('CSS'        ,  RESOURCES.'css'.DS);
define('JS'         ,  RESOURCES.'js'.DS);
define('VIEW'       ,  RESOURCES.'view'.DS);
define('INCLUDES'   ,  RESOURCES.'includes'.DS);
define('COMPONENTS' ,  RESOURCES.'components'.DS);

/* SubCarpetas de STORAGE */
define('CLASSES'    ,  STORAGE.'storage'.DS);
define('CORE'       ,  STORAGE.'core'.DS);
define('FUNCTIONS'  ,  STORAGE.'functions'.DS);
define('LIBS'       ,  STORAGE.'libs'.DS);
define('SETTINGS'   ,  STORAGE.'settings'.DS);

/* SubCarpetas de CLASSES */
define('API'        ,  CLASSES.'api'.DS);
define('AUTH'       ,  CLASSES.'auth'.DS);
define('CACHE'      ,  CLASSES.'cache'.DS);
define('CONSOLE'    ,  CLASSES.'console'.DS);
define('COOKIES'    ,  CLASSES.'cookies'.DS);
define('DB'         ,  CLASSES.'db'.DS);
define('FLASHER'    ,  CLASSES.'flasher'.DS);
define('HELPERS'    ,  CLASSES.'helpers'.DS);
define('INTERFACES' ,  CLASSES.'interface'.DS);
define('LOG'        ,  CLASSES.'log'.DS);
define('MAIL'       ,  CLASSES.'mail'.DS);
define('MAKE'       ,  CLASSES.'make'.DS);
define('MODULES'    ,  CLASSES.'modules'.DS);
define('REDIRECT'   ,  CLASSES.'redirect'.DS);
define('ROUTER'     ,  CLASSES.'router'.DS);
define('SERVER'     ,  CLASSES.'server'.DS);
define('SECURITY'   ,  CLASSES.'security'.DS);
define('SERVICES'   ,  CLASSES.'services'.DS);

/* SubCarpetas de DB */
define('CMD'         ,  DB.'cmd'.DS);
define('CONNECTORS'  ,  DB.'connectors'.DS);
define('MIGRATION'   ,  DB.'migration'.DS);
define('QUERY'       ,  DB.'query'.DS);
define('SCHEMA'      ,  DB.'schema'.DS);

/**
 * Configuracion de controladores y metodos por defecto
 * Se establencen los valores predeterminados para manejar las solicitudes y errores
 */
define('DEFAULT_CONTROLLER'        ,  'home');
define('DEFAULT_ERROR_CONTROLLER'  ,  'error');
define('DEFAULT_METHOD'            ,  'index');
