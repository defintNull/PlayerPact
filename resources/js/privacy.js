$(document).on('click', '#change-username', function() {
    //console.log("Ciao");
    document.getElementById("change-username").innerHTML = "Confirm";
    document.getElementById("change-username").id = "confirm-change-username";

    document.getElementById("username-textbox").dataset.old = document.getElementById("username-textbox").value;
    document.getElementById("username-textbox").removeAttribute('readonly');
});

$(document).on('click', '#confirm-change-username', function() {
    let newUsername = document.getElementById("username-textbox").value;

    document.getElementById("confirm-change-username").innerHTML = "Change";
    document.getElementById("confirm-change-username").id = "change-username";

    document.getElementById("username-textbox").setAttribute('readonly', "");

    $.ajax({
        url: "/user/changeusername",
        type: "POST",
        data: {"newUsername": newUsername},
        success: function(response) {
            //console.log(response);
        }
    });
});