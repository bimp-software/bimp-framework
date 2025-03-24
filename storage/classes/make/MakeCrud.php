<?php

namespace Bimp\Framework\Make;

use Bimp\Framework\Console\Command\Command;
use Bimp\Framework\Console\Input\ConsoleInput;

/**
 * Clase MakeCrud
 * Genera una vista con un formulario HTML CRUD dentro de una plantilla base.
 * Utiliza viewTemplate.txt y reemplaza [[TITLE]] y [[FORM]] dinámicamente.
 */
class MakeCrud extends Command {

    protected $input;

    public function __construct() {
        parent::__construct(
            'make:crud',
            'MakeCrud',
            'Crea un formulario HTML dentro de una plantilla de vista.',
            'Este comando genera una vista con un formulario según los inputs definidos.'
        );
    }

    public function handle(array $args) {
        define("MODULES", getcwd() . '/storage/classes/modules/');
        define("VIEWS", getcwd() . '/resources/view/');
        define("DS", DIRECTORY_SEPARATOR);

        $this->input = new ConsoleInput();

        // Cargar plantilla base
        $templateFile = MODULES . 'crudTemplate.txt';
        if (!file_exists($templateFile)) {
            $this->input->text("No se encontró la plantilla en: $templateFile");
            return;
        }

        $template = file_get_contents($templateFile);

        // Pedir nombre del controlador / carpeta de vista
        $folder = '';
        while (true) {
            $folder = $this->input->ask("Nombre del controlador o carpeta de vista (ej: usuario):");
            if (empty($folder)) {
                $this->input->text("No puede estar vacío.");
                continue;
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $folder)) {
                $this->input->text("Solo letras, números y guiones bajos.");
                continue;
            }
            break;
        }

        $folder = strtolower($folder);
        $viewPath = VIEWS . $folder;
        if (!is_dir($viewPath)) {
            $this->input->text("La carpeta '$folder' no existe. Debes crearla primero.");
            return;
        }

        // Nombre del archivo de vista
        $fileName = '';
        while (true) {
            $fileName = $this->input->ask("Nombre del archivo de vista (sin extensión, ej: agregar):");
            if (empty($fileName)) {
                $this->input->text("El nombre no puede estar vacío.");
                continue;
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $fileName)) {
                $this->input->text("Nombre inválido.");
                continue;
            }
            break;
        }

        $filePath = $viewPath . DS . $fileName . 'View.php';
        if (file_exists($filePath)) {
            $overwrite = $this->input->confirm("El archivo ya existe. ¿Deseas sobrescribirlo?");
            if (!$overwrite) return;
        }

        // Recolección de campos
        $this->input->text("Ahora vamos a crear los campos del formulario.");
        $fields = [];

        while (true) {
            $fieldName = $this->input->ask("Nombre del campo (o ENTER para terminar):");
            if (empty($fieldName)) break;

            $fieldType = $this->input->ask("Tipo de input (text, number, email, password, etc):", 'text');
            $secure = $this->input->confirm("¿Este campo debe tener validación o es sensible?");

            $fields[] = [
                'name' => $fieldName,
                'type' => $fieldType,
                'secure' => $secure
            ];
        }

        if (count($fields) === 0) {
            $this->input->text("No se ingresaron campos.");
            return;
        }

        // Generar HTML del formulario
        $formHtml = "<form method=\"POST\" action=\"\">\n";
        foreach ($fields as $field) {
            $formHtml .= "    <div class=\"form-group\">\n";
            $formHtml .= "        <label for=\"{$field['name']}\">" . ucfirst($field['name']) . ":</label>\n";
            $formHtml .= "        <input type=\"{$field['type']}\" name=\"{$field['name']}\" id=\"{$field['name']}\" class=\"form-control\"" .
                         ($field['secure'] ? ' required' : '') . ">\n";
            $formHtml .= "    </div>\n";
        }
        $formHtml .= "    <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>\n";
        $formHtml .= "</form>\n";

        // Insertar datos en la plantilla
        $finalHtml = str_replace('[[TITLE]]', ucfirst($fileName), $template);
        $finalHtml = str_replace('[[FORM]]', $formHtml, $finalHtml);

        // Guardar el archivo final
        if (@file_put_contents($filePath, $finalHtml) === false) {
            $this->input->text("Error al guardar el archivo en $filePath");
            return;
        }

        $this->input->text("CRUD generado exitosamente en: $filePath");
    }
}