//when user clicks edit button in cart
$(document).on("click", ".edit-btn", function (e) {
  //prevent action button of the form (override action of form button)
  e.preventDefault();

  //access this html element
  let row = $(this).prev();

  //get quantity amount from html element
  let quantity = row.val();

  //get element with product_id from previous sibling html element
  let product_id = row.prev().val();

  //ajax query sent to other/cart_edit_&_remove.php
  $.ajax({
    method: "POST",
    url: "other/cart_edit_&_remove.php",
    data: {
      edit_quantity: "1", //any value would be appropriate
      product_id: product_id, //these values are sent via POST request
      product_quantity: quantity,
    },
    //prices is the response from cart_edit_&_remove.php
    success: function (prices) {
      //prices is JSON object (array of total_price and subtotal_price)
      prices = JSON.parse(prices);

      //accessing individual array elements
      let total_price = prices[0];
      let subtotal_price = prices[1];

      row
        .parent()
        .parent()
        .next() //accessing next sibling
        .first() //accessing first child
        .html("$" + subtotal_price); //setting subtotal price

      //updating total_price of cart
      $("#cart-total-price").html("$" + total_price);
    },
  });
});

//when user clicks remove button in cart
$(document).on("click", ".remove-btn", function (e) {
  //prevent action button of the form (override action of form button)
  e.preventDefault();

  //access this html element
  let row = $(this);

  //get element with product_id from previous sibling html element
  let product_id = row.prev().val();

  //ajax query sent to other/cart_edit_&_remove.php
  $.ajax({
    method: "POST",
    url: "other/cart_edit_&_remove.php",
    data: {
      remove_product: "1", //any value would be appropriate
      product_id: product_id, //these values are sent via POST request
    },

    //total_price is the response from cart_edit_&_remove.php
    success: function (total_price) {
      //remove tr element containing order item
      row.parents().eq(4).remove(); //eq finds 4th parent element

      //updating total_price of cart
      $("#cart-total-price").html("$" + total_price);
    },
  });
});
