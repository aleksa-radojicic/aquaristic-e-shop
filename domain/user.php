<?php

class User
{

    public $user_id; //primary key
    public $user_name;
    public $user_email;
    public $user_password; //password in encrypted form

    //User constructor
    //if user logs in, the password is not saved in his session
    public function __construct($id = null, $name, $email, $password=null)
    {
        $this->user_id = $id;
        $this->user_name = $name;
        $this->user_email = $email;
        $this->user_password = $password;
    }

}




?>