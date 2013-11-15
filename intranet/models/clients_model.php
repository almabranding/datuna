<?php
class Clients_Model extends Model {
    public $pag;
    public function __construct() {
        parent::__construct();
        $this->wherepag=(Session::get('role')==1 || Session::get('role')==6)?"WHERE user_id!=0":"WHERE user_id=".Session::get('userid');
    }
    public function searchForm() {
        $action = URL . LANG . '/clients/searchResult';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('addModel', 'POST', $action, $atributes);

        $form->add('hidden', '_add', 'model');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', '', array('autocomplete' => 'off'));
        
        $form->add('label', 'label_email', 'email', 'Email');
        $form->add('text', 'email', '', array('autocomplete' => 'off'));

        $form->add('submit', '_btnsubmit', 'Search');
        $form->validate();
        return $form;
    }
    public function contactForm($type='add',$id='null') {
        $action=($type=='add')?URL.LANG.'/clients/create':URL.LANG.'/clients/edit/'.$id;
        if ($type=='edit')
            foreach ($this->getContacts($id) as $contacts);
        $atributes=array(
            'enctype'    => 'multipart/form-data',
        );
        $form = new Zebra_Form('addContact','POST',$action,$atributes);
        
        $form->add('hidden', '_add', 'contacts');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $contacts['name'], array('autocomplete' => 'off','required'  =>  array('error', 'Name is required!')));
       

        $form->add('label', 'label_email', 'email', 'Mail');
        $obj=$form->add('text', 'email', $contacts['email'], array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'email'     =>  array('error', 'Email address seems to be invalid!'),
        ));
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    public function getContacts($id) {
        return $this->db->select("SELECT * FROM clients WHERE id=".$id);  
    }
    public function getContactsList($pag,$maxpp,$order='updated_at') {
        $min=$pag*$maxpp-$maxpp;
        return $this->db->select("SELECT * FROM clients ".$this->wherepag." ORDER by ".$order." LIMIT ".$min.",".$maxpp); 
    }
    public function contactsToTable($lista) {
        $b['sort']=true;
        $b['title']=array(
           array(
               "title"  =>"Name",
                "link"  => URL.LANG.'/clients/lista/'.$this->pag.'/name',
               "width"  =>"10%"
           ),array(
               "title"  =>"Email",
                "link"  => URL.LANG.'/clients/lista/'.$this->pag.'/email',
               "width"  =>"10%"
           ),array(
               "title"  =>"Updated",
                 "link"  => URL.LANG.'/clients/lista/'.$this->pag.'/updated_at',
               "width"  =>"20%"   
           ),array(
               "title"  =>"Options",
               "width"  =>"10%"
           ));       
        foreach($lista as $key => $value) {
            $b['values'][]=   
            array(
                "name"  =>$value['name'],
                "email"  =>$value['email'],
                "updated"  =>$this->getTimeStamp($value['updated_at']),
                "Options"  =>'<a href="'.URL.LANG.'/clients/editCreateContact/'.$value['id'].'"><button type="button" class="edit"></button></a><a href="'.URL.LANG.'/clients/delete/'.$value['id'].'"><button type="button" class="delete"></button></a>'
            );
        }
        return $b;
    }
    public function create() {
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'user_id' => Session::get('userid'),
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        return $this->db->insert('clients', $data);
       
    }
    public function edit($id){
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('clients', $data, 
            "`id` = '{$id}'");
    }
    public function delete($id){
         $this->db->delete('contacts', "`id` = {$id}");
    }   
    public function getResultSearch() {
        $sql = 'SELECT * FROM clients ' . $this->wherepag . ' AND (';
        if ($_POST['name'] != '') {
            $models = explode(", ", $_POST['name']);
            foreach ($models as $key => $value) {
                $sql.=' name LIKE "%' . $value . '%" OR';
            }
            $sql = substr($sql, 0, -3);
            $sql.=') AND';
        }
        if ($_POST['email'] != '') {
            $models = explode(", ", $_POST['email']);
            foreach ($models as $key => $value) {
                $sql.=' email LIKE "%' . $value . '%" OR';
            }
            $sql = substr($sql, 0, -3);
            $sql.=') AND';
        }
        $sql = substr($sql, 0, -3);
        $sql.=' ORDER by name';
        return $this->db->select($sql);
    }
}