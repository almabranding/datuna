<?php
class Index_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
//    function getProjects($pag,$numpp) {
//        $min = $pag * $numpp - $numpp;
//        return $this->db->select("SELECT * FROM projects p JOIN projects_photos pp on (pp.project_id=p.id) JOIN photos ph on (ph.id=pp.photo_id) WHERE pp.thumb=1 ORDER BY p.position LIMIT " . $min . "," . $numpp);
//    }
//    public function countProjects($pag) {
//        $count=$this->db->selectOne("SELECT count(p.id) as count FROM projects p JOIN projects_photos pp on (pp.project_id=p.id) JOIN photos ph on (ph.id=pp.photo_id) WHERE pp.thumb=1");
//        $pags['now']=$pag;
//        $pags['min']=1;
//        $pags['max']=(int)($count['count']/NUMPP);
//        return $pags;
//    }
}