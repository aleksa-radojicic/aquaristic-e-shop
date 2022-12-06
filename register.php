<?php require('handlers/register_handler.php'); ?>





<!DOCTYPE html>
<html lang="en">
<?php $title = 'Register'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

  <!--Navbar-->
  <?php require('layouts/navbar.php'); ?>


  <!--Register-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Registration</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form id="register-form" method="POST" action="register.php">
        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                  echo $_GET["error"];
                                } ?></p>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="register-email" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required />
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="Register" />
        </div>
        <div class="form-group">
          <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
        </div>
      </form>
    </div>


  </section>


  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>