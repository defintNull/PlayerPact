// This script implements polling onto database, which means that if there are new messages, it refreshes the page
// to display new messages in order.

$(document).ready(function () {
	let oldMsg = getCookie("chatMessage");

	if (oldMsg !== undefined && oldMsg !== "") {
		document.getElementById("message-box").focus();
		document.getElementById("message-box").value = oldMsg;
	}

	var intervalId = window.setInterval(function () {
		let chatId = document.getElementById("send-message-button").dataset.id;

		if ($(window).scrollTop() <= 400) {
			$.ajax({
				url: "/user/countchatmessages",
				type: "post",
				data: { chatId: chatId },
				success: function (response) {
					let nMessages = document.getElementById("chat-datetime").dataset.nmessages;
					if (response > nMessages) {
						let message = document.getElementById("message-box").value;
						document.cookie = "chatMessage=" + message;
						location.reload();
						document.getElementById("chat-datetime").dataset.nmessages = response;
					}
				},
			});
		}
	}, 1000);
});

function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(";").shift();
}
