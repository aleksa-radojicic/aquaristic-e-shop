<?php
session_start();

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");
require($absolute_root_path . "/other/cart_update_price.php");


//if user isn't logged in and tries to access cart page
if (!isset($_SESSION['logged_in'])) {
    //redirect to home page and display error message in URL bar
    header('location: index.php?log_in_first');
    exit;
}

//when user adds a product to cart
if (isset($_POST["add_to_cart"])) {


    //get product id from POST request
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    //creating Product object (foreign key of OrderItem)
    $product = new Product($product_id, $product_name, null, null, $_POST['product_image']);

    //retrieving user from session (foreign key of OrderItem)
    $user = unserialize($_SESSION['user']);

    //creating OrderItem with provided data
    $order_item = new OrderItem(
        null,
        null,
        $product,
        $user,
        $_POST['product_price'],
        $_POST['product_quantity']
    );

    //if cart is not empty
    if (isset($_SESSION['cart'])) {

        //get from session array of OrderItems
        $order_items = unserialize($_SESSION['cart']);

        //get from array of OrderItems array of product ids
        $product_ids = Product::getProductIDSFromOrderItems($order_items);


        //if product hasn't already been added to cart
        if (!in_array($_POST["product_id"], $product_ids)) {

            //append OrderItem to array of OrderItems
            $order_items[] = $order_item;

            //update cart by replacing array of order items to newer
            //array of order items with newly added product in cart
            $_SESSION['cart'] = serialize($order_items);

            updateTotalCartPrice($order_items);

            //if product is already added to cart
        } else {
            //display alert with message
            echo '<script>alert("The product was already added to the cart.")</script>';
        }
        //when cart is empty
    } else {

        //append OrderItem to array of OrderItems
        $order_items[] = $order_item;

        //update cart by replacing array of order items to newer
        //array of order items with newly added product in cart
        $_SESSION['cart'] = serialize($order_items);

        updateTotalCartPrice($order_items);
    }
}
