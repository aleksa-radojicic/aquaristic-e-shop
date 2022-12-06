
<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();

//user clicked button register
if (isset($_POST["register"])) {

    //retrieving data from POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword =  $_POST['confirmPassword'];

    //length password condition
    if (strlen($password) < 6) {
        //redirect to same page and display error message in URL bar
        header("location: register.php?error=password must be at least 6 characters");
        exit;
    }

    //identical password and confirmPassword condition
    if ($password !== $confirmPassword) {
        //redirect to same page and display error message in URL bar
        header("location: register.php?error=passwords don't match");
        exit;
    }

    //encrypting password for safety
    $password = md5($password);

    //get if email already exists in db
    $email_unique = UserModel::isEmailUnique($email);


    //if there already exists user with the same email (email not unique)
    if (!$email_unique) {

        //redirect to same page and display an error message
        header("location: register.php?error=user with this email already exists");

        //if typed email is unique
    } else {

        //create new User object without primary key
        //primary key will be set implicitly via UserModel
        $user = new User(null, $name, $email, $password);

        //store signal of query execution in a variable
        $signal = UserModel::createUser($user);

        //if query executed successfully
        if ($signal) {
            //redirect to login page and display success message in URL
            header("location: login.php?account_made_successfully");

            //if query couldn't be executed
        } else {
            //redirect to same page and display error message in URL bar
            header("location: register.php?error=couldn't create an account at the moment");
        }
    }
    //if the user is already logged in
} else if (isset($_SESSION['logged_in'])) {
    //redirect to account page
    header('location: account.php');
}
