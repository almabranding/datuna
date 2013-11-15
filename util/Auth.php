<?php
/**
 * 
 */
class Auth
{ 
    public static function handleLogin()
    {
        @session_start();
        $logged = $_SESSION['loggedIn'];
        if ($logged == false) {
            session_destroy();
            return false;
            //header('location: ../index');
            //exit;
        }
        return true;
    }
    
}