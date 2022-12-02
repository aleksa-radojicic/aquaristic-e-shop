<?php

class OrderItem
{
    public $item_id; //primary key
    public Order $order; //foreign key to Order
    public Product $product; //foreign key to Product
    public User $user; //foreign key to User
    public $product_price;
    public $product_quantity;

    //OrderItem constructor
    public function __construct($item_id=null, $order, $product, $user, $product_price, $product_quantity)
    {
        $this->item_id = $item_id;
        $this->order = $order;
        $this->product = $product;
        $this->user = $user;
        $this->product_price = $product_price;
        $this->product_quantity = $product_quantity;
    }


}








?>