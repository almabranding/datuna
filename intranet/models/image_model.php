<?php

class Image_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formImage($type = 'add', $id = 'null') {
        $action = ($type == 'add') ? URL . LANG . '/image/edit' : URL . LANG . '/image/edit/' . $id;
        if ($type == 'edit')
            $value = $this->getImageInfo($id);

        $form = new Zebra_Form('editPhoto', 'POST', $action);
        $pathinfo = pathinfo($value['img']);
        $form->add('hidden', '_add', 'page');
        $form->add('hidden', 'model_id', $value['model_id']);
        $form->add('hidden', 'originalName', $value['img']);
        $form->add('hidden', 'fileExt', $pathinfo['extension']);
        $form->add('label', 'label_caption', 'caption', 'Caption');
        $obj = $form->add('text', 'caption', $value['caption'], array('autocomplete' => 'off'));
        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', '');
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
        ),$value['visibility']);
        
        
        
        $form->add('label', 'label_isvideo', 'isvideo', 'Video');
        $obj = $form->add('radios', 'isvideo', array(
            '1' => 'Yes',
            '0' => 'No',
        ),$value['isVideo']);

        $form->add('label', 'label_video', 'video', 'Embed Video');
        $obj=$form->add('text', 'video', $value['video'], array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'required' => array('error', 'Video code is required!'),
            'dependencies' => array(array(
                'isvideo' => '1',
            ), 'mycallback, 1'),
        ));

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function editImage($id) {
        $Models_photos = $this->getProjectByPhotos($id);
        //Logs::set("Ha modificado una imagen del proyecto " . $Models_photos['name']);
        $data = array(
            'caption' => $_POST['caption'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('photos', $data, "`id` = '{$id}'");
        $data = array(
            'visibility' => $_POST['visibility'],
            'isVideo' => $_POST['isvideo'],
            'video' => $_POST['video'],
        );
        $this->db->update('projects_photos', $data, "`photo_id` = '{$id}'");
        return $Models_photos['project_id'];
    }
    public function getProjectByPhotos($photo_id) {
        return $this->db->selectOne('SELECT * FROM projects_photos jp JOIN projects p on (p.id=jp.project_id) where jp.photo_id=' . $photo_id);
    }

    public function getImageInfo($id) {
        return $this->db->selectOne('SELECT * FROM photos p JOIN projects_photos mp ON(p.id=mp.photo_id) WHERE p.id = :id', array('id' => $id));
    }

    public function crop() {
        $original = $_POST['original'];
        $filename = $_POST['filename'];
        $filepath = UPLOAD . $_POST['filefolder'] . '/';
        $rel = $_POST['rel'];
        $targ_w = $_POST['w'] * $rel;
        $targ_h = $_POST['h'] * $rel;
        $src = $filepath . $original;
        $dst = $filepath . $filename;
        $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

        $img_r = imagecreatefromjpeg($src);
        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'] * $rel, $_POST['y'] * $rel, $targ_w, $targ_h, $_POST['w'] * $rel, $_POST['h'] * $rel);
        imagejpeg($dst_r, $dst, 100);
        if (!$_POST['thumbnail']) {
            $thumb = new thumb();
            $thumb->loadImage($filepath . $filename);
            $thumb->resize(1800, 'width');
            $thumb->save($filepath . $filename);
            $thumb->loadImage($filepath . $filename);
            $thumb->resize(500, 'width');
            $thumb->save($filepath . 'med_' . $filename);
        }
        //$this->createThumbs($filename,$filepath, $filepath, $thumbWidth );
    }

}
