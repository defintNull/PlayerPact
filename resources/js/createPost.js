$(document).ready(function(){
    //var e = document.getElementById("postChoice");
    createStandardChoicePage();
    var choice;
    var prevChoice;
    $('#postChoice').on('click', 'a.dropdown-item', function(){
        choice = $(this).text();
        document.getElementById("dropdown").innerHTML = choice;
        if(prevChoice != choice){
            if(choice == "Standard"){
                createStandardChoicePage();
            }
            else if(choice == "Vendita"){
                createSellChoicePage();
            }
            else if(choice == "Team"){
                createTeamChoicePage();
            }
        }
        prevChoice = choice;
    });
});

async function createStandardChoicePage() {
    const element = document.getElementById("jsAddedMenu");
    if(element != null){
        element.remove();
    }
    const postMenu = document.getElementById("postMenu");
    const response = await fetch("/resources/Smarty/templates/choiceStandard.html");
    const text = await response.text();
    const i1 = text.indexOf("<body>");
    const i2 = text.indexOf("</body>");
    const bodyHTML = text.substring(i1 + "<body>".length, i2);

    let node = document.createElement("div");
    postMenu.append(node);
    node.outerHTML = bodyHTML;
}

async function createSellChoicePage() {
    const element = document.getElementById("jsAddedMenu");
    if(element != null){
        element.remove();
    }
    const postMenu = document.getElementById("postMenu");
    const response = await fetch("/resources/Smarty/templates/choiceSell.html");
    const text = await response.text();
    const i1 = text.indexOf("<body>");
    const i2 = text.indexOf("</body>");
    const bodyHTML = text.substring(i1 + "<body>".length, i2);

    let node = document.createElement("div");
    postMenu.append(node);
    node.outerHTML = bodyHTML;
}

async function createTeamChoicePage() {
    const element = document.getElementById("jsAddedMenu");
    if(element != null){
        element.remove();
    }
    const postMenu = document.getElementById("postMenu");
    const response = await fetch("/resources/Smarty/templates/choiceTeam.html");
    const text = await response.text();
    const i1 = text.indexOf("<body>");
    const i2 = text.indexOf("</body>");
    const bodyHTML = text.substring(i1 + "<body>".length, i2);

    let node = document.createElement("div");
    postMenu.append(node);
    node.outerHTML = bodyHTML;
}