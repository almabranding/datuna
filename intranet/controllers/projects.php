<?php

class Projects extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/projects/lista');  
    }
    public function lista($pag=1) 
    {
        $this->view->js = array('projects/js/list.js');
        $this->view->models=$this->model->getModels($pag);
        $this->view->render('projects/list');  
    }
    public function view($id) 
    {
        $this->view->project=$this->model->getModel($id);
        $this->view->form=$this->model->editProjectForm('edit',$id);
        $this->view->render('projects/view');  
    }
    public function gallery($id) 
    {
        $this->view->js = array('projects/js/gallery.js');
        $this->view->id=$id;
        $this->view->model=$this->model->getModel($id);
        $this->view->modelPhotos=$this->model->getModelPhotos($id);
        $this->view->render('projects/gallery');  
    }
     public function addproject() 
    {
        $this->view->form=$this->model->editProjectForm('add');
        $this->view->render('projects/view'); 
    }
    public function deleteModel($id) 
    {
        $this->model->deleteModel($id);
        header('location: ' . URL . LANG . '/projects/lista');  
    }
    public function searchModel() 
    {
        $this->view->searchModel=$this->model->searchForm();
        $this->view->models=$this->model->getModelSearch();
        $this->view->categories=$this->model->getModelsCategories();
        $this->view->render('projects/list');  
    }
    public function add() 
    {
       $id=$this->model->add();
       header('location: ' . URL . LANG . '/projects/gallery/'.$id);
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/projects/lista');
    }
    public function delete($id) 
    {
        $this->model->deleteModel($id);
        header('location: ' . URL . LANG .  '/projects/lista');
    }
    public function imagesSort() 
    {
        $this->model->imagesSort();
    }
    public function projectsSort() 
    {
        $this->model->projectsSort();
    }
    public function deleteImages() 
    {
        $this->model->deleteImages();
    }
    public function deleteImage($model_id,$id) 
    {
        $this->model->deleteImage($id);
        header('location: ' . URL .LANG . '/projects/gallery/'.$model_id);  
    }
    public function selectThumbnail() 
    {
        $this->model->selectThumbnail();
    }
    public function saveInputs(){
        $this->model->saveInputs();
    }
    
}