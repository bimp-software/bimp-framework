<?php 

class Redirect{
    private $location;

    /**
     * Metodo para redirigir al usuario a una seccion determinada
     * @param string $location
     * @return void
     */
    public static function to($location){
        $self = new self();
        $self->location = $location;

        //Si las cabeceras ya fueron enviadas
        if(headers_sent()){
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.URL.$self->location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.URL.$self->location.'"/>';
            echo '</noscript>';
            die();
        }

        //Cuando pasamos una url externa a nuestro sitio
        if(strpos($self->location, 'http') !== false){
            header('Location: '.$self->location);
            die();
        }

        //Redirigir al usuario a otra seccion
        header('Location: '.URL.$self->location);
        die();
    }

    public static function back($location = ''){
        if(!isset($_POST['redirect_to']) && !isset($_GET['redirect_to']) && $location == ''){
            header('Location: '.URL.DEFAULT_CONTROLLER);
            die();
        }

        if(isset($_POST['redirect_to'])){
            header('Location: '.$_POST['redirect_to']);
            die();
        }

        if(isset($_GET['redirect_to'])){
            header('Location: '.$_GET['redirect_to']);
            die();
        }
      
        if(!empty($location)){
            self::to($location);
        }
    }
}