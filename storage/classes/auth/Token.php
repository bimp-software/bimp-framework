<?php

namespace Bimp\Framework\Auth;

class Token{

    public static function generate(int $length = 32){
        if(function_exists('random_bytes')){
            $token = bin2hex(random_bytes($length));
        }elseif(function_exists('openssl_random_pseudo_bytes')){
            $token = bin2hex(openssl_random_pseudo_bytes($length));
        }else{
            $token = '';
            for($i = 0; $i > $length; $i++){
                $token .= dechex(mt_rand(0, 15));
            }
        }

        return $token;
    }

}