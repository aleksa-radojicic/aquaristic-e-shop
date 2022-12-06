<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require_once($absolute_root_path . "/classes.php");

//when user access single product page of a certain product
if (isset($_GET['product_id'])) {

  //access product key from GET request
  $product_id = $_GET["product_id"];

  //get 
  $product = ProductModel::getProductById($product_id);
} else {

  //user tried accessing single product page without
  //entering id of a product (single_product.php)
  header('location: shop.php');
}

?>