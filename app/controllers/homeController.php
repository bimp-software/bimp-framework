<?php

use Bimp\Framework\Controller;
use Bimp\Framework\Interface\ControllerInterface;

class homeController extends Controller implements ControllerInterface{

    function index(){
        $this->setSlug('home');
        $this->render();
    }
}