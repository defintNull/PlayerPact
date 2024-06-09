// This script 

$(document).ready(function() {

    let oldMsg = getCookie("chatMessage");

    if(oldMsg !== ""){
        document.getElementById("message-box").focus();
        document.getElementById("message-box").value = oldMsg;
    }

    var intervalId = window.setInterval(function(){
        let chatId = document.getElementById("send-message-button").dataset.id;

        if($(window).scrollTop() <= 400){
            $.ajax({
                url: "/user/countchatmessages",
                type: "post",
                data: {"chatId": chatId},
                success: function(response) {
                    let nMessages = document.getElementById("chat-datetime").dataset.nmessages;
                    console.log(response);
                    console.log(nMessages);
                    if (response > nMessages) { // Non capisco perché non funziona questo controllo
                        let message = document.getElementById("message-box").value;
                        document.cookie = "chatMessage=" + message;
                        //location.reload();
                        document.getElementById("chat-datetime").dataset.nmessages = response;
                    }
                }
            });
        }
    }, 5000);
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
