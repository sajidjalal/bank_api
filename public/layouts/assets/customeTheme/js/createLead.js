$(function () {
  $("#mobile_number").keyup(function (e) {
    var $th = $(this);

    if (
      e.keyCode != 46 &&
      e.keyCode != 8 &&
      e.keyCode != 37 &&
      e.keyCode != 38 &&
      e.keyCode != 39 &&
      e.keyCode != 40
    ) {
      $th.val(
        $th.val().replace(/[^0-9]/g, function (str) {
          return "";
        })
      );
    }
    return;
  });

  $("#CreateLeadForm").validate({
    rules: {
      first_name: {
        required: true,
      },
      mobile_number: {
        required: true,
        maxlength: 10,
        minlength: 10,
        valid_mobile: true,
        digits: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5,
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
      },
      mobile_number: {
        maxlength: "Please provide 10 digits Mobile Number",
        minlength: "Please provide 10 digits Mobile Number",
        digits: "Please provide Digits only",
      },
      email: "Please enter a valid email address",
    },

    submitHandler: function (form) {
      var first_name = $("#first_name").val();
      var mobile_number = $("#mobile_number").val();
      var email = $("#email").val();
      var password = $("#password").val();

      var data = new FormData();

      data.append("first_name", first_name);
      data.append("mobile_number", mobile_number);
      data.append("email", email);
      data.append("password", password);

      x = document.querySelectorAll(".myError");
      for (i = 0; i < x.length; i++) {
        x[i].textContent = "";
      }

      $.ajax({
        url: "/makeLead",
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        cache: false,
        mimeType: "multipart/form-data",
        headers: { token: localStorage.getItem("token") },
        data: data,
        success: function (e) {
          alert(e.message);
          setTimeout(function () {
            location.reload();
          }, 1000);

          // swal({
          //   title: "Success",
          //   text: e.message,
          //   icon: "success",
          // }).then(function () {
          //   location.reload();
          // });
        },
        error: function (xhr, status, error) {
          var e = JSON.parse(xhr.responseText);
          var errorCode = e.fields;

          x = document.querySelectorAll(".myError");
          for (i = 0; i < x.length; i++) {
            x[i].textContent = "";
          }

          for (x in errorCode) {
            $("#" + x + "_error").text(errorCode[x]);
          }
        },
      });
    },
  });

  $.validator.addMethod(
    "valid_mobile",
    function (value, element, param) {
      var re = new RegExp("^[6-9][0-9]{9}$");
      return this.optional(element) || re.test(value); // Compare with regular expression
    },
    "Please enter valid mobile number."
  );
});
