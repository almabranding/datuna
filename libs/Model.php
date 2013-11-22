<?php

class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    function getPage($url) {
        $sth = $this->db->prepare("SELECT * FROM pages WHERE url = :url");
        $sth->execute(array(
            ':url' => $url
        ));
        $data = $sth->fetch();
        return $data;
    }

    function getTemplate($id) {
        $sth = $this->db->prepare("SELECT * FROM template WHERE id = :id");
        $sth->execute(array(
            ':id' => $id
        ));
        $data = $sth->fetch();
        return $data['URL'];
    }

    function getTemplatebyCol($attr) {
        $sth = $this->db->prepare("SELECT * FROM template WHERE " . $attr['col'] . " = :id");

        $sth->execute(array(
            ':id' => $attr['id']
        ));
        $data = $sth->fetch();
        return $data;
    }

    function setLang($lang) {
        $this->lang = $lang;
    }

    public function idToRute($id) {
        $id = str_pad($id, 9, "0", STR_PAD_LEFT);
        $folder = str_split($id, 3);
        foreach ($folder as $value) {
            $rute.=$value . '/';
        }
        return $rute;
    }

    public function ValidarDatos($campo) {

        //Array con las posibles cabeceras a utilizar por un spammer
        $badHeads = array("Content-Type:",
            "MIME-Version:",
            "Content-Transfer-Encoding:",
            "Return-path:",
            "Subject:",
            "From:",
            "Envelope-to:",
            "To:",
            "bcc:",
            "cc:");

        //Comprobamos que entre los datos no se encuentre alguna de
        //las cadenas del array. Si se encuentra alguna cadena se
        //dirige a una página de Forbidden
        foreach ($badHeads as $valor) {

            if (strpos(strtolower($campo), strtolower($valor)) !== false) {
                header("HTTP/1.0 403 Forbidden");
                exit;
            }
        }
    }

    public function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return array_map($this->objectToArray, $d);
        } else {
            // Return array
            return $d;
        }
    }

    function toGif($images, $file) {
        foreach ($images as $img) {
            $thumb = new thumb();
            $thumb->loadImage($img);
            $thumb->crop(500, 500);
            $image=$thumb->image;
            ob_start();
            imagegif($image);
            $frames[] = ob_get_contents();
            $framed[] = 100; // Delay in the animation.
            ob_end_clean();
        }
        $gif = new GIFEncoder($frames, $framed, 0, 2, 0, 0, 0, 'bin');
        $fp = fopen('uploads/gifs/' . $file . '.gif', 'w');
        fwrite($fp, $gif->GetAnimation());
        fclose($fp);
    }

    function thumbVideos($img,$file) {
        $thumbs[2] = $img;
        $thumbs[1] = str_replace('frame3', 'frame2', $img);
        $thumbs[0] = str_replace('frame3', 'frame1', $img);
        $thumb = new thumb();
        $thumb->loadImage($img);
        $thumb->crop(500, 500);
        $thumb->save('uploads/gifs/' . $file . '.jpg');
        return $thumbs;
    }

}
