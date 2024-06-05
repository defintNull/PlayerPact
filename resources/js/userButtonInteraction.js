$(document).on('click', '.savePostButton', function() {
    // Codice per gestire il click sull'elemento
    var sellPostId = $(this).attr("value");
    
    $.ajax({
        url: "/interestlist/add",
        type: "POST",
        data: {"sellPostId": sellPostId},
        success: function() {//response) {
            //console.log(response);
            // Cambiare immagine di salvataggio post e partecipazione team
            if(document.getElementById(sellPostId + "-save-post-image").value == 0) {
                document.getElementById(sellPostId + "-save-post-image").src = "/public/saved.png";
                document.getElementById(sellPostId + "-save-post-image").value = 1;
            } else {
                document.getElementById(sellPostId + "-save-post-image").src = "/public/save.png";
                document.getElementById(sellPostId + "-save-post-image").value = 0;
            }
            
        }
    });
});

$(document).on('click', '.participateButton', function() {
    var teamPostId = $(this).attr("data-id");

    $.ajax({
        url: "/post/participate",
        type: "POST",
        data: {"teamPostId": teamPostId},
        success: function() {//response) {
            //console.log(response);
            // Cambiare immagine di salvataggio post e partecipazione team
            if(document.getElementById(teamPostId + "-post-participate").value == 0) {
                document.getElementById(teamPostId + "-post-participate").innerHTML = "Partecipi già";
                document.getElementById(teamPostId + "-post-participate").value = 1;
            } else {
                document.getElementById(teamPostId + "-post-participate").innerHTML = "Partecipa";
                document.getElementById(teamPostId + "-post-participate").value = 0;
            }
            
        }
    });
});

