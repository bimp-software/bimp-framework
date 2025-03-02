<?php

class View {

    public static function render(string $view, array $data = []) {
        $d = (object)$data;
        $viewpath = str_replace(['.', '/'], DS, $view);
        $viewFile = VIEWS . CONTROLLER . DS . $viewpath . 'View.php';
        if (!is_file($viewFile)) {
            throw new Exception(sprintf('La vista "%s" no existe en el directorio "%s".', $view, VIEWS . CONTROLLER));
        }
        extract((array)$d);
        require_once $viewFile;
        exit();
    }
}
