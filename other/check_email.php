<?php

# used by registration_script.js

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . '/models/order_model.php');

$email = $_POST['emailId'];

//get if email already exists in db
$email_unique = UserModel::isEmailUnique($email);


//if there already exists user with the same email (email not unique)
if (!$email_unique) {

    //redirect to same page and display an error message
    // header("location: register.php?error=user with this email already exists");

    echo "0";

    //if typed email is unique
} else {
    echo "1";
}
