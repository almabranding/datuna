<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('home/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
        if(!Session::get('role')==4) header('location: ' . URL . LANG . '/models/lista/');
    }
    function index() { 
        header('location: '.URL.LANG.'/models/lista');  
    }
    public function viewOld($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->form('edit',$id);
        $this->view->Gallery=$this->model->getGallery($id);
        $this->view->Files=$this->model->getFiles($id);
        $this->view->render('models/view');  
    }
    public function lista() 
    {
        $this->view->list=$this->model->toTable($this->model->getSectionsList());
        $this->view->render('home/list');  
    }
     
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->section=$this->model->getSection($id);
        $this->view->modelPhotos=$this->model->getImagesSection($id);
        $this->view->render('home/editportafolio');  
    }
    public function addImage() 
    {
       $id=$this->model->add();
       header('location: ' . URL . LANG . '/home/view/'.$id);
    }
    public function sort() 
    {
        $this->model->sort();
    }
    public function deleteImages() 
    {
        $this->model->deleteImages();
    }
    public function viewImage($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formImage('edit',$id);
        $this->view->img=$this->model->getImageInfo($id);
        $this->view->model_id=$this->view->img[0]['section_id'];
        $this->view->render('home/viewimage');  
    }
    public function editImage($id) 
    {
        $section=$this->model->editImage($id);
        header('location: ' . URL .LANG . '/home/view/'.$section);  
    }
    
}