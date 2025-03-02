<?php 

/**
 * Clase para crear sesiones sefuras de usuarios
 */
class Auth{
    private $var = 'user_session';
    private $logger = false;
    private $token = null;
    private $id = null;
    private $ssid = null;
    private $user = [];

    public function __construct(){
        if(isset($_SESSION[$this->var])){
            return;
        }

        $session = [
            'logged' => false,
            'token'  => $this->token,
            'id'     => $this->id,
            'ssid'   => $this->ssid,
            'user'   => $this->user
        ];

        $_SESSION[$this->var] = $session;
        return;
    }

    public static function login($user_id, $user_data = []){
        $self    = new self();
        $session =
        [
            'logged' => true,
            'token'  => random_password(32),
            'id'     => $user_id,
            'ssid'   => session_id(),
            'user'   => $user_data
        ];

        $_SESSION[$self->var] = $session;
        return true;
    }

    // Validar la sesión del usuario
    public static function validate()
    {
        $self = new self();
        if (!isset($_SESSION[$self->var])) {
            return false;
        }

        // Validar la sesión
        return $_SESSION[$self->var]['logged'] === true && $_SESSION[$self->var]['ssid'] === session_id() && $_SESSION[$self->var]['token'] != null;
    }

    // Cerrar sesión del usuario
    public static function logout()
    {
        $self    = new self();
        $session =
        [
            'logged' => $self->logged,
            'token'  => $self->token,
            'id'     => $self->id,
            'ssid'   => $self->ssid,
            'user'   => $self->user
        ];

        $_SESSION[$self->var] = $session;
            return true;
    }

    public function __get($var)
    {
        if (!isset($this->{$var})) return false;
        return $this->{$var};
    }
}