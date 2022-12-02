<?php

class Order
{
    public $order_id; //primary key
    public $order_cost;
    public User $user; //foreign key to User
    public $user_phone;
    public $user_city;
    public $user_address;
    public $order_date;

    //Order constructor
    public function __construct($order_id = null, $order_cost, $user, $user_phone, $user_city, $user_address, $order_date)
    {
        $this->order_id = $order_id;
        $this->order_cost = $order_cost;
        $this->user = $user;
        $this->user_phone = $user_phone;
        $this->user_city = $user_city;
        $this->user_address = $user_address;
        $this->order_date = $order_date;
    }
}


?>