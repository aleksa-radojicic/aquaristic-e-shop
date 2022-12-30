<!DOCTYPE html>
<html lang="en">

<?php $title = 'Login'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

  <!--Navbar-->
  <?php require('layouts/navbar.php'); ?>

  <!--Login-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Login</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form id="login-form" method="POST" action="login.php">
        <div class="form-group">
          <p style="color: red;" id="loginStatus"></p>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login" />
        </div>
        <div class="form-group">
          <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
        </div>
      </form>
    </div>


  </section>


  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="assets/js/login_script.js"></script>

</body>

</html>