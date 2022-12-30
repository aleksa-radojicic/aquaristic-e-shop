$(document).on("click", "#login-btn", function (e) {
  //prevent action button of the form (override action of form button)
  e.preventDefault();

  let email = $("#login-email").val();
  let password = $("#login-password").val();

  //ajax query sent to handlers/login_handler.php
  $.ajax({
    method: "POST",
    url: "handlers/login_handler.php",
    data: { email: email, 
      password: password },

    //response from login_handler can be "found" or "not found"
    success: function (response) {
      //for some reasone response contains blank signs
      response = response.trim();

      //check if user with entered credentials is fund
      if (response == "not found") {
        
        //display error message in login page
        $("#loginStatus").html("Email or password is incorrect");
      } else {
        //redirect to account page and show success message in URL
        window.location.href = "account.php?successfully_logged_in";
      }
    },
  });
});
