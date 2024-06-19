$(document).on("click", ".user-delete-button", function () {
	if(confirm("Are you sure you want to delete this user?")){
		var userId = $(this).attr("data-id");

		$.ajax({
			url: "/moderator/deleteUser",
			type: "POST",
			data: { userId: userId },
			success: function (response) {
				//console.log(response);
				window.location.href = "/moderator/users";
			},
		});
	}
});