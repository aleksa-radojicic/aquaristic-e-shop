
<?php

$absolute_root_path =  $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path."/classes.php");

//responsible for CRUD operations on domain class OrderItemModel
class OrderItemModel
{

    //gets order items for specific order id
    //returns array of OrderItems
    public static function getOrderItemsForGivenOrder($order_id)
    {
        //connecting to the database
        DBBroker::connect();

        //query to SELECT all order items for a specific order
        $query = "SELECT * 
        FROM order_items oi JOIN products p ON (oi.product_id = p.product_id) 
        WHERE oi.order_id=?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param("i", $order_id);

        //executing statement
        $stmt->execute();

        //keep result set in a variable
        $result_set = $stmt->get_result();

        //create empty array of OrderItems
        $order_items = array();

        //loop over every row of the result set
        while ($row = mysqli_fetch_array($result_set)) {
            //add OrderItem object from the row into order_items array
            $order_items[] = $row;
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //return fetched order items
        return $order_items;
    }

    //creates new OrderItem
    //returns boolean (query execution status)
    public static function createOrderItem(OrderItem $order_item)
    {

        //connecting to the database
        DBBroker::connect();

        //query to INSERT new order item
        $query = "INSERT INTO order_items (order_id, product_id, product_price, product_quantity)
            VALUES (?,?,?,?)";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //retrieving foreign keys of order item for easier access
        $order_id = $order_item->order->order_id;
        $product_id = $order_item->product->product_id;

        //binding params into created prepared statement
        $stmt->bind_param("iidi", $order_id, $product_id, $order_item->product_price, $order_item->product_quantity);

        //status of the change
        $signal = $stmt->execute();

        //if the query was successful
        if ($signal) {
            //set order item's primary key to the automaticaly generated id from db
            $order_item->item_id = $stmt->insert_id;

            //commit transaction
            DBBroker::$conn->commit();

            //if the query wasn't successful 
        } else {
            //rollback transaction
            DBBroker::$conn->rollback();
        }

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //returns a signal of success (true) or failure (false)
        return $signal;
    }
}




?>