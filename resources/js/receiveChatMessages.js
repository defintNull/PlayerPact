// This script 

$(document).ready(function() {
    let oldMsg = getCookie("chatMessage");

    if(oldMsg !== ""){
        document.getElementById("message-box").focus();
        document.getElementById("message-box").value = oldMsg;
    }

    var intervalId = window.setInterval(function(){
        if($(window).scrollTop() <= 250){
            let message = document.getElementById("message-box").value;
            document.cookie = "chatMessage=" + message;
            location.reload();
        }
    }, 5000);
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}