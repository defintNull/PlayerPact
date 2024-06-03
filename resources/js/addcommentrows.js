async function addrows(rows,type) {
    const commentList = document.getElementById("commentSection");

    if(type == "comment") {
        
        //Richiesta all'html del commento
        const response = await fetch("/resources/Smarty/templates/comment.html");
        const text = await response.text();
        const i1 = text.indexOf("<body>");
        const i2 = text.indexOf("</body>");
        const bodyHTML = text.substring(i1 + "<body>".length, i2);

        

        $.each(rows, function(i, row) {
            let node = document.createElement("div");
            commentList.append(node);
            node.outerHTML = bodyHTML;

            document.getElementById("comment-id").id = row.id;
            document.getElementById("comment-username").innerHTML = row.user;
            document.getElementById("comment-username").id = row.id + "-comment-username";
            document.getElementById("comment-datetime").innerHTML = row.datetime;
            document.getElementById("comment-datetime").id = row.id + "-comment-datetime";
            document.getElementById("comment-description").innerHTML = row.description;
            document.getElementById("comment-description").id = row.id + "-comment-description";
            document.getElementById("comment-report").value = row.id;
            document.getElementById("comment-report").id = row.id + "-comment-report";
        })
    } 
}