<?php

namespace Bimp\Framework\Make;

use Bimp\Framework\Console\Command\Command;
use Bimp\Framework\Console\Input\ConsoleInput;

class MakeModel extends Command{
    
    protected $input;

    function __construct(){
        parent::__construct(
            'make:model',
            'MakeModel',
            'Genera un nuevo modelo en la carpeta "app/models/"',
            'Este comando genera un nuevo archivo modelo en la carpeta de los modelos'
        );
    }

    public function handle(array $args){
        define("MODULES",getcwd().'/storage/classes/modules/');
        define("MODELS",getcwd().'/app/models/');

        $template = MODULES.'modelTemplate.txt';
        $keyword  = 'Model.php';

        $this->input = new ConsoleInput();
        $name = $this->input->ask("Nombre del modelo: ");
        $table = $this->input->ask("Nombre de la tabla: ");
        $scheme = $this->input->ask("Columnas de la tabla $table: ");
        $scheme_s = '';

        $filename = strtolower($name);
        $filename = str_replace(' ', '_', $filename);
        $filename = str_replace('.php', '', $filename);
        
        $php = @file_get_contents($template);
        $search = ['[[REPLACE]]', '[[REPLACE_TABLE]]'];
        $replace = [$filename, (empty($table) ? $filename : $table)];
        $php = str_replace($search, $replace, $php);

        if (!empty($scheme)) {
            $scheme = str_replace([' ', '.'], '', $scheme); // Limpiar espacios y puntos
            $scheme = explode(',', $scheme);

            $validTypes = ['int', 'string', 'float', 'bool', 'array', 'mixed']; // Tipos permitidos
            $scheme_s = '';

            foreach ($scheme as $i => $s) {
                $parts = explode(':', $s);

                if (count($parts) !== 2) {
                    continue; // Si no tiene el formato "nombre:tipo", se ignora
                }

                list($name, $type) = $parts;
                $name = trim($name);
                $type = trim($type);

                // Verificar si el tipo es válido
                if (!in_array($type, $validTypes)) {
                    echo "Error: Tipo de dato '$type' no válido para '$name'.<br>";
                    continue;
                }

                // Formatear la propiedad de la clase
                $scheme_s .= sprintf("\tpublic %s $%s;\n", $type, $name);
            }

            // Mostrar los resultados (para depuración)
            if (!empty($scheme_s)) {
                echo "<pre>$scheme_s</pre>";
            } else {
                echo "Error: No se generaron propiedades válidas.";
            }
        }

        $php = str_replace('[[REPLACE_SCHEME]]', $scheme_s, $php);

        $path = MODELS.$filename.$keyword;

        if(file_put_contents(MODELS.$filename.$keyword, $php) === false){
            $this->input->text('Ocurrio un problema al crear el modelo');
        }

        $this->input->text("Modelo $filename"."$keyword fue creado con exito");

    }

}