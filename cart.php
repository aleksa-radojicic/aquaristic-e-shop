<?php

session_start();

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
} else {
  header("location: index.php");
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

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <link rel="stylesheet" href="assets/css/style.css" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
</head>

<body>

  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 mb-2 fixed-top">
    <div class="container">
      <img class="logo" src="assets/images/logo.jpg" />
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="shop.html">Shop</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact Us</a>
          </li>

          <li class="nav-item">
            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
            <a href="account.html"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


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
      <form method="POST" action="checkout.html">
        <input type="submit" class="btn checkout-btn" name="checkout" value="Checkout"/>
      </form>
    </div>


  </section>


  <!--Footer-->
  <footer class="footer mt-5 py-5">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-4 col-md-6 col-sm-12">
        <img class="logo" src="assets/images/logo.jpg" />
        <p class="pt-3">We provide the best products for the most affordable prices</p>
      </div>

      <div class="footer-one col-lg-4 col-md-6 col-sm-12 footer-featured">
        <h5 class="pb-2">Categories</h5>
        <ul class="text-uppercase">
          <li><a href="#">aquariums<a></li>
          <li><a href="#">food</a></li>
          <li><a href="#">technical products</a></li>
          <li><a href="#">plants</a></li>
          <li><a href="#">animals</a></li>
        </ul>
      </div>

      <div class="footer-one col-lg-4 col-md-6 col-sm-12 footer-contact">
        <h5 class="pb-2">Contact Us</h5>
        <div>
          <h6 class="text-uppercase">Address</h6>
          <p>165 Kragujevačkih Đaka, Belgrade</p>
        </div>
        <div>
          <h6 class="text-uppercase">Phone</h6>
          <p>+381 63 135 3942</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>info@outlook.com</p>
        </div>
      </div>
    </div>

    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-9 col-md-6 col-sm-12 mb-4">
          <p class="text-center">Aquarium Keep ©2022 All Rights Reserved</p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 social-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>

  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>