<?php

namespace Bimp\Framework\Make;

use Bimp\Framework\Console\Command\Command;
use Bimp\Framework\Console\Input\ConsoleInput;

class MakeController extends Command{
    
    protected $input;

    function __construct(){
        parent::__construct(
            'make:controller',
            'MakeController',
            'Genera un nuevo controlador en la carpeta "app/controllers/"',
            'Este comando genera un nuevo archivo en la carpeta controllers'
        );
    }

    public function handle(array $args) {
        define("MODULES",getcwd().'/storage/classes/modules/');
        define("CONTROLLERS",getcwd().'/app/controllers/');
        define("VIEWS",getcwd().'/resources/view/');
        define("DS",DIRECTORY_SEPARATOR);

        $template = MODULES.'controllerTemplate.txt';
        $keyword  = 'Controller.php';

        $this->input = new ConsoleInput();
        $name = $this->input->ask("Nombre del controller: ");
        $g_vista = $this->input->confirm("¿Desea crear la vista?");

        $filename = strtolower($name);
        $filename = str_replace(' ', '_', $filename);
        $filename = str_replace('.php', '', $filename);

        $php = @file_get_contents($template);
        $php = str_replace('[[REPLACE]]', $filename, $php);

        if(file_put_contents(CONTROLLERS.$filename.$keyword, $php) === false){
            echo "Error: al generar el archivo del controller.<br>";
        }

        if(!is_dir(VIEWS.$filename) && $g_vista === true){
            mkdir(VIEWS.$filename);
        }

        if($g_vista === true){
            $viewTemplate = MODULES.'viewTemplate.txt';

            if(!is_file($viewTemplate)){
                echo "Error: la vista no fue creada, no existe la plantilla";
            }else{
                $html = @file_get_contents($viewTemplate);
                @file_put_contents(VIEWS.$filename.DS.'indexView.php', $html);
            }
        }

        $this->input->text("El controlador y la vista fue creado correctamente.");
    }

}