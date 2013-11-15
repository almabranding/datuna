<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT * FROM users WHERE 
                email = :email AND password = :password");
        $sth->execute(array(
            ':email' => $_POST['login'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));
        $data = $sth->fetch();
        $count =  $sth->rowCount();
        if ($count > 0) {
            // login
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            Session::set('userid', $data['id']);
            header('location: '.URL.LANG.'/projects');
        } else {
            header('location: '.URL);
        }
        
    }
    public function out()
    {
        Session::set('role', '');
        Session::set('loggedIn', false);
        Session::set('userid', '');
        header('location: '.URL);
        Session::destroy();
        
    }
    
}