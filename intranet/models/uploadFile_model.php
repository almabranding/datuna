<?php

class uploadFile_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function upload($sub = '', $name = 'pic') {
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc');
        $allowed_img = array('jpg', 'jpeg', 'png', 'gif');
        if (!is_dir(UPLOAD))
            mkdir(UPLOAD);
        $uploadDir = UPLOAD . $sub . '/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir);
        if (array_key_exists($name, $_FILES) && $_FILES[$name]['error'] == 0) {
            $pathinfo = pathinfo($_FILES[$name]["name"]);
            $nameFile = (file_exists($uploadDir . $_FILES[$name]["name"])) ? $pathinfo['filename'] . '_' . rand() : $pathinfo['filename'];
            $file = $nameFile . '.' . $pathinfo['extension'];
//            if (filesize($_FILES[$name])>2000)
//                $this->exit_status('Demasiado grande');
            if (!in_array($pathinfo['extension'], $allowed_img))
                $this->exit_status('Only ' . implode(',', $allowed_ext) . ' files are allowed!');
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadDir . $file)) {
                //$data = $this->createThumbs($file, $uploadDir, $uploadDir, $thumbWidth);
                $data['img'] = true;
                if ($pathinfo['extension'] == 'png') {
                    $this->png2jpg($uploadDir . $file, $uploadDir . $nameFile . '.jpg');
                    $file = $nameFile . '.jpg';
                }
                $this->exit_status('File was uploaded successfuly!');
                $data['file'] = $file;
                $data['nameFile'] = $nameFile;
                $data['file_size'] = filesize($uploadDir . $file);
                list($data['width'], $data['height'], $imgType, $atributos) = getimagesize($uploadDir . $file);
                $data['file_content_type'] = image_type_to_mime_type($imgType);
                return $data;
            }
        }

        $this->exit_status('Something went wrong with your upload!');
    }

    function getModel($id) {
        return $this->db->select('SELECT * FROM models WHERE id = :id', array('id' => $id));
    }

    function exit_status($str) {
        echo json_encode(array('status' => $str));
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
        if(!$_POST['thumbnail']){
            $thumb = new thumb();
            $thumb->loadImage($filepath . $filename);
            $thumb->resize(1800, 'width');
            $thumb->save($filepath . $filename);
            $thumb->loadImage($filepath . $filename);
            $thumb->resize(500, 'width');
            $thumb->save($filepath . 'med_'.$filename);
            $thumb->resize(200, 'width');
            $thumb->save($filepath . 'm_' . $filename);
        }
        //$this->createThumbs($filename,$filepath, $filepath, $thumbWidth );
    }

    public function insertImg($img) {
        $photo_id = $this->db->insert('photos', array(
            'file_name' => $img['file'],
            'file_content_type' => $img['file_content_type'],
            'file_size' => $img['file_size'],
            'width' => $img['width'],
            'height' => $img['height'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL()
        ));
        $rute = 'images/';
        $rute.=$this->idToRute($photo_id);
        if (!is_dir(UPLOAD . $rute . 'original'))
            mkdir(UPLOAD . $rute . 'original/', 0777, true);
        copy(UPLOAD . 'temp/' . $img['file'], UPLOAD . $rute . 'original/' . $img['file']);
        $thumb = new thumb();
        $thumb->loadImage(UPLOAD . $rute . 'original/' . $img['file']);
        $thumb->resize(1800, 'width');
        $thumb->save(UPLOAD . $rute . $img['file']);
        $thumb->loadImage(UPLOAD . $rute . 'original/' . $img['file']);
        $thumb->resize(1200, 'width');
        $thumb->save(UPLOAD . $rute . 'med_' . $img['file']);
        $thumb->crop(500, 310);
        $thumb->save(UPLOAD . $rute . 'thumb_' . $img['file']);
        /*mobil*/
        $thumb->loadImage(UPLOAD . $rute . 'original/' . $img['file']);
        $thumb->resize(400, 'width');
        $thumb->save(UPLOAD . $rute . 'm_' . $img['file']);
        $thumb->crop(100, 100);
        $thumb->save(UPLOAD . $rute . 'thumb_m_' . $img['file']);
        unlink(UPLOAD . 'temp/' . $img['file']);
        return $photo_id;
    }
    public function insertProject($photo_id,$Id){
        $pos=$this->db->selectOne('SELECT MAX(position) as position from projects_photos WHERE project_id='.$Id);
        $position=($pos['position'])?$pos['position']+1:0;
        $data = array(
            'photo_id' => $photo_id,
            'visibility' => 'public',
            'project_id' => $Id,
            'position' => $position,
        );
        $this->db->insert('projects_photos', $data);
        $data = array(
          'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('projects', $data, "`id` = '{$Id}'");
    }
    public function insertSection($photo_id,$Id){
        $this->db->insert('home_photos', array(
            'photo_id' => $photo_id,
            'section_id' => $Id,
        ));
    }

    public function png2jpg($originalFile, $outputFile, $quality = 100) {
        $image = imagecreatefrompng($originalFile);
        imagejpeg($image, $outputFile, $quality);
        unlink($originalFile);
        imagedestroy($image);
    }

    public function orderByName($model,$num){
        $pos=$this->db->select('SELECT * from models_photos JOIN photos ON (models_photos.photo_id=photos.id) WHERE model_id='.$model.' ORDER BY position DESC LIMIT 0,'.$num);
        
        foreach($pos as $value){
            $models[$value['id']]=$value['file_file_name'];
        }
        arsort($models);
        $position=$pos[0]['position'];
        foreach($models as $key=>$value){
            $data = array(
                'position' => $position,
            );
            $position--;
            $this->db->update('models_photos', $data, "`photo_id` = '{$key}'");
        }
        
    }
}