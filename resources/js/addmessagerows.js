async function addrows(rows, type) {
	const messageList = document.getElementById("message-list");

	if (type == "message") {
		//Richiesta all'html del commento
		const response = await fetch("/resources/Smarty/templates/message.html");
		const text = await response.text();
		const i1 = text.indexOf("<body>");
		const i2 = text.indexOf("</body>");
		const bodyHTML = text.substring(i1 + "<body>".length, i2);

		$.each(rows, function (i, row) {
			let node = document.createElement("div");
			messageList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("message-id").id = row.id;
			document.getElementById("message-username").innerHTML = row.user;
			document.getElementById("message-username").id = row.id + "-message-username";
			document.getElementById("message-datetime").innerHTML = row.datetime;
			document.getElementById("message-datetime").id = row.id + "-message-datetime";
			document.getElementById("message-description").innerHTML = row.description;
			document.getElementById("message-description").id = row.id + "-message-description";
		});
	}
}
