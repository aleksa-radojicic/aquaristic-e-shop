<?php

$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();

//prevent access from url bar indirectly
if (!isset($_SESSION['logged_in'])) {

    //redirect to home page
    header('location: index.php');
    exit;
}


//Case 1: if user just logs in or places order SESSION['cart'] will be unset
//Case 2: if user empties everything from cart it will egist, but the array
//of OrderItems will be null
if (isset($_SESSION["cart"]) && unserialize($_SESSION['cart'])) {

    //user tried accessing checkout page with cart being empty
} else {
    //redirect to home page and show message in URL bar
    header("location: index.php?add_products_to_cart_first");
    exit;
}


//when user clicks Place Order button in checkout page
if (isset($_POST["create_order"])) {

    #1. Retrieve data and create $user and $order object

    //retrieve $user object from session (foreign key for order)
    $user = unserialize($_SESSION["user"]);

    //retrieve data from POST request for order
    $user_phone = $_POST["phone"];
    $user_city = $_POST["city"];
    $user_address = $_POST["address"];

    //retrieve order cost stored in session
    $order_cost = $_SESSION["total"];
    //today's date
    $order_date = date("Y-m-d H:i:s");

    //create new Order object
    $order = new Order($order_cost, $user, $user_phone, $user_city, $user_address, $order_date);

    #2. INSERT created $order in db

    //insert created Order object via OrderModel into database and get query execution status
    $query_status = OrderModel::createOrder($order);

    //if the order wasn't successfully created
    if (!$query_status) {

        //redirect to home page and display error message in URL bar
        header("location: ../index.php?order_couldn't_be_created");
        exit;
    }


    #3. Retrieve data and create OrderItem objects

    //retrieve array of order items from session
    $order_items = unserialize($_SESSION["cart"]);

    //loop through array of order items
    foreach ($order_items as $order_item) {

        //set order item's foreign key order to created order
        $order_item->order = $order;

        //create order item and get query execution status
        $query_status_execution = OrderItemModel::createOrderItem($order_item);

        //if query failed for some reason
        if (!$query_status_execution) {

            //redirect to home page and display error message in URL bar
            header("location: ../index.php?order_items_couldn't_be_properly_created");
            exit;
        }
    }

    #4. Reset cart

    //unset order items from cart
    unset($_SESSION["cart"]);

    //reset total cart money amount to 0
    $_SESSION['total'] = 0;


    //redirect to home and show success message in URL bar
    header("location: ../index.php?order_created_successfully");
}

?>