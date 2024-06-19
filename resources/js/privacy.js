$(document).ready(function () {
	document.getElementById("profile-image-upload").addEventListener("change", function () {
		document.getElementById("hidden-image-submit").click();
	});
});

$(document).on("click", "#big-profile-image", function () {
	$("input[id='profile-image-upload']").click();
});

$(document).on("click", "#change-email", function () {
	//console.log("Ciao");
	document.getElementById("change-email").textContent = "Confirm";
	document.getElementById("change-email").id = "confirm-change-email";

	document.getElementById("email-textbox").removeAttribute("readonly");
});

$(document).on("click", "#confirm-change-email", function () {
	let newEmail = document.getElementById("email-textbox").value;

	document.getElementById("confirm-change-email").textContent = "Change";
	document.getElementById("confirm-change-email").id = "change-email";

	document.getElementById("email-textbox").setAttribute("readonly", "");

	$.ajax({
		url: "/user/changeEmail",
		type: "POST",
		data: { newEmail: newEmail },
		success: function (response) {
			//console.log(response);
			if (response == "error_email") {
				window.location.href = "/user/privacy?info=error_email";
			} else if (response == "email_exists") {
				window.location.href = "/user/privacy?info=email_exists";
			} else {
				window.location.href = "/user/privacy";
			}
		},
	});
});

$(document).on("click", "#change-username", function () {
	//console.log("Ciao");
	document.getElementById("change-username").textContent = "Confirm";
	document.getElementById("change-username").id = "confirm-change-username";

	document.getElementById("username-textbox").dataset.old = document.getElementById("username-textbox").value;
	document.getElementById("username-textbox").removeAttribute("readonly");
});

$(document).on("click", "#confirm-change-username", function () {
	let newUsername = document.getElementById("username-textbox").value;

	document.getElementById("confirm-change-username").textContent = "Change";
	document.getElementById("confirm-change-username").id = "change-username";

	document.getElementById("username-textbox").setAttribute("readonly", "");

	$.ajax({
		url: "/user/changeusername",
		type: "POST",
		data: { newUsername: newUsername },
		success: function (response) {
			if (response == "username_missing") {
				window.location.href = "/user/privacy?info=username_missing";
			} else if (response == "username_exists") {
				window.location.href = "/user/privacy?info=username_exists";
			}
			else {
				window.location.href = "/user/privacy";
			}
		},
	});
});

$(document).on("click", "#change-password", function () {
	//console.log("Ciao");
	document.getElementById("change-password").textContent = "Confirm";
	document.getElementById("change-password").id = "confirm-change-password";

	document.getElementById("password-textbox").value = "";
	document.getElementById("password-textbox").removeAttribute("readonly");
});

$(document).on("click", "#confirm-change-password", function () {
	let newPassword = document.getElementById("password-textbox").value;

	document.getElementById("confirm-change-password").textContent = "Change";
	document.getElementById("confirm-change-password").id = "change-password";

	document.getElementById("password-textbox").setAttribute("readonly", "");

	$.ajax({
		url: "/user/changepassword",
		type: "POST",
		data: { newPassword: newPassword },
		success: function (response) {
			//console.log(response);
			if (response == "error_password") {
				window.location.href = "/user/privacy?info=error_password";
			} else {
				window.location.href = "/user/privacy";
			}
		},
	});
});
