<?php
class Project_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    function getGallery($id) {
        return $this->db->select('SELECT * FROM photos p JOIN projects_photos pp on (pp.photo_id=p.id) WHERE pp.project_id = :id AND pp.visibility="public" order by pp.position', array('id' => $id));
    }
    function getProject($id) {
        return $this->db->selectOne('SELECT * FROM projects p WHERE p.id = :id', array('id' => $id));
    }
    function getProjects($pag,$numpp) {
        $min = $pag * $numpp - $numpp;
        return $this->db->select("SELECT * FROM projects p JOIN projects_photos pp on (pp.project_id=p.id) JOIN photos ph on (ph.id=pp.photo_id) WHERE pp.thumb=1 AND p.visibility='public' ORDER BY p.position LIMIT " . $min . "," . $numpp);
    }
    public function countProjects($pag) {
        $count=$this->db->selectOne("SELECT count(p.id) as count FROM projects p JOIN projects_photos pp on (pp.project_id=p.id) JOIN photos ph on (ph.id=pp.photo_id) WHERE pp.thumb=1 AND p.visibility='public'");
        $pags['now']=$pag;
        $pags['min']=1;
        $pags['max']=(int)($count['count']/NUMPP);
        $pags['max']+=($count['count']%NUMPP==0)?0:1;
        return $pags;
    }
    
}