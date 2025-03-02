<?php

/**
 * Regresa el rol del usuario 
 * @return void
 */
function get_user_role(){
    return $rol = get_user('NOM_ROL');
}

function get_default_role(){
    return ['ADMIN'];
}

function is_admin($rol){
    return in_array($rol, ['ADMIN']);
}

function is_programador($rol){
    return in_array($rol, ['PROGRAMADOR']);
}

function is_cliente($rol){
    return in_array($rol, ['CLIENTE']);
}

function is_inversionista($rol){
    return in_array($rol, ['INVERSIONISTA']);
}

function is_user($rol, $roles_aceptados){
    $default = get_default_role();

    if(!is_array($roles_aceptados)){
        array_push($default, $roles_aceptados);
        return in_array($rol, $default);
    }

    return in_array($rol, array_merge($default, $roles_aceptados));
}