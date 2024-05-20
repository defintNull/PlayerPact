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

function addrows(rows,type) {
    let postList = document.getElementById("post-list");
    $.each(rows, function (i, row) {
        let node = document.createElement("div");
        postList.append(node);
        if(type == 'standard') {
            node.outerHTML = 
            '<div class="row post-item" id='+row.id+'>'+
            '<div class="description">'+row.iduser+'</div>'+
            '<div class="row title-post-bar">' +
            '<div class="col post-title">'+row.title+'</div>'+
            '<div class="col datetime">'+row.datetime+'</div>'+
            '</div>' +
            '<div class="row body-post">' +
            '<div class="description">'+row.description+'</div>'+
            '</div>' +
            '</div>';
        }
    });
}