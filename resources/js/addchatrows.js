async function addrows(rows, type) {
	const chatList = document.getElementById("chat-list");

	//Richiesta all'html della chat
	const response = await fetch("/resources/Smarty/templates/user/autoscrollCards/chatitem.html");
	const text = await response.text();
	const i1 = text.indexOf("<body>");
	const i2 = text.indexOf("</body>");
	const bodyHTML = text.substring(i1 + "<body>".length, i2);

	$.each(rows, function (i, row) {
		let node = document.createElement("div");
		chatList.append(node);
		node.outerHTML = bodyHTML;

		document.getElementById("clickable").href += "?id=" + row.id;
		document.getElementById("clickable").id = row.id;
		document.getElementById("id-chat").id = row.id;
		document.getElementById("post-title").textContent = row.posttitle;
		document.getElementById("post-title").id = row.id + "-post-title";
		document.getElementById("chat-datetime").textContent = row.datetime;
		document.getElementById("chat-datetime").id = row.id + "-chat-datetime";
		if (row.username) {
			document.getElementById("chat-user").textContent = row.username;
			document.getElementById("chat-user").id = row.id + "-chat-user";
		} else {
			document.getElementById("chat-user").style.display = "none";
			document.getElementById("chat-user").id = row.id + "-chat-user";
		}
	});
}
