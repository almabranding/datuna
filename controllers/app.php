<?php

class App extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    public function getProjects() {
        echo $_GET['jsoncallback']. '(' . json_encode($this->model->getProjects()) . ');';
    }
    public function getProject($id) {
        echo $_GET['jsoncallback']. '(' . json_encode($this->model->getProject($id)) . ');';
    }
    public function getGallery($id){
        echo $_GET['jsoncallback']. '(' . json_encode($this->model->getGallery($id)) . ');';
    }
    

}