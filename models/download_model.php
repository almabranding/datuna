<?php
class Download_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function download($folder,$file){
        $ch = curl_init(IMAGES.$folder.'/'.$file);
        $fp = fopen(ROOT.'uploads/images/'.$folder.'/'.$file, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}