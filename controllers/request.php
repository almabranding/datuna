<?php

class Request extends Controller {

    function __construct() {
        parent::__construct();
    }
    public function light($id) {
        $this->model->getLight($id);
    }  
}