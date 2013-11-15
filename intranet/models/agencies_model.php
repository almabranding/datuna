<?php
class Agencies_Model extends Model {
    public $pag;
    public function __construct() {
        parent::__construct();
    }
    public function agencyForm($type='add',$id='null') {
        $action=($type=='add')?URL.LANG.'/agencies/create':URL.LANG.'/agencies/edit/'.$id;
        if ($type=='edit')
            foreach ($this->getAgency($id) as $contacts);
        $atributes=array(
            'enctype'    => 'multipart/form-data',
        );
        $form = new Zebra_Form('addAgency','POST',$action,$atributes);
        
        $form->add('hidden', '_add', 'contacts');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $contacts['name'], array('autocomplete' => 'off','required'  =>  array('error', 'Name is required!')));
       
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    public function getAgency($id) {
        return $this->db->select("SELECT * FROM mother_agencies WHERE id=".$id);  
    }
    public function getAgenciesList($order='name') {
        return $this->db->select("SELECT * FROM mother_agencies ORDER by ".$order);  
    }
    public function agenciesToTable($lista,$order) {
        $order=  explode(' ', $order);
        $orden=(strtolower($order[1])=='desc')?' ASC':' DESC';
        $b['sort']=true;
        $b['title']=array(
           array(
               "title"  =>"Name",
                "link"  => URL.LANG.'/agencies/lista/'.$this->pag.'/name'.$orden,
               "width"  =>"10%"
           ),array(
               "title"  =>"Updated",
                 "link"  => URL.LANG.'/agencies/lista/'.$this->pag.'/updated_at'.$orden,
               "width"  =>"20%"   
           ),array(
               "title"  =>"Options",
               "width"  =>"10%"
           ));       
        foreach($lista as $key => $value) {
            $b['values'][]=   
            array(
                "name"  =>$value['name'],
                "updated"  =>$this->getTimeStamp($value['updated_at']),
                "Options"  =>'<a href="'.URL.LANG.'/agencies/editCreateAgency/'.$value['id'].'"><button title="Edit" type="button" class="edit"></button></a><button title="Delete" type="button" class="delete" onclick="borrarPackList(\''.$value['id'].'\');"></button>'
            );
        }
        return $b;
    }
    public function create() {
        $data = array(
            'name' => $_POST['name'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        return $this->db->insert('mother_agencies', $data);
       
    }
    public function edit($id){
        $data = array(
            'name' => $_POST['name'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('mother_agencies', $data, 
            "`id` = '{$id}'");
    }
    public function delete($id){
         $this->db->delete('mother_agencies', "`id` = {$id}");
    }   
}