<?php

namespace Bimp\Framework\Auth;

use Bimp\Framework\Auth\Token;

/**
 * Clase para crear sesiones seguras de usuarios
 */
class Auth{

    /**
     * El nombre de la variable de sesion o de la clave en si
     * @var string $var
     */
    private $var = 'user_session';

    /**
     * Determina si el usuario esta logueado o no
     * @var boolean $logged
     */
    private $logged = false;

    /**
     * El token de acceso del usuario en curso
     * @var string $token
     */
    private $token = null;

    /**
     * El ID del usuario en curso
     * @var mixed $id
     */
    private $id = null;

    /**
     * El session_id del usuario en curso
     * @var string $session_id
     */
    private $session_id = null;

    /**
     * Toda la informacion registrada del usuario
     * @var array $user
     */
    private $user = [];

    function __construct(){
        if(isset($_SESSION[$this->var])){
            return $this;
        }

        $session = [
            'logged' => $this->logged,
            'token' => $this->token,
            'id' => $this->id,
            'ssid' => $this->session_id,
            'user' => $this->user,
        ];

        $_SESSION[$this->var] = $session;
        return $this;
    }

    /**
     * Crea la sesion de un usuario
     * @param mixed $user_id
     * @param array $user_data
     * @return boolean
     */
    public static function login(mixed $user_id, array $user_data = []){
        $self = new self();
        $self->logged = true;
        $session = [
            'logged' => $self->logged,
            'token' => Token::generate(),
            'id' => $user_id,
            'ssid' => session_id(),
            'user' => $user_data,
        ];

        $_SESSION[$self->var] = $session;
        return true;
    }

    /**
     * Realizar la validación de la sesión del usuario en curso
     *
     * @return bool
     */
    public static function validate() {
        $self = new self();
        // Si no existe siquiera la variable de sesión en el sistema
        if (!isset($_SESSION[$self->var])) { return false; }
        // Validar la sesión
        return $_SESSION[$self->var]['logged'] === true && $_SESSION[$self->var]['ssid'] === session_id() && $_SESSION[$self->var]['token'] !== null;
    }

    /**
     * Cierra la sesión del usuario en curso
     *
     * @return bool
     */
    public static function logout() {
        $self    = new self();
        $session = [
            'logged' => $self->logged,
            'token'  => $self->token,
            'id'     => $self->id,
            'ssid'   => $self->ssid,
            'user'   => $self->user
        ];
        $_SESSION[$self->var] = $session;
        unset($_SESSION[$self->var]);
        session_destroy();

        return true;
    }


    public function __get($var){
        if (!isset($this->{$var})) return false;
        return $this->{$var};
    }
}