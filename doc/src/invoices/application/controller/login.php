<?php
class Login
{
    public function index(){
        require 'application/views/login/index.php';
    }

    public function logIn()
    {

        //Effetuate the login if appened a post request of it.
        if (isset($_POST['login'])) {
          
        }

    }

}
