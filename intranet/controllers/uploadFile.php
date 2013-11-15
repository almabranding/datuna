<?php

class uploadFile extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function upload($added='model',$Id=0) {
       $img=$this->model->upload('temp/');
       if(!$img['nameFile']) return; 
       $imgId=$this->model->insertImg($img);
       switch($added){
           case 'project': $this->model->insertProject($imgId,$Id);break;
           case 'models': $this->model->insertModel($imgId,$Id);break;
           case 'section': $this->model->insertSection($imgId,$Id);break;
       }
       
    }
    function orderByName($model,$num){
        $this->model->orderByName($model,$num);
    }
    function crop() {
       $this->model->crop();
       header('location: ' . URL . 'models/editportafolio/'.$_POST['model_id']);
    }
}