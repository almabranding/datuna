<?php

class Download extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    function index() {
        $this->view->render('error/index');
    }
    public function run($folder,$file) {
        $this->model->download($folder,$file);
    }
    

}