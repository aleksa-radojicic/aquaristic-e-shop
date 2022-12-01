<?php

session_start();

  //prevent access from url bar indirectly
  if (!isset($_SESSION['logged_in'])) {
  header('location: index.php');
  exit;
}

if (!empty($_SESSION["cart"])) {
} else {
  header("location: index.php?addproductstocartfirst");
}


?>



<!DOCTYPE html>
<html lang="en">
<?php $title = 'Checkout'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<body>

  <!--Navbar-->
  <?php require_once('navbar.php'); ?>

  <!--Checkout-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Checkout</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form id="checkout-form" action="server/create_order.php" method="POST">
        <div class="form-group checkout-small-element">
          <label>Phone</label>
          <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required />
        </div>
        <div class="form-group checkout-small-element">
          <label>City</label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
        </div>
        <div class="form-group checkout-large-element">
          <label>Address</label>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
        </div>
        <div class="form-group checkout-btn-container">
          <p>Total price: $<?php echo $_SESSION["total"]; ?></p>
          <input type="submit" class="btn" id="checkout-btn" value="Place Order" name="create_order" />
        </div>
      </form>
    </div>


  </section>


  <!--Footer-->
  <?php require_once('footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>