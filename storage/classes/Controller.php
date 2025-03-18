<?php

namespace Bimp\Framework;

use Bimp\Framework\View;

abstract class Controller {

    /**
     * La vista a renderizar
     * @var string $name
     */
    protected string $name = 'index';

    /**
     * Toda la informacion que sera pasada a la vista
     */
    protected ?array $data = [];

    /**
     * La descripcion de la vista 
     */
    protected string $description = '';

    function __construct() {}
    
    /**
     * Define el nombre de la vista a ser utilizada en la ruta actual
     * @param string $View
     * @return void
     */
    function setView(string $View) : void {
        $this->name = $View;
    }

    /**
     * Definir el titulo de la pagina o ruta actual
     * @param string $View
     * @return void
     */
    function setTitle(string $Title) : void {
        $this->data['title'] = $Title;
    }

    /**
     * Definir la descripcion de la pagina o ruta actual
     * @param string $Description
     * @return void
     */
    function setDescription(string $Description) : void {
        $this->data['description'] = $Description;
    }

    /**
     * Definir el slug de la pagina o donde esta ubicado el usuario
     * @param string $Slug
     * @return void
     */
    function setSlug(string $Slug) : void {
        $this->data['slug'] = $Slug;
    }

    /**
     * Agregar un elemento a $data que sera pasada a la vista
     * @param string $key
     * @param mixed $value
     * @return void
     */
    function add(string $key, $value = null) : void {
        $this->data[$key] = $value;
    }

    /**
     * Regresa todo el contenido de $data
     * @return array $data
     */
    function getData() : array {
        return $this->data;
    }

    /**
     * Renderizar la vista con los datos proporcionados
     * @return void
     */
    function render() : void {
        View::render($this->name, $this->getData());
    }   
}