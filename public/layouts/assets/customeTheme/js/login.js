// Wait for the DOM to be ready
$(document).ready(function () {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      fullName: "required",
      mobileNumber: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true,
      },
      password: {
        required: true,
        minlength: 5,
      },
    },
    // Specify validation error messages
    messages: {
      fullName: "Please enter your fullName",
      mobileNumber: "Please enter your mobileNumber",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
      },
      email: "Please enter a valid email address",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      var fullName = $("#fullName").val();
      var mobileNumber = $("#mobileNumber").val();
      var email = $("#email").val();
      var password = $("#email").val();
      $.ajax({
        url: "createAccount",
        type: "POST",
        data: {
          fullName: fullName,
          mobileNumber: mobileNumber,
          password: password,
          email: email,
        },
        dataType: "json",
        success: function (e) {
          debugger;

          alert(e.message);
        },
        error: function (e) {
          debugger;
          alert(e.responseJSON.message);
        },
      });
    },
  });

  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='signin']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      email_signin: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true,
      },
      password_signin: {
        required: true,
        minlength: 5,
      },
    },
    // Specify validation error messages
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
      },
      email: "Please enter a valid email address",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      var email = $("#email_signin").val();
      var password = $("#password_signin").val();
      $.ajax({
        url: "/checkLogin",
        type: "POST",
        dataType: "json",
        // headers: {"Authorization": localStorage.getItem('token')},

        // headers: { Authorization: "mytoken" },
        data: {
          password: password,
          email: email,
        },
        success: function (e) {
          debugger;
          localStorage.setItem("token", e.token);
          location.href = e.data.href;
        },
        error: function (e) {
          alert(e.responseJSON.message);
        },
      });
    },
  });
});
