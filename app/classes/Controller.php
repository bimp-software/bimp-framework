<?php


abstract class Controller{

    /**
     * La vista a renderizar
     * @var string
     */
    protected string $viewName = 'index';

    /**
     * Toda la informacion que sera pasada a la vista
     */
    protected ?array $data = [];

    /**
     * La descripcion de la vista
     * @var string
     */
    protected string $viewDescription = '';


    public function __construct(){}


    /**
     * Funcion para validar la sesion de un usuario, puede ser usada
     * en cualquier controlador hijo o que extienda el Controller
     * @return void
     */
    protected function auth(){
        if(!Auth::validate()){
            Flasher::new('Área protegida, debes iniciar sesión para visualizar el contenido.', 'danger');
            Redirect::back('login');
        }
    }

    /**
     * Define el título de la página o ruta actual
     *
     * @param string $pageTitle
     * @return void
     */
    function setTitle(string $pageTitle){
        $this->data['title'] = $pageTitle;
    }

    /**
     * Agrega un elemento a $data que será pasada a la vista
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    function addToData(string $key, $value = null){
        $this->data[$key] = $value;
    }

    /**
     * Regresa todo el contenido de $data
     *
     * @return array
     */
    function getData(){
        return $this->data;
    }


    /**
     * Define el nombre de la vista a ser utilizada en la ruta actual
     *
     * @param string $viewName
     * @return void
     */
    function setView(string $viewName){
        $this->viewName = $viewName;
    }

    /**
     * Renderiza la vista con los datos proporcionados.
     *
     * @return void
     */
    function render(){
        View::render($this->viewName, $this->data);
    }
    
}