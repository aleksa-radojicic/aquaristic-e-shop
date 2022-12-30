let message; //message that will be displayed above email text box


//email validity checker on user input
$(document).on("input", "#register-email", function (e) {
  let color; //color of the message (green for ok and red for not ok

  //getting value of typed email
  let email = $("#register-email").val();

  //if email doesn't contains @
  if (!email.includes("@")) {
    color = "red";
    message = "Email is not valid";

    //set appropriate color of emailStatus paragraph
    document.getElementById("emailStatus").style.color = color;

    //set appropriate message in that paragraph element
    $("#emailStatus").html(message);

    //check if email is unique while user is typing
  } else {
    //ajax query sent to other/check_email.php
    $.ajax({
      method: "POST",
      url: "other/check_email.php",
      data: { emailId: email },

      //response from check_email can be "0" (false) or "1" (true)
      success: function (response) {
        //for some reasone response contains blank signs
        response = response.trim();

        //check if entered email is unique to display appropriate message
        if (response == "0") {
          color = "red";
          message = "Email is not unique";

          //response == "unique" (user with given email doesn't exist)
        } else {
          color = "green";
          message = "Email is unique";
        }

        //set appropriate color of emailStatus paragraph
        document.getElementById("emailStatus").style.color = color;

        //set appropriate message in that paragraph element
        $("#emailStatus").html(message);
      },
    });
  }
});

//password validity checker on user input
$(document).on("input", "#register-password", function (e) {
  //getting value of typed password that user provided
  let password = $("#register-password").val();
  let min_pass_length = 6;

  //if password is of inappropriate length
  if (password.length < min_pass_length) {
    message = "Password must be at least 6 characters long";

    //password has appropriate length
  } else {
    message = "";
  }

  //set appropriate message for that element
  $("#passwordStatus").html(message);

  //color is red by default
});

//confirm password validity checker on user input
$(document).on("input", "#register-confirm-password", function (e) {
  //getting value of typed password and confirm password
  let password = $("#register-password").val();
  let confirm_password = $("#register-confirm-password").val();

  //if passwords don't match
  if (password != confirm_password) {
    message = "Passwords don't match";

    //passwords match
  } else {
    message = "";
  }

  ////set appropriate message for that element
  $("#passwordsMatchStatus").html(message);

  //color is red by default
});
