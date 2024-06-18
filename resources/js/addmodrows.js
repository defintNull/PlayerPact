async function addrows(rows, type) {
	const moderatorList = document.getElementById("mod-list");

	if (type == "moderator") {
		//Richiesta all'html del commento
		const response = await fetch("/resources/Smarty/templates/admin/mod.html");
		const text = await response.text();
		const i1 = text.indexOf("<body>");
		const i2 = text.indexOf("</body>");
		const bodyHTML = text.substring(i1 + "<body>".length, i2);

		$.each(rows, function (i, row) {
			let node = document.createElement("div");
			moderatorList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("mod-id").id = row.id;
			document.getElementById("mod-username").textContent = row.username;
			document.getElementById("mod-username").id = row.id + "-mod-username";
			document.getElementById("mod-email").textContent = row.email;
			document.getElementById("mod-email").id = row.id + "-mod-email";
			document.getElementById("mod-profile-image").textContent = row.image;
			document.getElementById("mod-profile-image").id = row.id + "-mod-profile-image";
		});
	}
}
