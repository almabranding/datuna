<?php

class Pages extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/pages/lista');  
    }
    public function lista($pag=1,$order='name') 
    {
        $this->view->list=$this->model->pagesToTable($this->model->getPages($pag,NUMPP,$order),$order);
        $this->view->render('pages/list');  
    }
    public function view($id) 
    {
        $this->view->page=$this->model->getPage($id);
        $this->view->form=$this->model->editForm('edit',$id);
        $this->view->render('pages/view');  
    }
     public function addPage() 
    {
    
    }
    public function add() 
    {
       $id=$this->model->add();
       header('location: ' . URL . LANG . '/pages/view/'.$id);
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/pages/lista');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/pages/lista');
    }
    
}