<?php

session_start();
include("connection.php");

//create order
if (isset($_POST["create_order"])) {

    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $order_cost = $_SESSION["total"];
    $user_id = $_SESSION['user_id'];
    $order_date = date("Y-m-d H:i:s");

    $stmt_order = $conn->prepare("insert into orders (order_cost, user_id, user_phone, user_city, user_address, order_date)
    values (?,?,?,?,?,?)");

    $stmt_order->bind_param("diisss", $order_cost, $user_id, $phone, $city, $address, $order_date);

    if (!$stmt_order->execute()) {
        header('location: index.php');
        exit;
    }

    $order_id = $stmt_order->insert_id;

    //create order items

    foreach ($_SESSION["cart"] as $key => $value) {
        $product = $_SESSION["cart"][$key];
        $product_id = $product["product_id"];
        $product_price = $product["product_price"];
        $product_quantity = $product["product_quantity"];

        $stmt_order_item = $conn->prepare("insert into order_items (order_id, product_id, user_id, product_price, product_quantity)
        values (?,?,?,?,?)");

        $stmt_order_item->bind_param("iiidi", $order_id, $product_id, $user_id, $product_price, $product_quantity);

        $stmt_order_item->execute();
    }

    unset($_SESSION["cart"]);
    $_SESSION['total'] = 0;

    header("location: ../index.php?order_created_successfully");
} else {
}

?>