<?php

namespace Bimp\Framework\Make;

use Bimp\Framework\Console\Command\Command;
use Bimp\Framework\Console\Input\ConsoleInput;

/**
 * Clase MakeView
 * Crea una nueva vista o agrega una vista a un controlador existente.
 * También actualiza el controlador agregando una función que renderiza la vista
 * usando $this->setView('vista') y $this->render().
 */
class MakeView extends Command {

    protected $input;

    public function __construct() {
        parent::__construct(
            'make:view',
            'MakeView',
            'Crea o agrega vistas en "resources/view/" y actualiza el controlador si existe.',
            'Este comando permite crear carpetas de vista o añadir archivos de vista a un controlador existente.'
        );
    }

    public function handle(array $args) {
        define("MODULES", getcwd() . '/storage/classes/modules/');
        define("VIEWS", getcwd() . '/resources/view/');
        define("CONTROLLERS", getcwd() . '/app/controllers/');
        define("DS", DIRECTORY_SEPARATOR);

        $this->input = new ConsoleInput();

        // Verificar existencia de plantilla base
        $template = MODULES . 'viewTemplate.txt';
        if (!file_exists($template)) {
            $this->input->text("No se encontró la plantilla base en $template");
            return;
        }

        // Preguntar si se creará nueva carpeta de vista o se usará una existente
        $isNew = $this->input->confirm("¿Deseas crear una nueva carpeta de vista?");

        // Nombre del controlador
        $controllerName = '';
        while (true) {
            $controllerName = $this->input->ask("Nombre del controlador (carpeta de vista): ");
            if (empty($controllerName)) {
                $this->input->text("El nombre no puede estar vacío.");
                continue;
            }

            if (!preg_match('/^[a-zA-Z0-9_]+$/', $controllerName)) {
                $this->input->text("Solo se permiten letras, números y guiones bajos.");
                continue;
            }

            $controllerName = strtolower(str_replace(' ', '_', $controllerName));
            $viewFolder = VIEWS . $controllerName;

            if ($isNew && file_exists($viewFolder)) {
                $this->input->text("Ya existe una carpeta de vista con ese nombre.");
                continue;
            }

            if (!$isNew && !is_dir($viewFolder)) {
                $this->input->text("No existe ninguna carpeta de vista con ese nombre.");
                continue;
            }

            break;
        }

        // Crear carpeta si es nueva
        if ($isNew) {
            if (!mkdir($viewFolder, 0755, true)) {
                $this->input->text("No se pudo crear la carpeta en $viewFolder");
                return;
            }
        }

        // Nombre base del archivo de vista
        $baseName = '';
        while (true) {
            $baseName = $this->input->ask("Nombre base de la vista (ej: home): ");
            if (empty($baseName)) {
                $this->input->text("El nombre no puede estar vacío.");
                continue;
            }

            if (!preg_match('/^[a-zA-Z0-9_]+$/', $baseName)) {
                $this->input->text("Solo se permiten letras, números y guiones bajos.");
                continue;
            }

            $viewFileName = $baseName . 'View.php';
            $filePath = $viewFolder . DS . $viewFileName;

            if (file_exists($filePath)) {
                $this->input->text("Ya existe un archivo con ese nombre.");
                continue;
            }

            break;
        }

        // Crear archivo de vista desde la plantilla
        $html = file_get_contents($template);
        $html = str_replace('[[REPLACE]]', $baseName, $html);

        if (@file_put_contents($filePath, $html) === false) {
            $this->input->text("No se pudo crear el archivo en $filePath");
            return;
        }

        $this->input->text("Vista creada exitosamente en: $filePath");

        // Agregar método al controlador si existe
        $controllerFile = CONTROLLERS . $controllerName . 'Controller.php';
        $methodName = $baseName;

        if (file_exists($controllerFile)) {
            $controllerCode = file_get_contents($controllerFile);

            if (strpos($controllerCode, "function $methodName(") === false) {
                $methodCode = "\n    public function $methodName() {\n        \$this->setView('$baseName');\n        \$this->render();\n    }\n}";

                $controllerCode = preg_replace('/\}\s*$/', $methodCode, $controllerCode);

                if (@file_put_contents($controllerFile, $controllerCode) !== false) {
                    $this->input->text("Método '$methodName()' agregado al controlador: $controllerFile");
                } else {
                    $this->input->text("No se pudo escribir en el controlador.");
                }
            } else {
                $this->input->text("El método '$methodName()' ya existe en el controlador.");
            }
        } else {
            $this->input->text("El controlador no fue encontrado. No se actualizó.");
        }
    }
}
