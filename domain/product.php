<?php

require('order_item.php');

class Product
{
    public $product_id; //primary key
    public $product_name;
    public $product_description;
    public $product_image;
    public $product_image2;
    public $product_image3;
    public $product_image4;
    public $product_price;

    //Product constructor
    public function __construct($id=null, $name=null, $price=null, $description=null, $image=null, $image2=null, $image3=null, $image4=null)
    {
        $this->product_id = $id;
        $this->product_name = $name;
        $this->product_description = $description;
        $this->product_image = $image;
        $this->product_image2 = $image2;
        $this->product_image3 = $image3;
        $this->product_image4 = $image4;
        $this->product_price = $price;
    }

    //get product ids from array of OrderItems
    //returns array of integers
    public static function getProductIdsFromOrderItems(array $order_items)
    {

        //initialize empty array of Products
        $product_ids = array();

        foreach ($order_items as $order_item) {
            
            $product = $order_item->product;

            $product_ids[] = $product->product_id;
        }

        //return array of Products
        return $product_ids;
    }

}
?>