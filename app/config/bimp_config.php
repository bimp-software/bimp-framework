<?php

//Saber si estamos trabajando de forma local o remoto
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));
define('BASEPATH', IS_LOCAL ? '/bimp-framework/': '____EL BASEPATH EN PRODUCCIÓN___');
define('IS_DEMO', false);

//set para conexion en produccion o servidor o servidor real
define('DB_ENGINE',  '___REMOTE BD___');
define('DB_HOST',    '___REMOTE BD___');//puede variar dependiendo el hosting
define('DB_NAME',    '___REMOTE BD___');
define('DB_USER',    '___REMOTE BD___');
define('DB_PASS',    '___REMOTE BD___');
define('DB_CHARSET', '___REMOTE BD___');

// Para uso futuro de Gmaps o alguna implementación similar
define('GMAPS','__TOKEN__');

//Nombres de cookies para autentificacion de usuarios
//el valor peude ser cambiado en caso de utilizar
//multiples instancias de Bimp para proyectos diferentes y los cookies no representen un problema por el nombre repetido
define('AUTH_TKN_NAME','bimp__cookie_tkn');
define('AUTH_ID_NAME','bimp__cookie_id');

//Sal del sistema
define('AUTH_SALT', 'BimpFramework<3_BIMP.SOFTWARE_BGS_MAYKOL.BENJAMIN.BIMPSOFTWARE');//Cambiar dependiendo la pagina web

// En caso de implementación de pagos en línea para definir si se está trabajando con pasarelas en modo sanbox / prueba o producción
define('SANDBOX', false); //Live or sandbox;

//Credenciales para el envio de correos
define('CORREO_EMPRESA','');
define('PASS_CORREO','');