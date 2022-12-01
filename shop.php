<?php

include('server/connection.php');

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("select * from products");

$stmt->execute();

$products = $stmt->get_result();


?>


<!DOCTYPE html>
<html lang="en">

<?php $title = 'Shop'; ?>

<!--Head-->
<?php require_once('head.php'); ?>

<head>
  <style>
    .product img {
      width: auto;
      height: 200px;
      box-sizing: border-box;
      object-fit: cover;
    }

    .pagination a {
      color: coral;
    }

    .pagination li:hover a {
      color: #fff;
      background-color: coral;
    }
  </style>
</head>



<body>

  <!--Navbar-->
  <?php require_once('navbar.php'); ?>


  <!--Shop-->
  <section id="featured" class="my-5 py-5">
    <div class="container mt-5 py-5">
      <h3>Our Products</h3>
      <hr>
      <p>Here you can check our featured products</p>
    </div>

      <div class="row mx-auto container">


      <?php while ($row = $products->fetch_assoc()) { ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']; ?>" />

          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>

          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">Buy Now</a>
        </div>

      <?php } ?>


      <nav aria-label="Page navigation example">
        <ul class="pagination mt-5">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>

        </ul>
      </nav>

      </div>

  </section>

  <!--Footer-->
  <?php require_once('footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>