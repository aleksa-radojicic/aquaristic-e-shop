<?php require('handlers/cart_handler.php'); ?>




<!DOCTYPE html>
<html lang="en">

<?php $title = 'Cart'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

  <!--Navbar-->
  <?php require('layouts/navbar.php'); ?>


  <!--Cart-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Your Cart</h2>
      <hr>
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>

      <?php if (isset($_SESSION['cart'])) {
        foreach (unserialize($_SESSION['cart']) as $order_item) { ?>
          <tr>
            <td>
              <div class="product-info">
                <img src="assets/images/<?php echo $order_item->product->product_image; ?>">
                <div>
                  <p><?php echo $order_item->product->product_name; ?></p>
                  <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $order_item->product->product_id; ?>" />
                    <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                  </form>
                </div>
              </div>
            </td>

            <td>
              <span>$<?php echo $order_item->product_price; ?></span>
            </td>

            <td>
              <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $order_item->product->product_id; ?>" />
                <input type="number" name="product_quantity" value="<?php echo $order_item->product_quantity; ?>" />
                <input type="submit" class="edit-btn" value="edit" name="edit_quantity" />
              </form>
            </td>

            <td>
              <span>$<?php echo $order_item->product_quantity * $order_item->product_price; ?></span>
            </td>
          </tr>
      <?php }
      } ?>

    </table>

    <div class="cart-total">
      <table>
        <tr>
          <td>Total</td>
          <td>$<?php echo $_SESSION['total']; ?></td>
        </tr>
      </table>
    </div>

    <div class="checkout-container">
      <form method="POST" action="checkout.php">
        <input type="submit" class="btn checkout-btn" name="checkout" value="Checkout" />
      </form>
    </div>


  </section>


  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>