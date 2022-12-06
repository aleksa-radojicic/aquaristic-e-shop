<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();

//if the user clicks login button
if (isset($_POST['login_btn'])) {

    //retrieving email from POST request
    $email = $_POST['email'];
  
    //encrypting retrieved password from POST request
    $password = md5($_POST['password']);
  
    //returns the User with the given credentials or null if it isn't found
    $user = UserModel::getUserByEmailAndPassword($email, $password);
  
    //if the user is found
    if ($user) {
      
      //set appropriate parameters in session
  
      $_SESSION['user'] = serialize($user);
      $_SESSION['logged_in'] = true;
  
      //redirect to account page and show success login message
      header('location: account.php?successfully_logged_in');
  
      //the user doesn't exists
    } else {
  
      //redirect to same page and display error message
      header('location: login.php?error=email or password is incorrect');
    }
  }

  ?>