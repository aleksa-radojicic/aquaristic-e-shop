<?php require('handlers/single_product_handler.php'); ?>

<!DOCTYPE html>
<html lang="en">

<?php $title = 'Product'; ?>

<!--Head-->
<?php require('layouts/head.php'); ?>

<body>

  <!--Navbar-->
  <?php require('layouts/navbar.php'); ?>


  <!--Single product-->
  <section class="container single-product">
    <div class="row">
      <div class="col-lg-5 col-md-6 col-sm-12">
        <img class="img-fluid w-100 pb-1 mt-4" id="mainImg" src="assets/images/<?php echo $product->product_image; ?>" />
        <div class="small-img-group">
          <div class="small-img-col">
            <img src="assets/images/<?php echo $product->product_image; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/images/<?php echo $product->product_image2; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/images/<?php echo $product->product_image3; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/images/<?php echo $product->product_image4; ?>" width="100%" class="small-img" />
          </div>
        </div>
      </div>


      <div class="col-lg-6 col-md-12 col-sm-12">
        <h3 class="py-4"><?php echo $product->product_name; ?></h3>
        <h2>$<?php echo $product->product_price; ?></h2>

        <form method="POST" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
          <input type="hidden" name="product_image" value="<?php echo $product->product_image; ?>">
          <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>">
          <input type="hidden" name="product_price" value="<?php echo $product->product_price; ?>">
          <input type="number" name="product_quantity" value="1" />
          <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
        </form>

        <h4 class="mt-5 mb-5">Product details</h4>
        <span><?php echo $product->product_description; ?>
        </span>
      </div>
    </div>
    </div>
  </section>


  <!--Related products-->
  <section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/featured1.jpg" />

        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>

        <h5 class="p-name">EHEIM reeflexUV 359</h5>
        <h4 class="p-price">$149.99</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/featured2.jpg" />

        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>

        <h5 class="p-name">EHEIM Smart climate controller</h5>
        <h4 class="p-price">$299.99</h4>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/featured3.jpg" />

        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>

        <h5 class="p-name">EHEIM Autofeeder</h5>
        <h4 class="p-price">$39.99</h4>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/featured4.jpg" />

        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>

        <h5 class="p-name">Sera Marine Granules Nature</h5>
        <h4 class="p-price">$5.99</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>

  </section>


  <!--Footer-->
  <?php require('layouts/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
      smallImg[i].onclick = function() {
        mainImg.src = smallImg[i].src;
      }
    }
  </script>

</body>

</html>