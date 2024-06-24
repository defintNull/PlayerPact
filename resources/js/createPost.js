/**
 * Configure the drop-down item for post creation
 *
 */
$(document).ready(function () {
	//var e = document.getElementById("postChoice");
	createStandardChoicePage();
	var choice;
	var prevChoice;
	$("#postChoice").on("click", "a.dropdown-item", function () {
		choice = $(this).text();
		document.getElementById("dropdown").textContent = choice;
		if (prevChoice != choice) {
			if (choice == "Standard") {
				createStandardChoicePage();
			} else if (choice == "Sale") {
				createSaleChoicePage();
			} else if (choice == "Team") {
				createTeamChoicePage();
			}
		}
		prevChoice = choice;
	});
});

/**
 * Configure Standard creation page
 *
 */
async function createStandardChoicePage() {
	const element = document.getElementById("jsAddedMenu");
	if (element != null) {
		element.remove();
	}
	const postMenu = document.getElementById("postMenu");
	const response = await fetch("/resources/Smarty/templates/user/choiceStandard.html");
	const text = await response.text();
	const i1 = text.indexOf("<body>");
	const i2 = text.indexOf("</body>");
	const bodyHTML = text.substring(i1 + "<body>".length, i2);

	let node = document.createElement("div");
	postMenu.append(node);
	node.outerHTML = bodyHTML;
}

/**
 * Configure Sale creation page
 *
 */
async function createSaleChoicePage() {
	const element = document.getElementById("jsAddedMenu");
	if (element != null) {
		element.remove();
	}
	const postMenu = document.getElementById("postMenu");
	const response = await fetch("/resources/Smarty/templates/user/choiceSale.html");
	const text = await response.text();
	const i1 = text.indexOf("<body>");
	const i2 = text.indexOf("</body>");
	const bodyHTML = text.substring(i1 + "<body>".length, i2);

	let node = document.createElement("div");
	postMenu.append(node);
	node.outerHTML = bodyHTML;
}

/**
 * Configure Team creation page
 *
 */
async function createTeamChoicePage() {
	const element = document.getElementById("jsAddedMenu");
	if (element != null) {
		element.remove();
	}
	const postMenu = document.getElementById("postMenu");
	const response = await fetch("/resources/Smarty/templates/user/choiceTeam.html");
	const text = await response.text();
	const i1 = text.indexOf("<body>");
	const i2 = text.indexOf("</body>");
	const bodyHTML = text.substring(i1 + "<body>".length, i2);

	let node = document.createElement("div");
	postMenu.append(node);
	node.outerHTML = bodyHTML;
}
