/**
 * Generate confirm window when admin delete a mod
 *
 */
$(document).on("click", ".mod-delete-button", function () {
	if(confirm("Are you sure you want to delete this mod?")){
		var modId = $(this).attr("data-id");

		$.ajax({
			url: "/admin/deleteMod",
			type: "POST",
			data: { modId: modId },
			success: function (response) {
				//console.log(response);
				window.location.href = "/admin/manageMods";
			},
		});
	}
});
