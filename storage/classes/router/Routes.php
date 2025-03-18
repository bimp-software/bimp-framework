<?php

namespace Bimp\Framework\Router;

class Routes {

    private $url = [];

    public function __construct() {
        $this->filter_url();
    }

    private function filter_url() {
        if (isset($_GET['uri'])) {
            $this->url = explode('/', filter_var(rtrim($_GET['uri'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function dispatch() {
        $current_controller = ucfirst($this->url[0] ?? DEFAULT_CONTROLLER) . 'Controller';
        $method = $this->url[1] ?? DEFAULT_METHOD;
        $params = array_slice($this->url, 2);

        if (!class_exists($current_controller)) {
            $current_controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
            $method = DEFAULT_METHOD;
        }

        $controller = new $current_controller;

        if (!method_exists($controller, $method)) {
            $controller = new (DEFAULT_ERROR_CONTROLLER . 'Controller');
            $method = DEFAULT_METHOD;
        }

        define('CONTROLLER', strtolower(str_replace('Controller', '', $current_controller)));
        define('METHOD', $method);

        call_user_func_array([$controller, $method], $params);
    }
}

