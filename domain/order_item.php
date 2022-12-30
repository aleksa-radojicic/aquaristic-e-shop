<?php

require_once("order.php");
require_once("product.php");
require_once("user.php");

class OrderItem
{
    public $item_id; //primary key
    public ?Order $order; //foreign key to Order
    public Product $product; //foreign key to Product
    public $product_price;
    public $product_quantity;

    //OrderItem constructor
    public function __construct($item_id=null, $order=null, $product, $product_price, $product_quantity)
    {
        $this->item_id = $item_id;
        $this->order = $order;
        $this->product = $product;
        $this->product_price = $product_price;
        $this->product_quantity = $product_quantity;
    }

    //loop through array of OrderItems and calculate total price for order
    //returns double
    public static function computeTotalCartPrice($order_items)
    {
        //initialize total to 0
        $total = 0;

        foreach ($order_items as $order_item) {
            //string * User
            $total += $order_item->product_quantity * $order_item->product_price;
        }

        return $total;
    }


    //removes OrderItem from array of OrderItems by product id
    //returns integer
    public static function getArrayKeyFromOrderItemsByProductId(array $order_items, int $product_id)
    {

        //loop through all order items
        foreach ($order_items as $key => $order_item) {

            //if the OrderItem with that product id is found
            if ($order_item->product->product_id == $product_id) {
                
                //unset that product
                return $key;

                //end loop and finish execution
                break;
            }
        }
    }
}

?>