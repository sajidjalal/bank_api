$(function () {
	$("form[name='productDetailsEdit']").validate({
		rules: {
			// email_signin: {
			// 	required: true,
			// 	email: true,
			// },
			// password_signin: {
			// 	required: true,
			// 	minlength: 5,
			// },
		},

		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
			},
			email: "Please enter a valid email address",
		},

		submitHandler: function (form) {
			var itterate = $(".dropped");
			var data_array = new Array();
			$(".dropped").each(function () {
				var item = {};
				item["ppdid"] = $(this).data("id");
				item["quantity"] = $(this).data("quantity");
				item["rate"] = $(this).data("rate");
				item["value"] = $(this).val();

				data_array.push(item);
			});
			var serialized = JSON.stringify(data_array);

			$.ajax({
				url: "/productDetailsEditPost",
				type: "POST",
				// dataType: "json",
				// data: $("#itemInformationsssss").serialize(),
				data: { data: serialized },

				success: function (e) {
					swal({
						title: "Success",
						text: e.message,
						icon: "success",
					}).then(function () {
						location.reload();
					});
				},
				error: function (e) {
					swal({
						title: "Failed",
						text: e.responseJSON.message,
						icon: "warning",
					}).then(function () {
						location.reload();
					});
				},
			});
		},
	});
});
