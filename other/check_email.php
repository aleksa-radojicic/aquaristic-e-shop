
<?php

//used by registration_script.js


$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . '/models/order_model.php');

//get from post request
$email = $_POST['email'];

//get if email already exists in db
$email_unique = UserModel::isEmailUnique($email);


//if there already exists user with the same email (email not unique)
if (!$email_unique) {

    //sends "0" (meaning false) to registration_script
    echo "0";

    //if typed email is unique
} else {

    //sends "1" (meaning true) to registration_script
    echo "1";
}
