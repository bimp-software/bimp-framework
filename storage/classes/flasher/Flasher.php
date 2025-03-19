<?php

namespace Bimp\Framework\Flasher;

class Flasher {

    /**
     * Los tipos de notificacion validos
     * @var array
     */
    private $valid_types = [];

    /**
     * El tipo de notificacion por defecto 
     * paso de ser primary a success
     * @var string
     */
    private $default = null;

    /**
     * Tipo de notificacion flash
     * @var string 
     */
    private $type = null;

    /**
     * Contenido de la notificacion flash
     * @var string
     */
    private $msg = null;

    function __construct(){
        $this->default = 'success';
        $this->valid_types = ['primary','secondary','success','danger','warning','info','light','dark'];
    }

    public static function new (string $msg, string $type = null, string $heading = null, bool $icon = true){
        $self = new self();

        if($type === null){
            $self->type = $self->default;
        }

        $self->type = in_array($type, $self->valid_types) ? $type : $self->default;

        $flash = [
            'type'    => $type,
            'heading' => $heading,
            'msg'     => $msg,
            'icon'    => $icon,
        ];

        $_SESSION[$self->type][] = $flash;

        return true;
    }

    static function error(string $msg, string $heading = null){
        self::new($msg, 'danger' , $heading);
        return;
    }

    static function info(string $msg, string $heading = null){
        self::new($msg, 'info' , $heading);
        return;
    }

    static function success(string $msg, string $heading = null){
        self::new($msg, 'success' , $heading);
        return;
    }

    static function warn(string $msg, string $heading = null){
        self::new($msg, 'warning' , $heading);
        return;
    }

    static function primary(string $msg, string $heading = null){
        self::new($msg, 'primary' , $heading);
        return;
    }

    static function dark(string $msg, string $heading = null){
        self::new($msg, 'dark' , $heading);
        return;
    }

    public static function flash(){
        $self = new self();
        $placeholder = '';
        $output = '';

        foreach($self->valid_types as $type){
            if(isset($_SESSION[$type]) && !empty($_SESSION[$type])){
                foreach($_SESSION[$type] as $f){
                    $placeholder = '<div class="alert alert-%s alert-dismissible show fade" role="alert">';

                    if(!empty($f["heading"])){
                        $placeholder .= sprintf('<h5 class="alert-heading fw-bold">%s</h5>', $f["heading"]);
                    }

                    if($f["icon"] === true){
                        switch($f["type"]){
                            case 'primary':
                                $icon = "fas fa-bell";
                                break;
                            case 'success':
                                $icon = "fas fa-check";
                                break;
                            case 'warning':
                                $icon = "fas fa-triangle-exclamation";
                                break;
                            case 'danger':
                                $icon = "fas fa-xmark";
                                break;  
                            case 'info':
                                $icon = "fas fa-bookmark";
                                break;
                            case 'dark':
                                $icon = "fas fa-bullseye";
                                break;    
                            default:
                                $icon = "fas fa-bell";
                                break;
                        }
                        $placeholder .= sprintf('<i class="%s flex-shrink-0 me-2"></i>', $icon);
                    }

                    $placeholder .= '%s
                        <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Cerrar"></button>
                    </div>';

                    $output .= sprintf($placeholder , $type, $f["msg"]);
                    break;
                }
            }
            unset($_SESSION[$type]);
        }

        return $output;
    }

    public static function deny($msgType = 0){
        $types = [
            0 => 'Acceso no autorizado',
            1 => 'Accion no autorizada.',
            2 => 'Permisos denegados.',
            3 => 'No puedes realizar esta acción.',
        ];

        self::new($types[$msgType], 'danger');
        return true;
    }
}