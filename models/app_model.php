<?php
class App_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    function getProjects() {
        return $this->db->select("SELECT * FROM projects p JOIN projects_photos pp on (pp.project_id=p.id) JOIN photos ph on (ph.id=pp.photo_id) WHERE pp.thumb=1 AND p.visibility='public' ORDER BY p.position");
    }
    function getProject($id) {
        return $this->db->select("SELECT * FROM projects WHERE id = :id", array('id' => $id));
    }
    function getGallery($id) {
        return $this->db->select('SELECT * FROM photos p JOIN projects_photos pp on (pp.photo_id=p.id) WHERE pp.project_id = :id AND pp.visibility="public" order by pp.position', array('id' => $id));
    }
    
    
}