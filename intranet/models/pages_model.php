<?php

class Pages_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function editForm($type = 'add', $id = 'null') {
        $action = ($type == 'add') ? URL . '/pages/add' : URL . '/pages/edit/' . $id;
        if ($type == 'edit')
            $value = $this->getPage($id);
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('editPage', 'POST', $action, $atributes);
        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $value['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

        foreach ($this->_langs as $lng) {
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
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
    public function getPages($id) {
        return $this->db->select('SELECT * FROM pages');
    }
    public function pagesToTable($lista,$order='name asc') {
        $order=  explode(' ', $order);
        $orden=(strtolower($order[1])=='desc')?' ASC':' DESC';
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Id",
                "link" => URL . LANG . '/pages/list/' . $this->pag . '/id'.$orden,
                "width" => "5%"
            ),
            array(
                "title" => "Page name",
                "link" => "#",
                "width" => "15%"
            ),
            array(
                "title" => "Template",
                "link" => "#",
                "width" => "10%"
            ), array(
                "title" => "Date",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/created_at'.$orden,
                "width" => "12%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] =
                    array(
                        "id" => $value['id'],
                        "Name" => $value['name'],
                        "Template" => $value['template'],
                        "Date" => $this->getTimeStamp($value['updated_at']),
                        "Options" => '<a href="' . URL .'pages/view/' .$value['id'].'"><button title="Edit" type="button" class="edit"></button></a>'
            );
        }
        return $b;
    }
    public function getPage($id) {
        return $this->db->selectOne('SELECT * FROM pages WHERE id=' . $id);
    }

   

    public function edit($id) {
        $data = array(
            'name'          => $_POST['name'],
            'template'      => $_POST['templates'],
            'updated_at'    => $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        $this->db->update('pages', $data, "`id` = '{$id}'");
    }

    public function add() {
        $data = array(
            'name' => $_POST['name'],
            'template' => $_POST['templates'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        foreach ($this->_langs as $lng) {
            $data['content_list_' . $lng] = stripslashes($_POST['content_list_' . $lng]);
        }
        $project_id = $this->db->insert('pages', $data);
        return $project_id;
    }

 

}
