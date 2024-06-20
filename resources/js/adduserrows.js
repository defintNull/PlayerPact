async function addrows(rows, type) {
	const moderatorList = document.getElementById("user-list");

	if (type == "user") {
		//Richiesta all'html del commento
		const response = await fetch("/resources/Smarty/templates/moderator/autoscrollCards/user.html");
		const text = await response.text();
		const i1 = text.indexOf("<body>");
		const i2 = text.indexOf("</body>");
		const bodyHTML = text.substring(i1 + "<body>".length, i2);

		$.each(rows, function (i, row) {
			let node = document.createElement("div");
			moderatorList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("user-id").id = row.id;
			document.getElementById("user-username").textContent = row.username;
			document.getElementById("user-username").id = row.id + "-user-username";
			document.getElementById("user-email").textContent = row.email;
			document.getElementById("user-email").id = row.id + "-user-email";
			document.getElementById("user-delete-button").dataset.id = row.id;
			document.getElementById("user-delete-button").id = row.id + "-user-delete-button";
			
			if (row.image == "/public/defaultPropic.png") {
				document.getElementById("user-thumbnail").src = "/public/defaultPropic.png";
			} else {
				document.getElementById("user-thumbnail").src = "data:image/png;base64," + row.image;
			}
			document.getElementById("user-thumbnail").id = row.id + "-user-thumbnail";
			document.getElementById("user-profile-image").id = row.id + "-user-profile-image";
		});
	}
}