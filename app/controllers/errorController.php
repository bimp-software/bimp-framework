<?php 

class errorController extends Controller implements ControllerInterface{
    
    function __construct(){
    }

    function index(){
        $this->setTitle('Error 404');
        $this->addToData('pagina','error');
        $this->setView('404');
        $this->render();
    }

    
}