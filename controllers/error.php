<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('error/js/custom.js');
    }
    
    function index() {
        $this->view->render('error/index');
    }

}