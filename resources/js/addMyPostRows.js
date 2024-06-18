async function addrows(rows) {
	const postList = document.getElementById("post-list");

	$.each(rows, async function (i, row) {
		if (row.type == "standard") {
			//Richiesta all'html del post
			const response = await fetch("/resources/Smarty/templates/poststandard.html");
			const text = await response.text();
			const i1 = text.indexOf("<body>");
			const i2 = text.indexOf("</body>");
			const bodyHTML = text.substring(i1 + "<body>".length, i2);
		
			let node = document.createElement("div");
			postList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("clickable").href += "?id=" + row.id;
			document.getElementById("clickable").id = row.id + "-clickable";
			document.getElementById("id-post-standard").id = row.id + "-standard";
			document.getElementById("post-title").textContent = row.title;
			document.getElementById("post-title").id = row.id + "-post-title";
			document.getElementById("post-datetime").textContent = row.datetime;
			document.getElementById("post-datetime").id = row.id + "-post-datetime";
			document.getElementById("post-description").textContent = row.description;
			document.getElementById("post-description").id = row.id + "-post-description";
			document.getElementById("post-userId").textContent = row.userId;
			document.getElementById("post-userId").id = row.id + "-post-userId";
			document.getElementById("post-report").value = row.id;
			document.getElementById("post-report").id = row.id + "-post-report";

			function isOwner() {
				return $.ajax({
					url: "/post/isowner",
					type: "POST",
					data: { postStandardId: row.id },
				});
			}
			isOwner()
				.then(async function (response) {
					//console.log(response);
					if(response == "1") {
						const deleteSection = document.getElementById("post-delete");

						const d = await fetch("/resources/Smarty/templates/deleteButton.html");
						const textD = await d.text();
						const i1D = textD.indexOf("<body>");
						const i2D = textD.indexOf("</body>");
						const bodyHTMLD = textD.substring(i1D + "<body>".length, i2D);

						let nodeD = document.createElement("div");
						deleteSection.append(nodeD);
						nodeD.outerHTML = bodyHTMLD;

						document.getElementById("post-delete").id = row.id + "-post-delete";
						document.getElementById("post-delete-button").id = row.id + "-post-delete-button";
						document.getElementById(row.id + "-post-delete-button").dataset.type = "standard";
						document.getElementById(row.id + "-post-delete-button").dataset.id = row.id;
					}
				})
				.catch(function (error) {
					console.error("Error:", error);
				});

		}
		else if (row.type == "team") {
			//Richiesta all'html del post
			const response = await fetch("/resources/Smarty/templates/postteam.html");
			const text = await response.text();
			const i1 = text.indexOf("<body>");
			const i2 = text.indexOf("</body>");
			const bodyHTML = text.substring(i1 + "<body>".length, i2);
	
			
			let node = document.createElement("div");
			postList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("id-post-team").id = row.id + "-team";
			document.getElementById("post-title").textContent = row.title;
			document.getElementById("post-title").id = row.id + "-post-title";
			document.getElementById("post-datetime").textContent = row.datetime;
			document.getElementById("post-datetime").id = row.id + "post-datetime";
			document.getElementById("post-description").textContent = row.description;
			document.getElementById("post-description").id = row.id + "-post-description";
			document.getElementById("post-userId").textContent = row.userId;
			document.getElementById("post-userId").id = row.id + "-post-userId";
			document.getElementById("post-players").textContent = "Current players: " + row.nPlayers + "/" + row.nMaxPlayers;
			document.getElementById("post-players").id = row.id + "-post-players";
			document.getElementById("post-time_").textContent = "Time to play: " + row.time;
			document.getElementById("post-time_").id = row.id + "-post-time_";
			document.getElementById("post-report").value = row.id;
			document.getElementById("post-report").id = row.id + "-post-report";
			document.getElementById("post-participate").dataset.id = row.id;
			document.getElementById("post-participate").id = row.id + "-post-participate";
			function isOwner() {
				return $.ajax({
					url: "/post/isowner",
					type: "POST",
					data: { postTeamId: row.id },
				});
			}
			isOwner()
				.then(async function (response) {
					//console.log(response);
					if(response == "1") {
						const deleteSection = document.getElementById("post-delete");

						const d = await fetch("/resources/Smarty/templates/deleteButton.html");
						const textD = await d.text();
						const i1D = textD.indexOf("<body>");
						const i2D = textD.indexOf("</body>");
						const bodyHTMLD = textD.substring(i1D + "<body>".length, i2D);

						let nodeD = document.createElement("div");
						deleteSection.append(nodeD);
						nodeD.outerHTML = bodyHTMLD;

						document.getElementById("post-delete").id = row.id + "-post-delete";
						document.getElementById("post-delete-button").id = row.id + "-post-delete-button";
						document.getElementById(row.id + "-post-delete-button").dataset.type = "team";
						document.getElementById(row.id + "-post-delete-button").dataset.id = row.id;
					}
				})
				.catch(function (error) {
					console.error("Error:", error);
				});

			function isSaved() {
				return $.ajax({
					url: "/post/isparticipating",
					type: "POST",
					data: { postTeamId: row.id },
				});
			}
			isSaved()
				.then(function (response) {
					//console.log(response);
					document.getElementById(row.id + "-post-participate").value = response;
					if (document.getElementById(row.id + "-post-participate").value == 1) {
						document.getElementById(row.id + "-post-participate").textContent = "Already on the team";
					} else if (document.getElementById(row.id + "-post-participate").value == 2) {
						document.getElementById(row.id + "-post-participate").textContent = "Already on the team";
						document.getElementById(row.id + "-post-participate").disabled = true;
					} else {
						document.getElementById(row.id + "-post-participate").textContent = "Team up";
					}
					//console.log("Done");
				})
				.catch(function (error) {
					console.error("Error:", error);
			});
		} else if (row.type == "sale") {
			//Richiesta all'html del post
			const response = await fetch("/resources/Smarty/templates/postsale.html");
			const text = await response.text();
			const i1 = text.indexOf("<body>");
			const i2 = text.indexOf("</body>");
			const bodyHTML = text.substring(i1 + "<body>".length, i2);
			let node = document.createElement("div");
			postList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("id-post-sale").id = row.id + "-sale";
			document.getElementById("post-title").textContent = row.title;
			document.getElementById("post-title").id = row.id + "-post-title";
			document.getElementById("post-datetime").textContent = row.datetime;
			document.getElementById("post-datetime").id = row.id + "-post-datetime";
			document.getElementById("post-description").textContent = row.description;
			document.getElementById("post-description").id = row.id + "-post-description";
			document.getElementById("post-userId").textContent = row.userId;
			document.getElementById("post-userId").id = row.id + "-post-userId";
			document.getElementById("post-price").textContent = "Price: " + row.price + "€";
			document.getElementById("post-price").id = row.id + "-post-price";
			document.getElementById("post-report").value = row.id;
			document.getElementById("post-report").id = row.id + "-post-report";

			function isOwner() {
				return $.ajax({
					url: "/post/isowner",
					type: "POST",
					data: { postSaleId: row.id },
				});
			}
			isOwner()
				.then(async function (response) {
					//console.log(response);
					if(response == "1") {
						const deleteSection = document.getElementById("post-delete");

						const d = await fetch("/resources/Smarty/templates/deleteButton.html");
						const textD = await d.text();
						const i1D = textD.indexOf("<body>");
						const i2D = textD.indexOf("</body>");
						const bodyHTMLD = textD.substring(i1D + "<body>".length, i2D);

						let nodeD = document.createElement("div");
						deleteSection.append(nodeD);
						nodeD.outerHTML = bodyHTMLD;

						document.getElementById("post-delete").id = row.id + "-post-delete";
						document.getElementById("post-delete-button").id = row.id + "-post-delete-button";
						document.getElementById(row.id + "-post-delete-button").dataset.type = "sale";
						document.getElementById(row.id + "-post-delete-button").dataset.id = row.id;
					}
				})
				.catch(function (error) {
					console.error("Error:", error);
				});

			function isBought() {
				return $.ajax({
					url: "/post/isBought",
					type: "POST",
					data: { postSaleId: row.id },
				});
			}
			isBought()
				.then(function (response) {
					//console.log(response);
					if (response == 0) {
						document.getElementById("post-buy").value = "Buy";
					} else if (response == 1) {
						document.getElementById("post-buy").value = "Chat created";
					} else if (response == 2) {
						document.getElementById("post-buy").value = "You are\nthe owner";
						document.getElementById("post-buy").disabled = true;
					}
					document.getElementById("post-buy").id = row.id + "-post-buy";
				})
				.catch(function (error) {
					console.error("Error:", error);
				});

			document.getElementById("post-save").value = row.id;
			document.getElementById("post-save").id = row.id + "-post-save";
			document.getElementById("save-post-image").id = row.id + "-save-post-image";
			document.getElementById("salepostform").id = row.id + "salepostform";
			document.getElementById(row.id + "salepostform").value = row.id;

			function isSaved() {
				return $.ajax({
					url: "/interestlist/issaved",
					type: "POST",
					data: { postSaleId: row.id },
				});
			}
			isSaved()
				.then(function (response) {
					//console.log(response);
					document.getElementById(row.id + "-save-post-image").value = response;
					if (document.getElementById(row.id + "-save-post-image").value == 1) {
						document.getElementById(row.id + "-save-post-image").src = "/public/saved.png";
					} else {
						document.getElementById(row.id + "-save-post-image").src = "/public/save.png";
					}
					//console.log("Done");
				})
				.catch(function (error) {
					console.error("Error:", error);
				});

			if (row.image == "") {
				document.getElementById("post-image").remove();
			} else {
				document.getElementById("post-thumbnail").src = "data:image/png;base64," + row.image;
				document.getElementById("post-thumbnailLink").href = "/post/get_image?id=" + row.id;
				document.getElementById("post-thumbnail").id = row.id + "-post-thumbnail";
				document.getElementById("post-thumbnailLink").id = row.id + "-post-thumbnailLink";
				document.getElementById("post-image").id = row.id + "-post-image";
			}
		}
	});
}
