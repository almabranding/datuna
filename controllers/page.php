<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    public function view($url,$pic=true) {
        $this->view->js = array('page/js/custom.js');
        $this->view->url=$url;
        $this->view->page=$this->model->getPage($url);
        $this->view->gallery=$this->model->getGallery($this->view->page['id']);
        $this->view->render('page/index');
    }
    public function section($url,$pic=true) {
        $this->view->js = array('page/js/custom.js');
        $this->view->url=$url;
        $this->view->page=$this->model->getPage($url);
        $this->view->gallery=$this->model->getGallery($this->view->page['id']);
        $this->view->render('page/section');
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