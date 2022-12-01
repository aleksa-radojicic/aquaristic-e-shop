<?php

session_start();
include('server/connection.php');


if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $stmt = $conn->prepare("select * 
    from order_items oi join products p on (oi.product_id = p.product_id) 
    where oi.order_id=?");

    $order_id = $_POST['order_id'];

    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    $items = $stmt->get_result();
} else {
    header("location: account.php");
    exit;
}


?>




<!DOCTYPE html>
<html lang="en">
<?php $title = 'Order_details'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<body>

    <!--Navbar-->
    <?php require_once('navbar.php'); ?>


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

            <?php while ($row = $items->fetch_assoc()) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/images/<?php echo $row['product_image'] ?>" />
                            <div>
                                <p class="mt-3"><?php echo $row['product_name'] ?></p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span>$<?php echo $row['product_price'] ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['product_quantity'] ?></span>
                    </td>

                    <td>
                        <span>$<?php echo ($row['product_quantity'] * $row['product_price']);?></span>
                    </td>

                </tr>
            <?php } ?>

        </table>



    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!--Footer-->
    <?php require_once('footer.php'); ?>

</body>

</html>