<?php require('handlers/shop_handler.php'); ?>


<!DOCTYPE html>
<html lang="en">

<?php $title = 'Shop'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

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
  <?php require('layouts/navbar.php'); ?>


  <!--Shop-->
  <section id="featured" class="my-5 py-5">
    <div class="container mt-5 py-5">
      <h3>Our Products</h3>
      <hr>
      <p>Here you can check our featured products</p>
    </div>

    <div class="row mx-auto container">


      <?php foreach ($products as $product) { ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $product->product_image; ?>" />

          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>

          <h5 class="p-name"><?php echo $product->product_name; ?></h5>
          <h4 class="p-price">$<?php echo $product->product_price; ?></h4>
          <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=" . $product->product_id; ?>">Buy Now</a>
        </div>

      <?php } ?>


      <nav aria-label="Page navigation example">
        <ul class="pagination mt-5">

          <!--Start-->
          <li class="page-item"><a class="page-link <?php if ($page_no <= 1) {
                                                      echo 'visually-hidden';
                                                    } ?>" href="?page_no=1">1</a>
          </li>

          <!--Start dots-->
          <li class="page-item"><a class="page-link <?php if ($page_no <= 2) {
                                                      echo 'visually-hidden';
                                                    } ?>" href="#">...</a>
          </li>

          <!--Current-->
          <li class="page-item"><a class="page-link" href="<?php "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a>
          </li>

          <!--End dots-->
          <li class="page-item"><a class="page-link <?php if ($page_no >= $total_no_of_pages - 1) {
                                                      echo 'visually-hidden';
                                                    } ?>" href="#">...</a>
          </li>

          <!--End-->
          <li class="page-item"><a class="page-link <?php if ($page_no >= $total_no_of_pages) {
                                                      echo 'visually-hidden';
                                                    } ?>" href="<?php echo "?page_no=" . $total_no_of_pages; ?>">
              <?php echo $total_no_of_pages; ?>
            </a>
          </li>

          <!--Previous-->
          <li class="page-item <?php if ($page_no <= 1) {
                                  echo 'visually-hidden';
                                } ?>">
            <a class="page-link" href="<?php if ($page_no <= 1) {
                                          echo '#';
                                        } else {
                                          echo "?page_no=" . $previous_page;
                                        } ?>">Previous</a>
          </li>

          <!--Next-->
          <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                  echo 'visually-hidden';
                                } ?>">
            <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                          echo '#';
                                        } else {
                                          echo "?page_no=" . $next_page;
                                        } ?>">Next</a>
          </li>

        </ul>
      </nav>

    </div>

  </section>

  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>