<?php require('handlers/order_details_handler.php'); ?>


<!DOCTYPE html>
<html lang="en">
<?php $title = 'Order_details'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

    <!--Navbar-->
    <?php require('layouts/navbar.php'); ?>


    <!--Order details-->
    <section class="orders container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order details</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total price</th>
            </tr>

            <?php foreach ($order_items as $order_item) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/images/<?php echo $order_item['product_image'] ?>" />
                            <div>
                                <p class="mt-3"><?php echo $order_item['product_name'] ?></p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span>$<?php echo $order_item['product_price'] ?></span>
                    </td>

                    <td>
                        <span><?php echo $order_item['product_quantity'] ?></span>
                    </td>

                    <td>
                        <span>$<?php echo ($order_item['product_quantity'] * $order_item['product_price']);?></span>
                    </td>

                </tr>
            <?php } ?>

        </table>



    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!--Footer-->
    <?php require('layouts/footer.php'); ?>

</body>

</html>