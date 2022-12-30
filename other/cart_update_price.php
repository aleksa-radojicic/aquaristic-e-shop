
<?php

//This can be organized in a better way I think


//function which updates total price of order in cart page
function updateTotalCartPrice($order_items)
{
    //update total order price in cart
    $total = OrderItem::computeTotalCartPrice($order_items);

    //set computed total order price in session
    $_SESSION['total'] = $total;

    //return computed order price
    return $total;
}