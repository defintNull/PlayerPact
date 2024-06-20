async function addrows(rows, type) {
	const moderatorList = document.getElementById("report-list");
	
	if (type == "report") {
		//Richiesta all'html del commento
		const response = await fetch("/resources/Smarty/templates/moderator/autoscrollCards/report.html");
		const text = await response.text();
		const i1 = text.indexOf("<body>");
		const i2 = text.indexOf("</body>");
		const bodyHTML = text.substring(i1 + "<body>".length, i2);

		$.each(rows, function (i, row) {
			let node = document.createElement("div");
			moderatorList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("clickable").href += "?id=" + row.id + "&type=" + row.type;
			document.getElementById("clickable").id = row.id + "-clickable";
			document.getElementById("report-id").id = row.id;
			document.getElementById("report-username").textContent = "Reported by: " + row.username;
			document.getElementById("report-username").id = row.id + "-report-username";
			document.getElementById("report-idToReport").textContent = "Id: " + row.idToReport;
			document.getElementById("report-idToReport").id = row.id + "-report-idToReport";
			document.getElementById("report-type").textContent = "Type: " + row.type;
			document.getElementById("report-type").id = row.id + "-report-type";
			document.getElementById("report-datetime").textContent = row.datetime;
			document.getElementById("report-datetime").id = row.id + "-report-datetime";
		});
	} else if(type == "oldreport") {
		//Richiesta all'html del commento
		const response = await fetch("/resources/Smarty/templates/moderator/autoscrollCards/report.html");
		const text = await response.text();
		const i1 = text.indexOf("<body>");
		const i2 = text.indexOf("</body>");
		const bodyHTML = text.substring(i1 + "<body>".length, i2);

		$.each(rows, function (i, row) {
			let node = document.createElement("div");
			moderatorList.append(node);
			node.outerHTML = bodyHTML;

			document.getElementById("clickable").href ="/moderator/oldreportDetail" + "?id=" + row.id;
			document.getElementById("clickable").id = row.id + "-clickable";
			document.getElementById("report-id").id = row.id;
			document.getElementById("report-username").textContent = "Reported by: " + row.username;
			document.getElementById("report-username").id = row.id + "-report-username";
			document.getElementById("report-idToReport").textContent = "Id: " + row.idToReport;
			document.getElementById("report-idToReport").id = row.id + "-report-idToReport";
			document.getElementById("report-type").textContent = "Type: " + row.type;
			document.getElementById("report-type").id = row.id + "-report-type";
			document.getElementById("report-datetime").textContent = row.datetime;
			document.getElementById("report-datetime").id = row.id + "-report-datetime";
		});
	}
}
