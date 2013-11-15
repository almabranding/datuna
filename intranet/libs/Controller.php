<?php
class Controller {
    private $_langs;
    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
        $this->_langs=  Bootstrap::getLang();
    }
    
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }        
        $this->model->_langs=$this->_langs;
        $this->view->_langs =$this->_langs;
    }
    public function loadSingleModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $model=new $modelName();
            return $model;
        }        
    }

}