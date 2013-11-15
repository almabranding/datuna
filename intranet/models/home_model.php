<?php

class Home_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function formImage($type = 'add', $id = 'null') {

        $action = ($type == 'add') ? URL . LANG . '/home/editImage' : URL . LANG . '/home/editImage/' . $id;
        if ($type == 'edit')
            foreach ($this->getImageInfo($id) as $value)
                ;

        $form = new Zebra_Form('addProject', 'POST', $action);
        $pathinfo = pathinfo($value['img']);
        $form->add('hidden', '_add', 'page');
        $form->add('hidden', 'model_id', $value['model_id']);
        $form->add('hidden', 'originalName', $value['img']);
        $form->add('hidden', 'fileExt', $pathinfo['extension']);

        $form->add('label', 'label_caption', 'caption', 'Caption');
        $obj = $form->add('text', 'caption', $value['caption'], array('autocomplete' => 'off'));

        $form->add('label', 'label_link', 'link', 'Link');
        $obj = $form->add('text', 'link', $value['link'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_vimeo', 'vimeo', 'Vimeo');
        $obj = $form->add('text', 'vimeo', $value['vimeo'], array('autocomplete' => 'off'));
        
        foreach ($this->_langs as $lng) {
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_rule(array(
                'length' => array(6, 10, 'error', 'The password must have between 6 and 10 characters'),
            ));
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, ($value['content_' . $lng]), array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

   
    public function getImageInfo($id) {
        return $this->db->select('SELECT * FROM photos p JOIN home_photos mp ON(p.id=mp.photo_id) WHERE p.id = :id', array('id' => $id));
    }

    public function getModel($id) {
        return $this->db->select('SELECT * FROM models WHERE id=' . $id);
    }


    public function sort(){
        foreach($_POST['foo'] as $key=>$value){
            $data = array(
                'position' => $key
            );
             $this->db->update('home_photos', $data, 
            "`photo_id` = '{$value}' AND `section_id` = '{$_POST['id']}'");
        }
        exit;
    }
    public function deleteImages() {
        $cont = 0;
        foreach ($_POST['check'] as $key => $value) {
            $package = explode("_", $value);
            $cont++;
            $this->delTree(UPLOAD . 'models/' . $this->idToRute($package[1]));
            $this->db->delete('photos', "`id` = {$package[1]}");
            $this->db->delete('home_photos', "`photo_id` = {$package[1]} AND `section_id` = {$package[0]}");
        }
        Logs::set("Ha borrado " . $cont . " fotos de la home ");
        exit;
    }
    public function editImage($id) {
        $photoInfo=$this->getImageInfo($id);
        Logs::set("Ha modificado una imagen de la home");
        $data = array(
            'caption'   => $_POST['caption'],
            'vimeo'     => $_POST['vimeo'],
            'link'      => $_POST['link'],
            'updated_at'=> $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        $this->db->update('home_photos', $data, "`photo_id` = '{$id}'");
        return $photoInfo[0]['section_id'];
    }
    
    public function getImagesSection($id) {
        
        return $this->db->select("SELECT * FROM home_photos hp JOIN photos p on (hp.photo_id=p.id) WHERE hp.section_id=".$id." ORDER by position");
    }
    public function getSectionsList() {
        
        return $this->db->select("SELECT * FROM home_sections ORDER by name");
    }
    public function getSection($id) {
        $section=$this->db->select("SELECT name FROM home_sections WHERE id=".$id);
        return $section;
    }
    public function toTable($lista) {
        $b['sort']=true;
        $b['title']=array(
          array(
               "title"  =>"Section",
               "width"  =>"10%"
           ),array(
               "title"  =>"Options",
               "width"  =>"10%"
           ));       
        foreach($lista as $key => $value) {
            $section=$this->getSection($value['id']);
            $b['values'][]=   
            array(
                "Section"   =>$section[0]['name'],
                "Options"  =>'<a href="'.URL.LANG.'/home/view/'.$value['id'].'"><button title="Edit" type="button" class="edit"></button></a>'
         
            );
        }
        return $b;
    }

}