$(document).on("click", "#report-ignore", function () {
    if(confirm("Are you sure you want to ignore this report?")){
        var reportId = document.getElementById("report").dataset.id;

        $.ajax({
            url: "/moderator/ignoreReport",
            type: "POST",
            data: { reportId: reportId },
            success: function (response) {
                //console.log(response);
                window.location.href = "/moderator/reports";
            },
        });
    }
});

$(document).on("click", "#report-delete-post", function () {
    if(confirm("Are you sure you want to delete this post/comment?")){
        var reportId = document.getElementById("report").dataset.id;
        var reportedId = document.getElementById("reported").dataset.id;
        var type = document.getElementById("reported").dataset.type;

        $.ajax({
            url: "/moderator/deleteReportedElement",
            type: "POST",
            data: { reportedId: reportedId,
                    type: type,
                    reportId: reportId
            },
            success: function (response) {
                //console.log(response);
                window.location.href = "/moderator/reports";
            },
        });
    }
});

$(document).on("click", "#report-ban-user", function () {
    if(confirm("Are you sure you want to ban this user?")){
        var reportId = document.getElementById("report").dataset.id;
        var banDate = document.getElementById("ban-until").value;
        var userId = document.getElementById("reported").dataset.ownerid;

        //console.log(banDate);

        $.ajax({
            url: "/moderator/banUser",
            type: "POST",
            data: { banDate: banDate,
                    reportId: reportId,
                    userId: userId
            },
            success: function (response) {
                //console.log(response);
                if(response == "dateNotValid"){
                    let reportType = document.getElementById("report-type").textContent.split(": ")[1];
                    window.location.href = "/moderator/reportDetail?id=" + reportId + "&type=" + reportType;
                } else {
                    window.location.href = "/moderator/reports";
                }
            },
        });
    }
});

$(document).on("click", "#report-delete-user", function () {
	if(confirm("Are you sure you want to delete this user?")){
		var userId = document.getElementById("reported").dataset.ownerid;
        var reportId = document.getElementById("report").dataset.id;

		$.ajax({
			url: "/moderator/deleteUserAfterReport",
			type: "POST",
			data: { userId: userId ,
                    reportId: reportId
            },
			success: function (response) {
				//console.log(response);
				window.location.href = "/moderator/users";
			},
		});
	}
});