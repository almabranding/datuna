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
       $id=str_pad($id, 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $rute.=$value.'/';
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

}