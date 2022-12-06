<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();


//when user access single product page of a certain product
if (isset($_GET['product_id'])) {

    //access product key from GET request
    $product_id = $_GET["product_id"];

    //get product by product id from db
    $product = ProductModel::getProductById($product_id);

    //user tried accessing single product page without
    //entering id of a product (single_product.php)
} else {
    //redirect to shop page
    header('location: shop.php');
}
