<?php require('handlers/account_handler.php'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $title = 'Account'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

  <!--Navbar-->
  <?php require('layouts/navbar.php'); ?>

  <!--Account-->
  <section class="my-5 py-5">
    <div class="container row mx-auto">
      <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <h3 class="font-weight-bold">Account info</h3>
        <hr class="mx-auto">
        <div class="account-info">
          <p>Name: <span><?php echo $user->user_name; ?></span></p>
          <p>Email: <span><?php echo $user->user_email; ?></span></p>
          <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>

        </div>
      </div>

      <div class="col-lg-6 col-md-12 col-sm-12">
        <form id="account-form">
          <h3>Change Password</h3>
          <hr class="mx-auto">
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required />
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="account-confirm-password" name="confirmPassword" placeholder="Password" required />
          </div>
          <div class="form-group">
            <input type="submit" value="Change Password" class="btn" id="change-pass-btn" />
          </div>
        </form>
      </div>


    </div>


  </section>



  <!--Orders-->
  <section class="orders container">
    <div class="container">
      <h2 class="font-weight-bold text-center">Your Orders</h2>
      <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Order id</th>
        <th>Order cost</th>
        <th>Order date</th>
        <th>Order details</th>
      </tr>

      <?php foreach ($orders as $order) { ?>
        <tr>
          <td>
            <span><?php echo $order->order_id ?></span>
          </td>

          <td>
            <span>$<?php echo $order->order_cost ?></span>
          </td>

          <td>
            <span><?php echo $order->order_date ?></span>
          </td>

          <td>
            <form method="POST" action="order_details.php">
              <input type="hidden" value="<?php echo $order->order_id; ?>" name="order_id">
              <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details">
            </form>
          </td>
        </tr>
      <?php } ?>


    </table>



  </section>


  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>