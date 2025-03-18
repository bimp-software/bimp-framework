<?php

/**
 * Regresa el nombre de nuestra aplicacion
 * @return string BF_NAME
 */
function get_sitename(){
    return BF_NAME;
}

function get_bimp_version(){
    $file = 'bimp_core_version.php';
    if(!is_file(CORE.$file)){
        return '1.5.0';
    }

    $version = require CORE.$file;

    return $version;
}

function get_bimp_lang(){
    $file = 'bimp_core_lang.php';
    if(!is_file(CORE.$file)){
        return 'es';
    }
    $lang = require CORE.$file;
    return $lang;
}

/**
 * Imprime un bloque de codigo de forma segura como string
 * @param string $snippet
 * @return string
 */
function code_block($snippet){
    $snippet = htmlentities($snippet);
    return "<pre class='code-block'> <code>$snippet</code> </pre>";
}
