<?php


$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();

//get featured products via ProductModel
$products = ProductModel::getFeaturedProducts();

?>