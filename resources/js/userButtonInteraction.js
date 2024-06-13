// Function to save a post on button click
$(document).on('click', '.savePostButton', function() {
    var postSaleId = $(this).attr("value");
    
    $.ajax({
        url: "/interestlist/add",
        type: "POST",
        data: {"postSaleId": postSaleId},
        success: function(response) {
            console.log(response);
            if(document.getElementById(postSaleId + "-save-post-image").value == 0) {
                document.getElementById(postSaleId + "-save-post-image").src = "/public/saved.png";
                document.getElementById(postSaleId + "-save-post-image").value = 1;
            } else {
                document.getElementById(postSaleId + "-save-post-image").src = "/public/save.png";
                document.getElementById(postSaleId + "-save-post-image").value = 0;
            }
        }
    });
});

// Function to participate to a game on button click
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

// Function that sends chat messages
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