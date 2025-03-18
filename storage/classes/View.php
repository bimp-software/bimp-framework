<?php

namespace Bimp\Framework;

use Exception;

class View {

    public static function render(string $view, array $data = []) : void {
        $build = (object)$data;
        $path = str_replace(['.','/'], DS, $view);
        $file = VIEW . CONTROLLER . DS . $path . 'View.php';
        
        if(!is_file($file)){
            throw new Exception(sprintf('La vista'));
        }

        extract((array)$build);
        require_once $file;
        exit();

    }

}