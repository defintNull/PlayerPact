/**
 * Makes the first load for chat section once the page is ready using an ajax call
 *
 */
$(document).ready(function () {
	var initialData;

	var offset = document.getElementById("offset").value;
	var totalcount = document.getElementById("totalcount").value;
	var type = document.getElementById("type").value;
	const userId = document.getElementsByClassName("upper-bar-username")[0].textContent;

	$.ajax({
		url: "/autoscroll/loadbyid" + "?id=" + userId + "&offset=" + offset + "&totalcount=" + totalcount + "&type=" + type + "&date=" + date.value + "&time=" + time.value,
		success: function (data) {
			//console.log(data);
			try {
				initialData = JSON.parse(data);
			} catch (err) {
				//console.log(err);
				window.location.href = "/error/e404"; //ERRORE ESCE QUI
			}

			if (initialData.rows == null || initialData.rows.length == 0) {
				const node = document.createElement("div");
				const textnode = document.createTextNode("No chat to show");
				node.appendChild(textnode);
				document.getElementById("main-body").appendChild(node);
			}

			if (initialData) {
				if (initialData.rows) {
					addrows(initialData.rows, initialData.type);
					$(".ajax-loader").hide();
					if (initialData.offset) {
						var s = document.getElementById("offset");
						s.value = initialData.offset;
					}
					if (initialData.totalcount) {
						var t = document.getElementById("totalcount");
						t.value = initialData.totalcount;
					}
				}
			}
			windowOnScroll(initialData);
		},
	});
});

/**
 * Calls a function to load more cards if the user is scrolling down
 *
 * @param {Array} initialData - The data loaded from the html needed for the correct count and display of the cards
 */
function windowOnScroll(initialData) {
	if ($(document).height() == $(window).height()) {
		if ($(".post-item").length == initialData.totalcount) {
			getMoreData(initialData);
		}
	}

	$(window).on("scroll", function (e) {
		if ($(window).scrollTop() >= $(document).height() - $(window).height() - 60) {
			if ($(".chat-item").length == initialData.totalcount) {
				getMoreData(initialData);
			}
		}
	});
}

/**
 * Makes next cards loads if the user scrolls down using an ajax call
 * 
 * @param {Array} initialData - The data loaded from the html needed for the correct count and display of the cards
 */
function getMoreData(initialData) {
	$(".ajax-loader").show();
	$(window).off("scroll");
	if (initialData.offset == initialData.totalcount) {
		const userId = document.getElementsByClassName("upper-bar-username")[0].textContent;
		$.ajax({
			url:"/autoscroll/loadbyid" +"?id=" +userId +"&offset=" +initialData.offset +"&totalcount=" +initialData.totalcount +"&type=" +initialData.type +"&date=" +date.value +"&time=" +time.value,type: "get",
			success: function (response) {
				try {
					initialData = JSON.parse(response);
				} catch (err) {
					window.location.href = "/error/e404";
				}

				if (initialData.rows) {
					addrows(initialData.rows, initialData.type);
					if (initialData.offset) {
						var s = document.getElementById("offset");
						s.value = initialData.offset;
					}
					if (initialData.totalcount) {
						var t = document.getElementById("totalcount");
						t.value = initialData.totalcount;
					}
					$(".ajax-loader").hide();
				}
				windowOnScroll(initialData);
			},
		});
	} else {
		$(".ajax-loader").hide();
	}
}
