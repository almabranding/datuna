<?php

class Project extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    function pag($pag=1) {
        $this->view->projects = $this->model->getProjects($pag,NUMPP);
        $this->view->pag = $this->model->countProjects($pag);
        $this->view->render('index/index');
    }
    public function gallery($id) {
        $this->view->js = array('gallery/js/masonry.pkgd.min.js','gallery/js/custom.js');
        $name=explode('-', $id);
        $this->view->gallery=$this->model->getGallery($name[0]);
        $this->view->project=$this->model->getProject($name[0]);
        if($this->view->project['template']=='dark')  $this->view->css = array('gallery/css/dark.css');
        $this->view->render('gallery/index');
    }
    
}