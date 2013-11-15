<?php
class Request_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function getLight($id) {
        $img = $this->db->select("SELECT * FROM images WHERE 
                id = :id",array('id'=>$id));
        $data['ruta']=IMAGES.$img[0]['page'].'/'.$img[0]['img'];
        echo $data['ruta']; 
    }
    
    
}