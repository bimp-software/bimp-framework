<?php

namespace Bimp\Framework\Console\Input;

use Bimp\Framework\Interface\InputInterface;

/**
 * Clase para inputs como preguntas, confirmar, loading, choise
 * @package Bimp\Framework\Console\Input
 * @author Bimp Software
 */
class ConsoleInput implements InputInterface {

    public function text(string $message) : string {
        echo $message;
        return $message;
    }

    public function ask(string $question) : string {
        echo $question . " ";
        return trim(fgets(STDIN));
    }

    public function confirm(string $question) : bool {
        $response = strtolower(self::ask($question . "(sí/no)"));
        return in_array($response, ['s', 'si', 'yes', 'y']);
    }

    public function choice(string $question, array $options) : string {
        echo $question . "\n";

        foreach($options as $key => $op){
            echo "[$key] $op\n";
        }

        while (true){
            $choise = self::ask("Seleccionar una opción (Ingrese el número):");

            if(isset($options[$choise])) return $options[$choise];

            echo "Opcion invalida. Intente nuevamente...\n";
        }
    }

    public static function loading(string $message = 'Cargando...', int $seconds = 3) {
        $frames = ['-', '\\', '|', '/'];
        $end_time = time() + $seconds;
        $length = strlen($message) + 2; 
    
        echo "\n";
        while (time() < $end_time) {
            foreach ($frames as $f) {
                echo "\r$message $f";
                usleep(250000);
            }
        }
    
        echo "\r" . str_repeat(" ", $length) . "\r"; // Borra el mensaje con espacios en blanco
    }

}