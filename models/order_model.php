<?php


$absolute_root_path =  $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path."/classes.php");

//responsible for CRUD operations on domain class Order
class OrderModel
{
    //creates new Order
    //returns boolean (query execution status)
    public static function createOrder(Order $order)
    {

        //connecting to the database
        DBBroker::connect();

        //INSERT new order into table orders
        $query = "INSERT INTO orders(order_cost, user_id, user_phone, user_city, user_address, order_date)
        VALUES(?,?,?,?,?,?)";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param("diisss", $order->order_cost, $order->user->user_id, $order->user_phone, $order->user_city, $order->user_address, $order->order_date);

        //status of the change
        $signal = $stmt->execute();

        //if the query was successful
        if ($signal) {
            //set order's primary key to the automaticaly generated id from db
            $order->order_id = $stmt->insert_id;

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

    //gets all orders from a specific user given his user id
    //returns array of Orders
    public static function getOrdersForGivenUser($user)
    {
        require_once("classes.php");


        //connecting to the database
        DBBroker::connect();

        //query to SELECT all orders of a specific user
        $query = "SELECT * FROM orders WHERE user_id=?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param("i", $user->user_id);

        //executing statement
        $stmt->execute();

        //keep result set in a variable
        $result_set = $stmt->get_result();

        //create empty array for Orders
        $orders = array();

        //loop over every row of the result set
        while ($row = mysqli_fetch_array($result_set)) {
            //add Order from the row into orders array
            $orders[] = new Order(
                $row['order_cost'],
                $user,
                $row['user_phone'],
                $row['user_city'],
                $row['user_address'],
                $row['order_date'],
                $row['order_id']
            );
        }

        //return fetched orders
        return $orders;
    }
}
?>