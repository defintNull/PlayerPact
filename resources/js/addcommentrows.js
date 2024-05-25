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

            document.getElementById("comment").id = row.id;
            document.getElementById("user").innerHTML = row.user;
            document.getElementById("user").id = row.id + "-user";
            document.getElementById("datetime").innerHTML = row.datetime;
            document.getElementById("datetime").id = row.id + "-datetime";
            document.getElementById("description").innerHTML = row.description;
            document.getElementById("description").id = row.id + "-description";

        })

    } 
}