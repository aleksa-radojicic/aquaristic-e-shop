<?php

session_start();

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

//check if user is logged in
if (isset($_SESSION['logged_in'])) {

  //get User object from session
  $user = unserialize($_SESSION['user']);

  //get array of Orders to display in user's list of orders
  $orders = OrderModel::getCreatedOrdersForGivenUser($user);

//if user is not logged in
} else {

  //redirect to login page
  header("location: login.php");
  exit;
}

//if user clicks button logout from account page
if (isset($_GET['logout'])) {

      //unset user's parameters in session
      unset($_SESSION['logged_in']);
      unset($_SESSION['user']);
  
      //redirect to login page
      header("location: index.php?successful_logout"); 

}
?>