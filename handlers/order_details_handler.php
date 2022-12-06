<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();

//clicked on button details of a order
if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    
    //get order id from POST request
    $order_id = $_POST['order_id'];

    //get all order items for order by order id
    $order_items = OrderItemModel::getOrderItemsForGivenOrder($order_id);
} else {
    //redirect to account page
    header("location: account.php");
}
