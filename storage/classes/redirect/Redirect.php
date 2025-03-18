<?php

namespace Bimp\Framework\Redirect;

class Redirect{

    private $location;

    /**
     * Metodo para redirigir al usuario a una seccion determinada
     * @param string $location
     * @return void 
     */
    public static function to($location) : void {
        $self = new self();
        $self->location = $location;

        if(headers_sent()){
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.URL.$self->location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'"/>';
            echo '</noscript>';
            die();
        }

        if(strpos($self->location, 'http') !== false){
            header('Location: '.$self->location);
            die();
        }

        header('Location: '.URL.$self->location);
        die();
    }

    /**
     * Redirige de vuelta a la URL previa
     * @param string $location
     * @return void
     */
    public static function back($location = '') : void {
        if(!isset($_POST['redirect_to']) && !isset($_GET['redirect_to']) && $location == ''){
            header('Location: '.URL.DEFAULT_CONTROLLER);
            die();
        }

        if(isset($_POST['redirect_to'])){
            header('Location: '.$_POST['redirect_to']);
            die();
        }

        if(isset($_GET['redirect_to'])){
            header('Location: '.$_POST['redirect_to']);
            die();
        }

        if(!empty($location)){
            self::to($location);
        }
    }

}