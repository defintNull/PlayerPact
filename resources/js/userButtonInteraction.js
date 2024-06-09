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
                document.getElementById(postTeamId + "-post-participate").innerHTML = "Already on the team";
                document.getElementById(postTeamId + "-post-participate").value = 1;
            } else {
                document.getElementById(postTeamId + "-post-participate").innerHTML = "Team up";
                document.getElementById(postTeamId + "-post-participate").value = 0;
            }
        }
    });
});

$(document).on('click', '#send-message-button', function() {
    let chatId = $(this).attr("data-id");
    let message = document.getElementById("message-box").value;
    document.getElementById("message-box").value = "";

    if(message !== "") {
        $.ajax({
            url: '/user/sendmessage',
            type: 'POST',
            data: {"chatId": chatId, "message": message},
            success: function(response) {
                document.cookie = "chatMessage="
                location.reload();
            }
        });
    }
}); 
