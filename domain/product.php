<?php

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
    public function __construct($id=null, $name, $description, $image, $image2, $image3, $image4, $price)
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

}




?>