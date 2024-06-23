$(document).ready(function () {
	var initialData;

	var offset = document.getElementById("offset").value;
	var totalcount = document.getElementById("totalcount").value;
	var type = document.getElementById("type").value;
	
	$.ajax({
		url: "/autoscroll/load" + "?offset=" + offset + "&totalcount=" + totalcount + "&type=" + type + "&date=" + date.value + "&time=" + time.value,
		success: function (data) {
			//console.log(data);
			try {
				initialData = JSON.parse(data);
			} catch (err) {
				//console.log(err);
				window.location.href = "/error/e404"; 
			}
			
			if(initialData.rows.length == 0){
				const node = document.createElement("div");
				const textnode = document.createTextNode("No post to show");
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

function windowOnScroll(initialData) {

	$(window).on("scroll", function (e) {
		if ($(window).scrollTop() >= $(document).height() - $(window).height() - 60) {
			getMoreData(initialData);
		}
	});
}

function getMoreData(initialData) {
	$(".ajax-loader").show();
	$(window).off("scroll");

	if (initialData.offset == initialData.totalcount) {
		$.ajax({
			url:"/autoscroll/load" +"?offset=" +initialData.offset +"&totalcount=" +initialData.totalcount +"&type=" +initialData.type +"&date=" +date.value +"&time=" +time.value,type: "get",
			success: function (response) {
				//console.log(response);
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
