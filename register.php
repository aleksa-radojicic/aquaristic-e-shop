<?php

session_start();

include('server/connection.php');

if (isset($_POST["register"])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword =  $_POST['confirmPassword'];

  if ($password !== $confirmPassword) {
    header("location: register.php?error=passwords don't match");
  } else if (strlen($password < 6)) {
    header("location: register.php?error=password must be at least 6 characters");
  } else {

    $stmt1 = $conn->prepare("select count(*) from users where user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if ($num_rows != 0) {
      header("location: register.php?error=user with this email already exists");
    } else {

      $stmt = $conn->prepare("insert into users (user_name, user_email, user_password)
              values (?,?,?)");

      $stmt->bind_param('sss', $name, $email, md5($password));

      if($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        
        header("location: login.php?account_made_successfully");
      } else {
        header("location: register.php?error=couldn't create an account at the moment");
      }


    }
  }

//if the user is registered
} else if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
}

?>





<!DOCTYPE html>
<html lang="en">
<?php $title = 'Register'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<body>

  <!--Navbar-->
  <?php require_once('navbar.php'); ?>


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
  <?php require_once('footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>