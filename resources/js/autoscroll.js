$(document).ready(function(){
    // load the initial rows on page load
    //Chiamata ajax a scroll.php
    let initialData;

    $.ajax({
        url: 'scroll.php',
        success: function(data) {
          initialData = JSON.parse(data);
        }
    });
    
    if (initialData) {
        if (initialData.rows) {
            addrows(initialData.rows);
            $('.ajax-loader').hide();
        }
    }
    windowOnScroll(initialData);
        
});
function windowOnScroll(initialData) {
    $(window).on("scroll", function(e){
        if ($(window).scrollTop() == $(document).height() - $(window).height()){
            console.log('test');
            if($(".post-item").length < initialData.totalcount) {
                let offset = initialData.offset;
                getMoreData(offset,initialData)
            }
        }
    });
}
function getMoreData(offset,initialData) {
    $('.ajax-loader').show();
    $(window).off("scroll");
    $.ajax({
        url: "scroll.php" + '?dataOnly=1&offset=' + offset,
        type: "get",
        success: function (response) {
            response = JSON.parse(response);
            if (response.rows) {
                addrows(response.rows);
                if (response.offset) {
                    var s = document.getElementById("offset");
                    s.value = response.offset;
                }
                $('.ajax-loader').hide();
            }
            windowOnScroll(initialData);
        }
    });
}
function addrows(rows) {
    let postList = document.getElementById("post-list");
    $.each(rows, function (i, row) {
        let rowHtml = '<div class="post-item" id="'+row.id+'"><p class="post-title">'+row.title+'</p><p>'+row.content+'</p></div>';
        postList.append(rowHtml);
    });
}
