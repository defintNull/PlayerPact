$(document).ready(function(){
    // load the initial rows on page load
    // ajax call a scroll.php
    var initialData;

    var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var type = document.getElementById("type").value;

    $.ajax({
        url: 'autoscroll.php'+ '?type=' + type + '&date=' + date +"&time=" + time,
        success: function(data) {
            
            initialData = JSON.parse(data);

            if (initialData) {
                if (initialData.rows) {
                    addrows(initialData.rows,initialData.type);
                    $('.ajax-loader').hide();
                    if (initialData.offset) {
                        var s = document.getElementById("offset");
                        s.value = initialData.offset;
                    }
                    if (initialData.totalcount) {
                        var t = document.getElementById("total_count");
                        t.value = initialData.totalcount;
                    }
                }
            }
            windowOnScroll(initialData);

        }
    });
        
});

function windowOnScroll(initialData) {

    if($(document).height() == $(window).height()) {
        if($(".post-item").length == initialData.totalcount) {
            getMoreData(initialData)
        }
    }

    $(window).on("scroll", function(e){        
        if ($(window).scrollTop() >= ($(document).height() - $(window).height() - 60)) {
            if($(".post-item").length == initialData.totalcount) {
                getMoreData(initialData)
            }
        }
    });
}

function getMoreData(initialData) {
    $('.ajax-loader').show();
    $(window).off("scroll");

    if(initialData.offset == initialData.totalcount) {
        $.ajax({
            url: "autoscroll.php" + '?offset=' + initialData.offset + '&total_count=' + initialData.totalcount + '&type=' + initialData.type + '&date=' + initialData.date + '&time=' + initialData.time,
            type: "get",
            success: function (response) {
                
                initialData = JSON.parse(response);
                if (initialData.rows) {
                    addrows(initialData.rows,initialData.type);
                    if (initialData.offset) {
                        var s = document.getElementById("offset");
                        s.value = initialData.offset;
                    }
                    if (initialData.totalcount) {
                        var t = document.getElementById("total_count");
                        t.value = initialData.totalcount;
                    }
                    $('.ajax-loader').hide();
                }
                windowOnScroll(initialData);
            }
        });
    } else {
        $('.ajax-loader').hide();
    }
}

async function addrows(rows,type) {
    const postList = document.getElementById("post-list");

    if(type == "standard") {
        //Richiesta all'html del post
        const response = await fetch("/resources/Smarty/templates/poststandard.html");
        const text = await response.text();
        const i1 = text.indexOf("<body>");
        const i2 = text.indexOf("</body>");
        const bodyHTML = text.substring(i1 + "<body>".length, i2);

        $.each(rows, function(i, row) {
            let node = document.createElement("div");
            postList.append(node);
            node.outerHTML = bodyHTML;

            document.getElementById("id-post-standard").id = row.id;
            document.getElementById("post-title").innerHTML = row.title;
            document.getElementById("post-title").id = row.id + "-post-title"
            document.getElementById("datetime").innerHTML = row.datetime;
            document.getElementById("datetime").id = row.id + "-datetime"
            document.getElementById("description").innerHTML = row.description;
            document.getElementById("description").id = row.id + "-description"
            document.getElementById("user").innerHTML = row.iduser;
            document.getElementById("user").id = row.id + "-user"

        })
    }
}