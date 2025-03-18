<?php

namespace Bimp\Framework\Helpers;

class Helpers{

    public static function engine_css(){
        $links = [];
    
        if (!defined('ENGINE_CSS') || !is_array(ENGINE_CSS)) {
            return ''; 
        }
    
        foreach (ENGINE_CSS as $css) {
            $url = URL . "/resources/css/$css.css";
            $path = CSS . "$css.css";
    
            if (!file_exists($path)) {
                continue; // Si el archivo no existe, simplemente lo ignora
            }
    
            $links[] = "<link rel='stylesheet' href='$url'>";
        }
    
        return implode("\n", $links);
    }
    
    public static function engine_js(){
        $links = [];
    
        if (!defined('ENGINE_JS') || !is_array(ENGINE_JS)) {
            return ''; 
        }
    
        foreach (ENGINE_JS as $js) {
            $url = URL . "/resources/js/$js.js";
            $path = JS . "$js.js";
    
            if (!file_exists($path)) {
                continue; // Si el archivo no existe, simplemente lo ignora
            }
    
            $links[] = "<script src='$url'></script>";
        }
    
        return implode("\n", $links);
    }
    

}