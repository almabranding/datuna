<?php

class File extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() {
        $this->view->render('index/index');  
    }
    public function delete($page,$id) 
    {
        $this->model->delete($id);
        header('location: ' . URL .LANG. '/page/view/'.$page);
    }

}