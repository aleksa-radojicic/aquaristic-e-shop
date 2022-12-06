<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");


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

    //if user removed product from cart
} else if (isset($_POST["remove_product"])) {

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

    updateTotalCartPrice($order_items);

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
}


function updateTotalCartPrice($order_items)
{
    //update total order price in cart
    $total = OrderItem::computeTotalCartPrice($order_items);

    //set computed total order price in session
    $_SESSION['total'] = $total;
}
