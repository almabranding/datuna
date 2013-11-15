<?php
class Controller {

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }
    
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name,$control='', $modelPath = 'models/') {
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }  
        $this->loadLang($name);
        
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
    public function loadLang($name, $langPath = 'lang/en/') {
        Session::init();
        $lang=Session::get('lang');
        $langPath='lang/'.$lang.'/';
        require $langPath .'default.php';
        $path = $langPath . $name.'.php';
        if (file_exists($path)) {
            require $path;
        }
        $this->model->setLang($lang);
        $this->view->lang = $lang;
    }

}