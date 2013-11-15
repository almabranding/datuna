<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('login/js/custom.js','login/js/jquery.ez-bg-resize.js');
    }
    
    function index() {
        $this->view->render('login/index',true);
    }
    function run() {
        $this->model->run();
    }
    
}