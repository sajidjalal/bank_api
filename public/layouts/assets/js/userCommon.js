function logout() {
  var data = new FormData();

  if ("token" in localStorage) {
    token = localStorage.getItem("token");
  } else {
    token = "";
  }

  data.append("token", token);
  var makeNull = "";
  $.ajax({
    type: "POST",
    url: "/admin/logout",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    mimeType: "multipart/form-data",
    success: function (e) {
      localStorage.setItem("token", makeNull);
      window.location.href = "/";
    },
    error: function (xhr, status, error) {
      localStorage.setItem("token", makeNull);
      window.location.href = "/";
      //   e = xhr.responseText;
      //   swal({
      //     title: "Alert",
      //     text: e.message,
      //     icon: "warning",
      //   });
    },
  }); // ajax end here
}
