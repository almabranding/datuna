<?php
class Page_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    
    function getGallery($id) {
        return $this->db->select('SELECT * FROM photos p JOIN projects_photos pp on (pp.photo_id=p.id) WHERE pp.project_id = :id AND pp.visibility="public" order by pp.position', array('id' => $id));
    }
    function getProject($id) {
        return $this->db->selectOne('SELECT * FROM projects p WHERE p.id = :id', array('id' => $id));
    }
    
}