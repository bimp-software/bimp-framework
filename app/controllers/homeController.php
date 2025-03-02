<?php


class homeController extends Controller implements ControllerInterface
{

    function __construct(){
        parent::__construct();
    }

    /*
    INDEX
    */
    function index(){
        $this->setTitle('Inicio');
        $this->addToData('slug','home');
        $this->addToData('description',NULL);
        $this->setView('home');
        $this->render();
    }

    
    /*
    DOCUMENTACION
    */
    function documentacion(){
        header("Location: http://localhost/bimp-framework/");
        exit;
    }

    function videojuegos(){
        header("Location: http://localhost/bimp-videojuegos/");
        exit;
    }
}
