<?php

class Agencies extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('agencies/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
        if(Session::get('role')==4) header('location: ' . URL . LANG . '/models/lista/');
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->modelsPackage=$this->model->modelsPackage($id);
        $this->view->render('agencies/view');  
    }
    public function lista($pag=1,$order='name ASC') 
    {
        $maxpp=35;
        $this->model->pag=$pag;
        $this->view->list=$this->model->agenciesToTable($this->model->getAgenciesList($order),$order);
        $this->view->render('agencies/list');  
    }
    public function editCreateAgency($id=null) 
    {
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->agencyForm($type,$id);
        $this->view->render('agencies/editAgency');  
    }
   
    public function create() 
    {
        $id=$this->model->create();
        header('location: ' . URL . LANG . '/agencies/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/agencies/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/agencies/lista/');
    }
    
}