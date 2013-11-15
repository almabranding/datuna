<?php

class Projects_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /*    public function searchForm($url = '/project/searchModel') {
      $action = URL . LANG . $url;
      $atributes = array(
      'enctype' => 'multipart/form-data',
      );
      $form = new Zebra_Form('searchModel', 'GET', $action, $atributes);

      $form->add('hidden', '_add', 'model');

      $form->add('label', 'label_name', 'name', 'Name');
      $form->add('text', 'name', '', array('autocomplete' => 'off'));


      $form->add('label', 'label_modelList', 'modelList', 'Model:');
      $obj = $form->add('select', 'modelList', '', array('autocomplete' => 'off'));
      foreach ($this->getAllModels() as $key => $value) {
      $obt[$value['name']] = $value['name'];
      }
      $obj->add_options($obt);
      unset($obt);


      $form->add('label', 'label_notifications', 'notifications', 'Advanced Search');
      $obj = $form->add('checkboxes', 'notifications', array(
      'yes' => '',
      ), array('autocomplete' => 'off'));

      $form->add('label', 'label_category', 'category', 'Category');
      $obj = $form->add('select', 'category', '', array('autocomplete' => 'off'));
      foreach ($this->getModelsCategories() as $key => $value) {
      $obt[$value['id']] = $value['name'];
      }
      if ($obt)
      $obj->add_options($obt);

      unset($obt);





      $form->add('submit', '_btnsubmit', 'Search');
      $form->validate();
      return $form;
      } */

    public function editProjectForm($type = 'add', $id = 'null') {
        $action = ($type == 'add') ? URL . '/projects/add' : URL . '/projects/edit/' . $id;
        if ($type == 'edit')
            $value = $this->getModel($id);
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('editProject', 'POST', $action, $atributes);

        $form->add('hidden', '_add', 'model');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $value['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));


        $form->add('label', 'label_templates', 'templates', 'Template');
        $obj = $form->add('select', 'templates', $value['template'], array('autocomplete' => 'off'));
        $obt['light'] = 'Light';
        $obt['dark'] = 'Dark';
        $obj->add_options($obt, true);
        unset($obt);
        
        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $value['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
        ),true);
        
        foreach ($this->_langs as $lng) {
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, ($value['content_' . $lng]), array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
            $obj = $form->add('textarea', 'content_list_' . $lng, ($value['content_list_' . $lng]), array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getImageInfo($id) {
        return $this->db->selectOne('SELECT * FROM photos p JOIN projects_photos mp ON(p.id=mp.photo_id) WHERE p.id = :id', array('id' => $id));
    }

    public function getModel($id) {
        return $this->db->selectOne('SELECT * FROM projects WHERE id=' . $id);
    }

    public function getModelSearch() {
        $models = null;
        //$sql=($_GET['name']!='' || $_GET['active']!='' || $_GET['sex']!='' || $_GET['mother_agency_id']!='' || $_GET['based_in']!='')?'SELECT * FROM models WHERE ':'SELECT * FROM models';
        $sql1 = 'SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) WHERE mp.main=1 AND';
        $sql2 = 'SELECT id as model_id FROM models WHERE ';

        if ($_GET['name'] != '') {
            $cadena = str_replace(', ', ',', $_GET['name']);
            $models = explode(",", $cadena);
            $sql.='( ';
            foreach ($models as $key => $value)
                $sql.=' name LIKE "%' . $value . '%" OR';
            $sql = substr($sql, 0, -3);
            $sql.=') AND ';
        }
        $sql.=($_GET['height_from'] != '' && $_GET['height_to'] != '') ? ' m.height BETWEEN ' . $_GET['height_from'] . ' AND ' . $_GET['height_to'] . ' AND ' : '';
        $sql.=($_GET['hairtype'] != '') ? ' hair_type_id=' . $_GET['hairtype'] . ' AND' : '';
        $sql.=($_GET['eyetype'] != '') ? ' eye_type_id=' . $_GET['eyetype'] . ' AND' : '';
        $sql.=($_GET['based_in'] != '') ? ' based_in=' . $_GET['based_in'] . ' AND' : '';
        $sql.=($_GET['mother_agency_id'] != '') ? ' mother_agency_id=' . $_GET['mother_agency_id'] . ' AND' : '';
        $sql.=($_GET['active'] != '') ? ' active=' . $_GET['active'] . ' AND' : ' active=1 AND';
        $sql.=($_GET['sex'] != '') ? ' sex=' . $_GET['sex'] . ' AND' : '';
        $sql.=($_GET['category'] != '') ? ' category_id=' . $_GET['category'] . ' AND' : '';

        $sql = substr($sql, 0, -3);
        $sql1.=$sql;
        $sql2.=$sql;
        $sql1.=' ORDER by name';
        $sql2.=' ORDER by name';
        $res1 = $this->db->select($sql1);
        $res2 = $this->db->select($sql2);
        if ($res1) {
            return $res1;
        } else
            return $res2;
    }

    public function getModelPhotos($id) {
        return $this->db->select('SELECT * FROM projects_photos mp join photos p on(mp.photo_id=p.id) WHERE project_id = :id ORDER by position', array('id' => $id));
    }

    public function getModels($pag, $numpp = 1000) {
        $min = $pag * $numpp - $numpp;
        $models = $this->db->select('SELECT * FROM projects m ORDER by position LIMIT ' . $min . ',' . $numpp);
        foreach ($models as $key => $model) {
            $photo = $this->db->selectOne('SELECT * FROM projects m JOIN projects_photos mp on(m.id=mp.project_id) join photos p on(mp.photo_id=p.id) WHERE m.id=' . $model['id'] . ' AND mp.thumb=1');
            $result[$key]['project_id'] = $model['id'];
            $result[$key]['name'] = $model['name'];
            $result[$key]['photo_id'] = $photo['photo_id'];
            $result[$key]['caption'] = $photo['caption'];
            $result[$key]['file_name'] = $photo['file_name'];
        }
        return $result;
        //return $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) WHERE mp.main=1 ORDER by m.updated_at DESC LIMIT ' . $min . ',' . $numpp);
    }

    public function getProjectByPhotos($photo_id) {
        return $this->db->selectOne('SELECT * FROM projects_photos jp JOIN projects p on (p.id=jp.project_id) where jp.photo_id=' . $photo_id);
    }

    public function edit($id) {
        $data = array(
            'name'          => $_POST['name'],
            'template'      => $_POST['templates'],
            'visibility'    => $_POST['visibility'],
            'updated_at'    => $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        foreach ($this->_langs as $lng) {
            $data['content_list_' . $lng] = stripslashes($_POST['content_list_' . $lng]);
        }
        $this->db->update('projects', $data, "`id` = '{$id}'");
    }

    public function add() {
        $data = array(
            'name' => $_POST['name'],
            'template' => $_POST['templates'],
            'visibility' => $_POST['visibility'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        foreach ($this->_langs as $lng) {
            $data['content_list_' . $lng] = stripslashes($_POST['content_list_' . $lng]);
        }
        $project_id = $this->db->insert('projects', $data);
        //$modelo = $this->getModel($project_id);
        //Logs::set("Ha añadido el projecto " . $modelo['name']);
        return $project_id;
    }

    public function deleteModel($id) {
        $modelo = $this->getModel($id);
        $this->db->delete('projects', "`id` = {$id}");
        Logs::set("Ha borrado el projecto " . $id . " " . $modelo['name']);
    }

    public function imagesSort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('projects_photos', $data, "`photo_id` = '{$value}'");
        }
        exit;
    }

    public function projectsSort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('projects', $data, "`id` = '{$value}'");
        }
        exit;
    }

    public function deleteImages() {
        $cont = 0;
        //$img = $this->db->selectOne('SELECT * FROM models_photos WHERE photo_id = :id', array('id' => $_POST['check'][0]));
        //$modelo = $this->getModel($img['project_id']);
        foreach ($_POST['check'] as $key => $value) {
            $cont++;
            $this->delTree(UPLOAD . 'images/' . $this->idToRute($value));
            $this->db->delete('photos', "`id` = {$value}");
            $this->db->delete('projects_photos', "`photo_id` = {$value}");
        }
        //Logs::set("Ha borrado " . $cont . " fotos del modelo " . $modelo['name']);
        exit;
    }

    public function deleteImage($id) {
        $this->delTree(UPLOAD . 'models/' . $this->idToRute($id));
        $this->db->delete('photos', "`id` = {$id}");
        $this->db->delete('projects_photos', "`photo_id` = {$id}");
        $img = $this->db->selectOne('SELECT * FROM models_photos WHERE photo_id = :id', array('id' => $id));
        //$modelo = $this->getModel($img['model_id']);
        //Logs::set("Ha borrado una foto del modelo " . $modelo['name']);
        return $img['project_id'];
    }

    public function selectThumbnail() {
        foreach ($_POST['check'] as $key => $value) {
            $data = array(
                'thumb' => 0
            );
            $this->db->update('projects_photos', $data, "`project_id` = '{$_POST['project_id']}'");
            $data = array(
                'thumb' => 1
            );
            $this->db->update('projects_photos', $data, "`photo_id` = '{$value}'");
        }

        $modelo = $this->getModel($_POST['project_id']);
        Logs::set("Ha cambiado el headsheet del modelo " . $modelo['name']);
        exit;
    }

    public function saveInputs() {
        foreach ($_POST['visibility'] as $key => $value) {
            $data = array(
                'visibility' => $value
            );
            $this->db->update('projects_photos', $data, "`photo_id` = '{$key}'");
        }
    }

}
