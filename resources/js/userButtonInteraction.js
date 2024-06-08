$(document).on('click', '.savePostButton', function() {
    var postSellId = $(this).attr("value");
    
    $.ajax({
        url: "/interestlist/add",
        type: "POST",
        data: {"postSellId": postSellId},
        success: function(response) {
            console.log(response);
            if(document.getElementById(postSellId + "-save-post-image").value == 0) {
                document.getElementById(postSellId + "-save-post-image").src = "/public/saved.png";
                document.getElementById(postSellId + "-save-post-image").value = 1;
            } else {
                document.getElementById(postSellId + "-save-post-image").src = "/public/save.png";
                document.getElementById(postSellId + "-save-post-image").value = 0;
            }
        }
    });
});

$(document).on('click', '.participateButton', function() {
    var postTeamId = $(this).attr("data-id");

    $.ajax({
        url: "/post/participate",
        type: "POST",
        data: {"postTeamId": postTeamId},
        success: function(response) {
            console.log(response);
            if(document.getElementById(postTeamId + "-post-participate").value == 0) {
                document.getElementById(postTeamId + "-post-participate").innerHTML = "Partecipi già";
                document.getElementById(postTeamId + "-post-participate").value = 1;
            } else {
                document.getElementById(postTeamId + "-post-participate").innerHTML = "Partecipa";
                document.getElementById(postTeamId + "-post-participate").value = 0;
            }
        }
    });
});

