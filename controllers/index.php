<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('index/js/custom.js');
    }
    
    function index($pag=1) {
        $project=$this->loadSingleModel('project');
        $this->view->projects = $project->getProjects($pag,NUMPP);
        $this->view->pag = $project->countProjects($pag);
        $this->view->render('index/index');
    }
    
}