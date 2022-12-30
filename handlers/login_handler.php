<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();


//retrieving email from POST request
$email = $_POST['email'];

//encrypting retrieved password from POST request
$password = md5($_POST['password']);

//returns the User with the given credentials or null if it isn't found
$user = UserModel::getUserByEmailAndPassword($email, $password);

//the user doesn't exists
if (!$user) {

    echo "not found";

    //if the user isn't found
} else {

    //set appropriate parameters in session
    $_SESSION['user'] = serialize($user);
    $_SESSION['logged_in'] = true;
    $_SESSION['total'] = 0;

    echo "found";
}
