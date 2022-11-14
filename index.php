<!DOCTYPE html>
<html lang="en">

<?php $title = 'Home'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<body>

  <!--Navbar-->
  <?php require_once('navbar.php'); ?>

  <?php
  session_start();

  require_once('flash.php');
  get_msg();
  ?>

  <!--Home-->
  <section id="home">
    <div class="container mt-0 pt-0">
      <h5>Aquarium Keep</h5>
      <h1><span>Affordable Prices</span></h1>
      <p>We offer quality freshwater and marine aquaristic products for everyone's taste and wallet.</p>
      <button>Shop Now</button>
    </div>
  </section>

  <!--Brand-->
  <section id="brand" class="container">
    <div class="row">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/brand1.jpg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/brand2.jpg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/brand3.jpg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/brand4.jpg" />
    </div>
  </section>

  <!--New-->
  <section id="new" class="w-100">
    <div class="row p-0 m-0">
      <!--One-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/1.jpg" />
        <div class="details">
          <h2>Food for Freshwater Fish</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>

      <!--Two-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/2.jpg" />
        <div class="details">
          <h2>External Filters</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>

      <!--Three-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/3.jpg" />
        <div class="details">
          <h2>Goldfish 50% OFF</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>

    </div>
  </section>

  <!--Featured-->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Featured</h3>
      <hr class="mx-auto">
      <p>Here you can check our featured products</p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php include('server/get_featured_products.php'); ?>

      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div onclick="location.href='single_product.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']; ?>" />

          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>

          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
          <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
      <?php } ?>
  </section>

  <!--Banner-->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>NEW AUTUMN BARGAIN</h4>
      <h1>Check our new collection of corals <br> UP to 30% OFF for registered users</h1>
      <button class="text-uppercase">Shop Now</button>
    </div>
  </section>

  <!--Footer-->
  <?php require_once('footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>