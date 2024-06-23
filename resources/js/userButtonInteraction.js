$(document).ready(function() {
	let t = document.getElementById("message-box");

	if(t != null){
		t.addEventListener("keypress", function(event) {
			if(event.key === "Enter"){
				document.getElementById("send-message-button").click();
			}
		});
	}	
});

// Function to save a post on button click
$(document).on("click", ".savePostButton", function () {
	var postSaleId = $(this).attr("value");
	console.log(document.getElementById(postSaleId + "-save-post-image"));

	$.ajax({
		url: "/interestList/add",
		type: "POST",
		data: { postSaleId: postSaleId },
		success: function (response) {
			console.log(response);
			if (document.getElementById(postSaleId + "-save-post-image").value == 0) {
				document.getElementById(postSaleId + "-save-post-image").src = "/public/saved.png";
				document.getElementById(postSaleId + "-save-post-image").value = 1;
			} else if (document.getElementById(postSaleId + "-save-post-image").value == 1) {
				document.getElementById(postSaleId + "-save-post-image").src = "/public/save.png";
				document.getElementById(postSaleId + "-save-post-image").value = 0;
			} else {
				window.location.href = "/login";
			}
		},
	});
});

// Function to participate to a game on button click
$(document).on("click", ".participate-button", function () {
	var postTeamId = $(this).attr("data-id");

	$.ajax({
		url: "/post/participate",
		type: "POST",
		data: { postTeamId: postTeamId },
		success: function (response) {
			console.log(response);
			if(response != "Full") {
				if (document.getElementById(postTeamId + "-post-participate").value == 0) {
					document.getElementById(postTeamId + "-post-participate").textContent = "Already on the team";
					let nPlayers = parseInt(document.getElementById(postTeamId + "-post-players").textContent.split(": ")[1].split("/")[0]);
					let nMaxPlayers = parseInt(document.getElementById(postTeamId + "-post-players").textContent.split(": ")[1].split("/")[1]);
					document.getElementById(postTeamId + "-post-players").textContent = "Current players: " + (nPlayers + 1) + "/" + nMaxPlayers;
					document.getElementById(postTeamId + "-post-participate").value = 1;
				} else if (document.getElementById(postTeamId + "-post-participate").value == 1) {
					document.getElementById(postTeamId + "-post-participate").textContent = "Team up";
					let nPlayers = parseInt(document.getElementById(postTeamId + "-post-players").textContent.split(": ")[1].split("/")[0]);
					let nMaxPlayers = parseInt(document.getElementById(postTeamId + "-post-players").textContent.split(": ")[1].split("/")[1]);
					document.getElementById(postTeamId + "-post-players").textContent = "Current players: " + (nPlayers - 1) + "/" + nMaxPlayers;
					document.getElementById(postTeamId + "-post-participate").value = 0;
				} else {
					window.location.href = "/login";
				}
			}
		},
	});
});

// Function that sends chat messages
$(document).on("click", "#send-message-button", function () {
	let chatId = $(this).attr("data-id");
	let message = document.getElementById("message-box").value;
	document.getElementById("message-box").value = "";

	if (message !== "") {
		$.ajax({
			url: "/user/sendmessage",
			type: "POST",
			data: { chatId: chatId, message: message },
			success: function (response) {
				document.cookie = "chatMessage=";
				location.reload();
			},
		});
	}
});

$(document).on("click", ".delete-button", function (event) {
	event.preventDefault();
	event.stopPropagation();
	console.log("D");
	if(confirm("Are you sure you want to delete the post?")) {
		let postId = $(this).attr("data-id");
		let postType = $(this).attr("data-type");

		$.ajax({
			url: "/post/delete",
			type: "POST",
			data: { postId: postId, postType: postType },
			success: function (response) {
				console.log(response);
				console.log(document.getElementById(postId + "-" + postType));
				document.getElementById(postId + "-" + postType).remove();
				window.location.href = "/user/profile";
			},
		});

	}
});
