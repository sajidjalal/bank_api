$(function () {
  $("#withdrawForm").validate({
    rules: {
      account_type: {
        required: true,
      },
      withdraw: {
        required: true,
        digits: true,
      },
    },
    messages: {
      withdraw: {
        digits: "Please provide Digits only",
      },
    },
    submitHandler: function (form) {
      var account_type = $("#withdrawForm").find("#account_type").val();
      var withdraw = $("#withdraw").val();

      var data = new FormData();

      data.append("account_type", account_type);
      data.append("withdraw", withdraw);

      x = document.querySelectorAll(".myError");
      for (i = 0; i < x.length; i++) {
        x[i].textContent = "";
      }

      $.ajax({
        url: "/withdraw-amount",
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
        },
        error: function (xhr, status, error) {
          var e = JSON.parse(xhr.responseText);
          var errorCode = e.fields;

          x = document.querySelectorAll(".myError");
          for (i = 0; i < x.length; i++) {
            x[i].textContent = "";
          }

          for (x in errorCode) {
            $("#withdrawForm")
              .find("#" + x + "_error")
              .text(errorCode[x]);
            // $("#" + x + "_error").text(errorCode[x]);
          }
        },
      });
    },
  });

  $("#depositForm").validate({
    rules: {
      account_type: {
        required: true,
      },
      deposite: {
        required: true,
        digits: true,
      },
    },
    messages: {
      deposite: {
        digits: "Please provide Digits only",
      },
    },
    submitHandler: function (form) {
      var account_type = $("#depositForm").find("#account_type").val();
      var account_type = $("#account_type").val();
      var deposite = $("#deposite").val();

      var data = new FormData();

      data.append("account_type", account_type);
      data.append("deposite", deposite);

      x = document.querySelectorAll(".myError");
      for (i = 0; i < x.length; i++) {
        x[i].textContent = "";
      }

      $.ajax({
        url: "/deposite-amount",
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
});
