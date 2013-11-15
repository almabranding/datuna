<?php

class About extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('about/js/custom.js');
    }
    
    function index() {
        $this->view->page = $this->model->getPage('about');
        $this->view->render('about/index');
    }
    
}