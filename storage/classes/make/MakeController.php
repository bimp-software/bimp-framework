<?php

namespace Bimp\Framework\Make;

use Bimp\Framework\Console\Command\Command;
use Bimp\Framework\Console\Input\ConsoleInput;

/**
 * Clase MakeController
 * Este comando genera un nuevo controlador en la carpeta "app/controllers/"
 * y opcionalmente crea su carpeta de vistas asociada en "resources/view/[nombre]/indexView.php".
 * Utiliza plantillas base ubicadas en "storage/classes/modules/" para la creación de archivos.
 */
class MakeController extends Command {

    protected $input;

    public function __construct() {
        parent::__construct(
            'make:controller',
            'MakeController',
            'Genera un nuevo controlador en la carpeta "app/controllers/"',
            'Este comando genera un nuevo archivo en la carpeta controllers'
        );
    }

    public function handle(array $args) {
        define("MODULES", getcwd() . '/storage/classes/modules/');
        define("CONTROLLERS", getcwd() . '/app/controllers/');
        define("VIEWS", getcwd() . '/resources/view/');
        define("DS", DIRECTORY_SEPARATOR);

        $this->input = new ConsoleInput();

        // Validar plantilla del controller
        $template = MODULES . 'controllerTemplate.txt';
        if (!file_exists($template)) {
            $this->input->text("❌ Error: No se encontró la plantilla del controlador en $template");
            return;
        }

        $keyword = 'Controller.php';

        // Validar nombre del controlador
        $name = '';
        while (true) {
            $name = $this->input->ask("Nombre del controller: ");

            if (empty($name)) {
                $this->input->text("❌ El nombre no puede estar vacío.");
                continue;
            }

            if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
                $this->input->text("❌ El nombre solo puede contener letras, números y guiones bajos.");
                continue;
            }

            $filename = strtolower(str_replace(' ', '_', $name));
            $filename = str_replace('.php', '', $filename);
            $controllerPath = CONTROLLERS . $filename . $keyword;

            if (file_exists($controllerPath)) {
                $this->input->text("❌ Ya existe un controlador con ese nombre.");
                continue;
            }

            break;
        }

        $g_vista = $this->input->confirm("¿Desea crear la vista?");

        // Crear el archivo del controller
        $php = file_get_contents($template);
        $php = str_replace('[[REPLACE]]', $filename, $php);

        if (@file_put_contents($controllerPath, $php) === false) {
            $this->input->text("❌ Error: no se pudo crear el archivo del controller en $controllerPath");
            return;
        }

        // Crear carpeta y vista si se desea
        if ($g_vista === true) {
            $viewPath = VIEWS . $filename;
            $viewTemplate = MODULES . 'viewTemplate.txt';

            if (!is_dir($viewPath)) {
                if (!mkdir($viewPath, 0755, true)) {
                    $this->input->text("❌ Error: no se pudo crear la carpeta de vista en $viewPath");
                    return;
                }
            }

            if (!file_exists($viewTemplate)) {
                $this->input->text("❌ Error: no se encontró la plantilla de vista en $viewTemplate");
                return;
            }

            $html = file_get_contents($viewTemplate);
            $viewFile = $viewPath . DS . 'indexView.php';

            if (@file_put_contents($viewFile, $html) === false) {
                $this->input->text("❌ Error: no se pudo crear el archivo de vista.");
                return;
            }

            $this->input->text("✅ La vista fue creada en: $viewFile");
        }

        $this->input->text("✅ El controlador fue creado en: $controllerPath");
    }
}