<?php

class User
{

    public $user_id; //primary key
    public $user_name;
    public $user_email;
    public $user_password; //password in encrypted form

    //User constructor
    public function __construct($id = null, $name, $email, $password)
    {
        $this->user_id = $id;
        $this->user_name = $name;
        $this->user_email = $email;
        $this->user_password = md5($password); //encrypted password
    }

}




?>