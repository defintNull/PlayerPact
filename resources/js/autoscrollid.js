$(document).ready(function(){
    // load the initial rows on page load
    // ajax call a scroll.php
    var initialData;

    var offset = document.getElementById("offset").value;
    var totalcount = document.getElementById("totalcount").value;
    var type = document.getElementById("type").value;
    var id = document.getElementsByClassName("single-post")[0].id;

    $.ajax({
        url: '/autoscroll/loadbyid' + '?id=' + id + '&offset=' + offset + '&totalcount=' + totalcount + '&type=' + type + '&date=' + date.value + '&time=' + time.value,
        success: function(data) {
            
            initialData = JSON.parse(data);
            try {
                
            } catch(err) {
                window.location.href = "/error/e404";
            }
            

            if (initialData) {
                if (initialData.rows) {
                    addrows(initialData.rows,initialData.type);
                    $('.ajax-loader').hide();
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
            url: "/autoscroll/loadbyid" + '?id=' + id + '&offset=' + initialData.offset + '&totalcount=' + initialData.totalcount + '&type=' + initialData.type + '&date=' + date.value + '&time=' + time.value,
            type: "get",
            success: function (response) {
                
                try {
                    initialData = JSON.parse(response);
                } catch(err) {
                    window.location.href = "/error/e404";
                }

                if (initialData.rows) {
                    addrows(initialData.rows,initialData.type);
                    if (initialData.offset) {
                        var s = document.getElementById("offset");
                        s.value = initialData.offset;
                    }
                    if (initialData.totalcount) {
                        var t = document.getElementById("totalcount");
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