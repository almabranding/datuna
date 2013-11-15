<?php
class Form_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function register() {
        $data=array(
            'name'      => $_POST['name'],
            'last'      => $_POST['last'],
            'email'     => $_POST['email'],
            'how'       => $_POST['how'],
            'subject'   => $_POST['subject'],
            'message'   => $_POST['message']
        );
        $this->ValidarDatos($data['mail']);
	$mail="dan@almabranding.com";
	//$mail = "dmartin@glass120ocean.com,anna@glass120ocean.com,eloy@glass120ocean.com,nherrera@terragroup.com,contact@glass120ocean.com,info@glass120ocean.com";
        $to = $mail;
	$subject = "User Register";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: contact@glass120ocean.com" . "\r\n";
	$body = "";
        foreach($data as $key=>$value)
            $body.= $key.': '.$value.'<br/>';		
	mail($to, $subject, $body, $headers);
        
        $this->db->insert('request', $data);
    }
    
}