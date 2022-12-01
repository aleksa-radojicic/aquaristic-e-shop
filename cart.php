<?php

session_start();

//user not logged in
if (!isset($_SESSION['logged_in'])) {
  header('location: index.php?prijaviteseprvo');
  exit;
}

if (isset($_POST["add_to_cart"])) {

  if (isset($_SESSION['cart'])) {

    $products_array_ids = array_column($_SESSION['cart'], 'product_id');

    if (!in_array($_POST["product_id"], $products_array_ids)) {

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' => $product_id,
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity']
      );

      $_SESSION['cart'][$_POST['product_id']] = $product_array;

      computeTotalCartPrice();
    } else {
      echo '<script>alert("The product was already added to the cart.")</script>';
    }
  } else {

    $product_id = $_POST['product_id'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $_POST['product_name'],
      'product_price' => $_POST['product_price'],
      'product_image' => $_POST['product_image'],
      'product_quantity' => $_POST['product_quantity']
    );

    $_SESSION['cart'][$product_id] = $product_array;

    computeTotalCartPrice();
  }
} else if (isset($_POST["remove_product"])) {

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  computeTotalCartPrice();
} else if (isset($_POST["edit_quantity"])) {

  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  $product_array = $_SESSION['cart'][$product_id];

  $product_array["product_quantity"] = $product_quantity;

  $_SESSION["cart"][$product_id] = $product_array;

  computeTotalCartPrice();
}


function computeTotalCartPrice()
{

  $total = 0;

  foreach ($_SESSION["cart"] as $key => $value) {

    $product = $_SESSION["cart"][$key];

    $total += $product["product_quantity"] * $product["product_price"];
  }

  $_SESSION['total'] = $total;
}

?>




<!DOCTYPE html>
<html lang="en">

<?php $title = 'Cart'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<body>

  <!--Navbar-->
  <?php require_once('navbar.php'); ?>


  <!--Cart-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Your Cart</h2>
      <hr>
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>

      <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
        <tr>
          <td>
            <div class="product-info">
              <img src="assets/images/<?php echo $value['product_image']; ?>">
              <div>
                <p><?php echo $value['product_name']; ?></p>
                <small><span>$</span><?php echo $value['product_price']; ?></small>
                <br>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                  <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                </form>
              </div>
            </div>
          </td>

          <td>
            <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
              <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" />
              <input type="submit" class="edit-btn" value="edit" name="edit_quantity" />
            </form>
          </td>

          <td>
            <span>$</span>
            <span class="product-price"><?php echo $value["product_quantity"] * $value["product_price"]; ?></span>
          </td>
        </tr>
      <?php } ?>

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
  <?php require_once('footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>