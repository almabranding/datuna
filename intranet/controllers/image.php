<?php

class Image extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() {
        $this->view->render('index/index');  
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formImage('edit',$id);
        $this->view->img=$this->model->getImageInfo($id);
        $this->view->project_id=$this->view->img['project_id'];
        $this->view->render('image/view');  
    }
    public function edit($id) 
    {
        $model=$this->model->editImage($id);
        header('location: ' . URL .LANG . '/projects/gallery/'.$model);  
    }
    public function delete($page,$id) 
    {
        $this->model->delete($id);
        header('location: ' . URL .LANG. '/page/view/'.$page);
    }
    function crop() {
       $this->model->crop();
       header('location: ' . URL . 'projects/gallery/'.$_POST['model_id']);
    }

}