<?php

class Back_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function thumbnails() {
        $cont = 0;
        $images = $this->db->select("SELECT * FROM models_photos mp JOIN photos p ON(mp.photo_id=p.id) order by p.id DESC LIMIT 3000,1");
        foreach ($images as $value) {
            
            $rute = 'models/';
            $rute.=$this->idToRute($value['photo_id']);
            if (!file_exists(UPLOAD . $rute . 'thumb_' . $value['file_file_name']) && file_exists(UPLOAD . $rute . 'original/' . $value['file_file_name'])) {
                $cont++;
                $thumb = new thumb();
                $thumb->loadImage(UPLOAD . $rute . 'original/' . $value['file_file_name']);
                $thumb->resize(500, 'height');
                $thumb->save(UPLOAD . $rute . $value['file_file_name']);
                $thumb->crop(162, 215);
                $thumb->save(UPLOAD . $rute . 'thumb_' . $value['file_file_name']);
                $thumb->destroy();
                unset($thumb);
            }
        }
        echo $cont . 'pasadas';
    }

    public function delImages() {
        $images = $this->db->select("SELECT * FROM photos order by id LIMIT 5000,5000");
        foreach ($images as $value) {
            $this->delTree(UPLOAD . 'models/' . $this->idToRute($value));
        }
    }

    function listar_directorios_ruta($ruta) {
// abrir un directorio y listarlo recursivo
        if (is_dir($ruta)) {
            if ($dh = opendir($ruta)) {
                while (($file = readdir($dh))) {
                    if (is_dir($ruta . $file) && $file != "." && $file != ".." && $file != "original") {
                        $rute = array_reverse(explode('/', $ruta . $file));
                        $id = $rute[2] . $rute[1] . $rute[0];
                        $sth = $this->db->prepare("SELECT * FROM photos where id=:id order by id");
                        $sth->execute(array(
                            ':id' => intval($id)
                        ));
                        $data = $sth->fetch();
                        $count = $sth->rowCount();
                        if ($count == 0)
                            echo intval($id) . "NO existe<br>";
                        else
                            echo intval($id) . "SI existe<br>";
                        $this->listar_directorios_ruta($ruta . $file . "/");
                    }
                }
                closedir($dh);
            }
        }
    }

    function copyfiles() {
        $sth = $this->db->select("SELECT * FROM models_photos mp JOIN photos p ON(mp.photo_id=p.id) order by p.id LIMIT 5001,100");
        foreach ($sth as $value) {
            if (!is_dir(UPLOAD . 'models/' . $this->idToRute($value['photo_id']) . 'original/'))
                mkdir(UPLOAD . 'models/' . $this->idToRute($value['photo_id']) . 'original/', 0777, true);
            copy(UPLOAD . 'models/aux/' . $this->idToRute($value['photo_id']) . 'original/' . $value['file_file_name'], UPLOAD . 'models/' . $this->idToRute($value['photo_id']) . 'original/' . $value['file_file_name']);
        }
    }

    function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                    echo "copiado: " . $src . '/' . $file;
                }
            }
        }
        closedir($dir);
    }

}