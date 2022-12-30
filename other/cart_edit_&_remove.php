<?php

session_start();

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require_once($absolute_root_path . "/classes.php");
require("cart_update_price.php");



//if user removed product from cart
if (isset($_POST["remove_product"])) {


    //get product id from POST request that user wants to remove
    $product_id = $_POST['product_id'];

    //get array of OrderItems from session
    $order_items = unserialize($_SESSION['cart']);

    //get array key of order item that user wants to remove
    $key = OrderItem::getArrayKeyFromOrderItemsByProductId($order_items, $product_id);

    //delete OrderItem by array key
    unset($order_items[$key]);

    //update order items in session
    $_SESSION['cart'] = serialize($order_items);

    //keep total price in variable
    $total_price = updateTotalCartPrice($order_items);
    
    //return total_price to cart_script.js
    echo $total_price;

    //if user edited amount of certain product in cart
} else if (isset($_POST["edit_quantity"])) {

    //get product id from POST request of order item that user wants to edit quantity
    $product_id = $_POST['product_id'];

    //get new quantity amount of that order item
    $product_quantity = $_POST['product_quantity'];

    //retrieve order items from session
    $order_items = unserialize($_SESSION['cart']);

    //get array key of order item that user wants to edit quantity of
    $key = OrderItem::getArrayKeyFromOrderItemsByProductId($order_items, $product_id);

    //change quantity of that order item
    $order_items[$key]->product_quantity = $product_quantity;

    //update array of order items in session
    $_SESSION['cart'] = serialize($order_items);

    //keep total price in variable
    $total_price = updateTotalCartPrice($order_items);
    $subtotal_price = $order_items[$key]->product_quantity * $order_items[$key]->product_price;

    //create array of total_price and subtotal_price and transform into json
    $prices = json_encode(array($total_price, $subtotal_price));

    //return that json object to cart_script.js
    echo $prices;
}