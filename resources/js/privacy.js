$(document).on("click", "#change-username", function () {
	//console.log("Ciao");
	document.getElementById("change-username").innerHTML = "Confirm";
	document.getElementById("change-username").id = "confirm-change-username";

	document.getElementById("username-textbox").dataset.old = document.getElementById("username-textbox").value;
	document.getElementById("username-textbox").removeAttribute("readonly");
});

$(document).on("click", "#confirm-change-username", function () {
	let newUsername = document.getElementById("username-textbox").value;

	document.getElementById("confirm-change-username").innerHTML = "Change";
	document.getElementById("confirm-change-username").id = "change-username";

	document.getElementById("username-textbox").setAttribute("readonly", "");

	$.ajax({
		url: "/user/changeusername",
		type: "POST",
		data: { newUsername: newUsername },
		success: function (response) {
			//console.log(response);
		},
	});
});

$(document).on("click", "#change-password", function () {
	//console.log("Ciao");
	document.getElementById("change-password").innerHTML = "Confirm";
	document.getElementById("change-password").id = "confirm-change-password";

	document.getElementById("password-textbox").value = "";
	document.getElementById("password-textbox").removeAttribute("readonly");
});

$(document).on("click", "#confirm-change-password", function () {
	let newPassword = document.getElementById("password-textbox").value;

	document.getElementById("confirm-change-password").innerHTML = "Change";
	document.getElementById("confirm-change-password").id = "change-password";

	document.getElementById("password-textbox").setAttribute("readonly", "");

	$.ajax({
		url: "/user/changepassword",
		type: "POST",
		data: { newPassword: newPassword },
		success: function (response) {
			//console.log(response);
		},
	});
});
