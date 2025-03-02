<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//////////////////////////////////////////////////
require  LIBS.'vendor/phpmailer/src/Exception.php';
require  LIBS.'vendor/phpmailer/src/PHPMailer.php';
require  LIBS.'vendor/phpmailer/src/SMTP.php';

//////////////////////////////////////////////////

/**
 * Envía un correo electrónico usando PHPMailer
 *
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @param string $alt
 * @param string $bcc
 * @param string $reply_to
 * @param array $attachments
 * @return mixed
 */
function send_email(string $to,$body)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.bimp.cl';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = CORREO_EMPRESA;                     //SMTP username
        $mail->Password   = PASS_CORREO;                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(CORREO_EMPRESA, get_sitename());
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Asunto del Correo';
        $mail->Body    = $body;

        $mail->send(); // Envía el correo
        Flasher::new('El correo fue enciado exitosamente','success');
        Redirect::to('login');
    } catch (Exception $e) {
        Flasher::new($e->getMessage(),'danger');
        Redirect::to('login');
    }
}


/**
* Convierte el elemento en un objecto
*
* @param [ type ] $array
* @return void
*/

function to_object($array) {
    return json_decode(json_encode($array));
}

/**
* Regresa el nombre de nuestra aplicación
*
* @return string
*/

function get_sitename() {
    return SITE_NAME;
}

/**
 * Devuelve la URL del sitio configurada en la constante URL
 *
 * @return string
 */
function get_base_url()
{
	return URL;
}

/**
 * Validación del sistema en
 * desarrollo local
 *
 * @return boolean
 */
function is_local()
{
	return (IS_LOCAL === true);
}

/**
* Regresa la versión de nuestro sistema actual
*
* @return string
*/

function get_version() {
    return SITE_VERSION;
}

/**
* Regresa la fecha de estos momentos
*
* @return string
*/

function now() {
    return date( 'Y-m-d H:i:s' );
}

/**
 * Función para cargar el url de nuestro asset logotipo del sitio
 *
 * @return string
 */
function get_logo()
{
	$default_logo = SITE_LOGO;
	$dummy_logo   = 'https://via.placeholder.com/150x60';

	if (!is_file(IMAGES_PATH . $default_logo)) {
		return $dummy_logo;
	}

	return IMG . $default_logo;
}

/**
* Hace output en el body como json
*
* @param array $json
* @param boolean $die
* @return void
*/

function json_output( $json, $die = true ) {
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Content-type: application/json;charset=utf-8' );

    if ( is_array( $json ) ) {
        $json = json_encode( $json );
    }

    echo $json;
    if ( $die ) {
        die;
    }

    return true;
}

/**
* Sanitiza un valor ingresado por usuario
*
* @param string $str
* @param boolean $cleanhtml
* @return void
*/
function clean( $str, $cleanhtml = false ) {
    $str = trim($str);
    $patterns = [
        '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|CREATE|ALTER|TRUNCATE|RENAME|GRANT|REVOKE)\b/i', // Palabras clave SQL
        '/\b(OR|AND|XOR|NOT|LIKE|BETWEEN|IN|IS|NULL)\b/i', // Operadores y palabras SQL
        '/--\s*\n/', // Comentarios en SQL
        '/#\s*\n/',   // Comentarios en SQL
        '/\/\*.*?\*\//s', // Comentarios en SQL
        '/;\s*$/',   // Punto y coma al final
        '/\bTRUE\b/i', // TRUE en SQL
        '/\bFALSE\b/i', // FALSE en SQL
        '/\bOR\s+TRUE\b/i', // OR TRUE en SQL
        '/\bAND\s+TRUE\b/i', // AND TRUE en SQL
    ];
    foreach ($patterns as $pattern) {
        $str = preg_replace($pattern, '', $str);
    }
    if ($cleanhtml === true) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
    return filter_var($str, FILTER_SANITIZE_STRING);
}

/**
* Devuelve la IP del cliente actual
*
* @return void
*/

function get_user_ip() {
    $ipaddress = '';
    if ( getenv( 'HTTP_CLIENT_IP' ) )
    $ipaddress = getenv( 'HTTP_CLIENT_IP' );
    else if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
    $ipaddress = getenv( 'HTTP_X_FORWARDED_FOR' );
    else if ( getenv( 'HTTP_X_FORWARDED' ) )
    $ipaddress = getenv( 'HTTP_X_FORWARDED' );
    else if ( getenv( 'HTTP_FORWARDED_FOR' ) )
    $ipaddress = getenv( 'HTTP_FORWARDED_FOR' );
    else if ( getenv( 'HTTP_FORWARDED' ) )
    $ipaddress = getenv( 'HTTP_FORWARDED' );
    else if ( getenv( 'REMOTE_ADDR' ) )
    $ipaddress = getenv( 'REMOTE_ADDR' );
    else
    $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/**
* Devuelve el sistema operativo del cliente
*
* @return void
*/

function get_user_os() {
    if ( isset( $_SERVER ) ) {
        $agent = $_SERVER[ 'HTTP_USER_AGENT' ];
    } else {
        global $HTTP_SERVER_VARS;
        if ( isset( $HTTP_SERVER_VARS ) ) {
            $agent = $HTTP_SERVER_VARS[ 'HTTP_USER_AGENT' ];
        } else {
            global $HTTP_USER_AGENT;
            $agent = $HTTP_USER_AGENT;
        }
    }
    $ros[] = array( 'Windows XP', 'Windows XP' );
    $ros[] = array( 'Windows NT 5.1|Windows NT5.1)', 'Windows XP' );
    $ros[] = array( 'Windows 2000', 'Windows 2000' );
    $ros[] = array( 'Windows NT 5.0', 'Windows 2000' );
    $ros[] = array( 'Windows NT 4.0|WinNT4.0', 'Windows NT' );
    $ros[] = array( 'Windows NT 5.2', 'Windows Server 2003' );
    $ros[] = array( 'Windows NT 6.0', 'Windows Vista' );
    $ros[] = array( 'Windows NT 7.0', 'Windows 7' );
    $ros[] = array( 'Windows CE', 'Windows CE' );
    $ros[] = array( '(media center pc).([0-9]{1,2}\.[0-9]{1,2})', 'Windows Media Center' );
    $ros[] = array( '(win)([0-9]{1,2}\.[0-9x]{1,2})', 'Windows' );
    $ros[] = array( '(win)([0-9]{2})', 'Windows' );
    $ros[] = array( '(windows)([0-9x]{2})', 'Windows' );
    $ros[] = array( 'Windows ME', 'Windows ME' );
    $ros[] = array( 'Win 9x 4.90', 'Windows ME' );
    $ros[] = array( 'Windows 98|Win98', 'Windows 98' );
    $ros[] = array( 'Windows 95', 'Windows 95' );
    $ros[] = array( '(windows)([0-9]{1,2}\.[0-9]{1,2})', 'Windows' );
    $ros[] = array( 'win32', 'Windows' );
    $ros[] = array( '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})', 'Java' );
    $ros[] = array( '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}', 'Solaris' );
    $ros[] = array( 'dos x86', 'DOS' );
    $ros[] = array( 'unix', 'Unix' );
    $ros[] = array( 'Mac OS X', 'Mac OS X' );
    $ros[] = array( 'Mac_PowerPC', 'Macintosh PowerPC' );
    $ros[] = array( '(mac|Macintosh)', 'Mac OS' );
    $ros[] = array( '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'SunOS' );
    $ros[] = array( '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'BeOS' );
    $ros[] = array( '(risc os)([0-9]{1,2}\.[0-9]{1,2})', 'RISC OS' );
    $ros[] = array( 'os/2', 'OS/2' );
    $ros[] = array( 'freebsd', 'FreeBSD' );
    $ros[] = array( 'openbsd', 'OpenBSD' );
    $ros[] = array( 'netbsd', 'NetBSD' );
    $ros[] = array( 'irix', 'IRIX' );
    $ros[] = array( 'plan9', 'Plan9' );
    $ros[] = array( 'osf', 'OSF' );
    $ros[] = array( 'aix', 'AIX' );
    $ros[] = array( 'GNU Hurd', 'GNU Hurd' );
    $ros[] = array( '(fedora)', 'Linux - Fedora' );
    $ros[] = array( '(kubuntu)', 'Linux - Kubuntu' );
    $ros[] = array( '(ubuntu)', 'Linux - Ubuntu' );
    $ros[] = array( '(debian)', 'Linux - Debian' );
    $ros[] = array( '(CentOS)', 'Linux - CentOS' );
    $ros[] = array( '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - Mandriva' );
    $ros[] = array( '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - SUSE' );
    $ros[] = array( '(Dropline)', 'Linux - Slackware (Dropline GNOME)' );
    $ros[] = array( '(ASPLinux)', 'Linux - ASPLinux' );
    $ros[] = array( '(Red Hat)', 'Linux - Red Hat' );
    $ros[] = array( '(linux)', 'Linux' );
    $ros[] = array( '(amigaos)([0-9]{1,2}\.[0-9]{1,2})', 'AmigaOS' );
    $ros[] = array( 'amiga-aweb', 'AmigaOS' );
    $ros[] = array( 'amiga', 'Amiga' );
    $ros[] = array( 'AvantGo', 'PalmOS' );
    $ros[] = array( '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})', 'Linux' );
    $ros[] = array( '(webtv)/([0-9]{1,2}\.[0-9]{1,2})', 'WebTV' );
    $ros[] = array( 'Dreamcast', 'Dreamcast OS' );
    $ros[] = array( 'GetRight', 'Windows' );
    $ros[] = array( 'go!zilla', 'Windows' );
    $ros[] = array( 'gozilla', 'Windows' );
    $ros[] = array( 'gulliver', 'Windows' );
    $ros[] = array( 'ia archiver', 'Windows' );
    $ros[] = array( 'NetPositive', 'Windows' );
    $ros[] = array( 'mass downloader', 'Windows' );
    $ros[] = array( 'microsoft', 'Windows' );
    $ros[] = array( 'offline explorer', 'Windows' );
    $ros[] = array( 'teleport', 'Windows' );
    $ros[] = array( 'web downloader', 'Windows' );
    $ros[] = array( 'webcapture', 'Windows' );
    $ros[] = array( 'webcollage', 'Windows' );
    $ros[] = array( 'webcopier', 'Windows' );
    $ros[] = array( 'webstripper', 'Windows' );
    $ros[] = array( 'webzip', 'Windows' );
    $ros[] = array( 'wget', 'Windows' );
    $ros[] = array( 'Java', 'Unknown' );
    $ros[] = array( 'flashget', 'Windows' );
    $ros[] = array( '(PHP)/([0-9]{1,2}.[0-9]{1,2})', 'PHP' );
    $ros[] = array( 'MS FrontPage', 'Windows' );
    $ros[] = array( '(msproxy)/([0-9]{1,2}.[0-9]{1,2})', 'Windows' );
    $ros[] = array( '(msie)([0-9]{1,2}.[0-9]{1,2})', 'Windows' );
    $ros[] = array( 'libwww-perl', 'Unix' );
    $ros[] = array( 'UP.Browser', 'Windows CE' );
    $ros[] = array( 'NetAnts', 'Windows' );
    $file = count ( $ros );
    $os = '';
    for ( $n = 0 ; $n < $file ; $n++ ) {
        if ( @preg_match( '/'.$ros[ $n ][ 0 ].'/i', $agent, $name ) ) {
            $os = @$ros[ $n ][ 1 ].' '.@$name[ 2 ];
            break;
        }
    }
    return trim ( $os );
}

/**
* Devuelve el navegador del cliente
*
* @return void
*/

function get_user_browser() {
    $user_agent = ( isset( $_SERVER ) ? $_SERVER[ 'HTTP_USER_AGENT' ] : NULL );

    $browser        = 'Unknown Browser';

    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser'
    );

    foreach ( $browser_array as $regex => $value ) {
        if ( preg_match( $regex, $user_agent ) ) {
            $browser = $value;
        }
    }

    return $browser;
}

/**
* Inserta campos html en un formulario
* @return string
*/

function insert_inputs() {
    $output = '';

    if ( isset( $_POST[ 'redirect_to' ] ) ) {
        $location = $_POST[ 'redirect_to' ];
    } else if ( isset( $_GET[ 'redirect_to' ] ) ) {
        $location = $_GET[ 'redirect_to' ];
    } else {
        $location = CUR_PAGE;
    }

    $output .= '<input type="hidden" id="redirect_to" name="redirect_to" value="'.$location.'">';
    $output .= '<input type="hidden" id="timecheck" name="timecheck" value="'.time().'">';
    $output .= '<input type="hidden" id="csrf" name="csrf" value="'.CSRF_TOKEN.'">';
    $output .= '<input type="hidden" id="hook" name="hook" value="jserp_hook">';
    $output .= '<input type="hidden" id="action" name="action" value="post">';
    return $output;
}

/**
* Valida los parametros pasados en POST
*
* @param array $required_params
* @param array $posted_data
* @return void
*/

function check_posted_data( $required_params = [], $posted_data = [] ) {

    if ( empty( $posted_data ) ) {
        return false;
    }

    // Keys necesarios en toda petición
    $defaults = [ 'hook', 'action' ];
    $required_params = array_merge( $required_params, $defaults );
    $required = count( $required_params );
    $found = 0;

    foreach ( $posted_data as $k => $v ) {
        if ( in_array( $k, $required_params ) ) {
            $found++;
        }
    }

    if ( $found !== $required ) {
        return false;
    }

    return true;
}

/**
* Carga y regresa un valor determinao de la información del usuario
* guardada en la variable de sesión actual
*
* @param string $key
* @return mixed
*/

function get_user( $key = null) {
    if ( !isset( $_SESSION[ 'user_session' ] ) ) return false;

    $session = $_SESSION[ 'user_session' ];
    // información de la sesión del usuario actual, regresará siempre falso si no hay dicha sesión

    if ( !isset( $session[ 'user' ] ) || empty( $session[ 'user' ] ) ) return false;

    $user = $session[ 'user' ];
    // información de la base de datos o directamente insertada del usuario

    if ( $key === null ) return $user;

    if ( !isset( $user[ $key ] ) ) return false;
    // regresará falso en caso de no encontrar el key buscado

    // Regresa la información del usuario
    return $user[ $key ];
}

/**
* Agregar ellipsis a un string
*
* @param string $string
* @param integer $lng
* @return void
*/

function add_ellipsis( $string, $lng = 100 ) {
    if ( !is_integer( $lng ) ) {
        $lng = 100;
    }

    $output = strlen( $string ) > $lng ? mb_substr( $string, 0, $lng, 'UTF-8' ).'...' : $string;
    return $output;
}

/**
* Registra los parámetro por defecto de Bimp
*
* @return bool
*/

function bimp_obj_default_config() {
    global $bimp_Object;

    $bimp_Object =
    [];
}

/**
 * 
 * Loggea un registro en un archivo de Logs del sistema, usado para debugging
 * @param string $message
 * @param string $type
 * @param boolean $output
 * @return mixed
 */
function logger($message, $type = 'debug', $output = false){
    $types = ['debug', 'import', 'info', 'success', 'warning', 'error'];

    if (!in_array($type, $types)) {
		$type = 'debug';
	}

	$now_time = date("d-m-Y H:i:s");
	$message  = is_array($message) || is_object($message) ? print_r($message, true) : $message;
	$message  = "[" . strtoupper($type) . "] $now_time - $message";

	if (!is_dir(LOGS)) {
		mkdir(LOGS);
	}

	$filename = is_local() ? "dev_log.log" : "bimp_log.log";
	if (!$fh = fopen(LOGS . $filename, 'a')) {
		error_log(sprintf('Can not open this file on %s', LOGS . 'bimp_log.log'));
		return false;
	}

	fwrite($fh, "$message\n");
	fclose($fh);
	if ($output) {
		print "$message\n";
	}

	return true;
}

/**
 * Genera un string o password
 *
 * @param integer $tamano
 * @param string $type
 * @return void
 */
function random_password($length = 8, $type = 'default') {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  
    if ($type === 'numeric') {
            $alphabet = '1234567890';
        }
    
    $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    
    for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
    }
  
	return str_shuffle(implode($pass)); //turn the array into a string
}


/**
 * Metodo para encryptar las contrasenas del sistema concatenandola con la sal del sistema
 * @param @string 
 * @return void
 */
function encrypted($password = ''){
    if(empty($password)){
        die(sprintf('El password %s es un dato obligatorio',$password));
    }

    $pass = $password.AUTH_SALT;
    $pass_hash = hash('sha256', $pass);

    return $pass_hash;
}

/**
 * Regresa parseado un modulo
 *
 * @param string $view
 * @param array $data
 * @return void
 */
function get_module($view, $data = []) {
    $file_to_include = MODULES.$view.'Module.php';
      $output = '';
      
      // Por si queremos trabajar con objeto
      $d = to_object($data);
      
      if(!is_file($file_to_include)) {
          return false;
      }
  
      ob_start();
      require_once $file_to_include;
      $output = ob_get_clean();
  
      return $output;
}


  /**
 * Construye un nuevo string json
 *
 * @param integer $status
 * @param array $data
 * @param string $msg
 * @return void
 */
function json_build($status = 200 , $data = null , $msg = '', $error_code = null) {
    /*
    1 xx : Informational
    2 xx : Success
    3 xx : Redirection
    4 xx : Client Error
    5 xx : Server Error
    */
  
    if(empty($msg) || $msg == '') {
      switch ($status) {
        case 200:
          $msg = 'OK';
          break;
        case 201:
          $msg = 'Created';
          break;
        case 400:
          $msg = 'Invalid request';
          break;
        case 403:
          $msg = 'Access denied';
          break;
        case 404:
          $msg = 'Not found';
          break;
        case 500:
          $msg = 'Internal Server Error';
          break;
        case 550:
          $msg = 'Permission denied';
          break;
        default:
          break;
      }
    }
  
    $json =
    [
      'status' => $status,
      'error'  => false,
      'msg'    => $msg,
      'data'   => $data
    ];
  
    if (in_array($status, [400,403,404,405,500])){
      $json['error'] = true;
    }
  
    if ($error_code !== null) {
      $json['error'] = $error_code;
    }
  
    return json_encode($json);
  }

    function get_bimp_message($code)
    {
        global $Bimp_Messages;
        $code = (string) $code;
        return isset($Bimp_Messages[$code]) ? $Bimp_Messages[$code] : '';
    }

    function more_info(string $content, string $color = 'text-info', string $icon = 'fas fa-exclamation-circle')
    {
        $str    = clean($content);
        $output = '<span class="%s" %s><i class="%s"></i></span>';
        return sprintf($output, $color, tooltip($content), $icon);
    }

    function tooltip($title = null)
    {
        if ($title == null) {
            return false;
        }

        return 'data-bs-toggle="tooltip" title="' . $title . '"';
    }