async function addrows(rows,type) {
    const postList = document.getElementById("post-list");

    if(type == "standard") {
        //Richiesta all'html del post
        const response = await fetch("/resources/Smarty/templates/poststandard.html");
        const text = await response.text();
        const i1 = text.indexOf("<body>");
        const i2 = text.indexOf("</body>");
        const bodyHTML = text.substring(i1 + "<body>".length, i2);

        $.each(rows, function(i, row) {
            let node = document.createElement("div");
            postList.append(node);
            node.outerHTML = bodyHTML;

            document.getElementById("clickable").href += "?id=" + row.id;
            document.getElementById("clickable").id = row.id;
            document.getElementById("id-post-standard").id = row.id;
            document.getElementById("post-title").innerHTML = row.title;
            document.getElementById("post-title").id = row.id + "-post-title";
            document.getElementById("post-datetime").innerHTML = row.datetime;
            document.getElementById("post-datetime").id = row.id + "-post-datetime";
            document.getElementById("post-description").innerHTML = row.description;
            document.getElementById("post-description").id = row.id + "-post-description";
            document.getElementById("post-userId").innerHTML = row.iduser;
            document.getElementById("post-userId").id = row.id + "-post-userId";
            document.getElementById("post-report").value = row.id;
            document.getElementById("post-report").id = row.id + "-post-report";
        })

    } else if(type == "team") {
        //Richiesta all'html del post
        const response = await fetch("/resources/Smarty/templates/postteam.html");
        const text = await response.text();
        const i1 = text.indexOf("<body>");
        const i2 = text.indexOf("</body>");
        const bodyHTML = text.substring(i1 + "<body>".length, i2);

        $.each(rows, function(i, row) {
            let node = document.createElement("div");
            postList.append(node);
            node.outerHTML = bodyHTML;

            document.getElementById("id-post-team").id = row.id;
            document.getElementById("post-title").innerHTML = row.title;
            document.getElementById("post-title").id = row.id + "-post-title";
            document.getElementById("post-datetime").innerHTML = row.datetime;
            document.getElementById("post-datetime").id = row.id + "post-datetime";
            document.getElementById("post-description").innerHTML = row.description;
            document.getElementById("post-description").id = row.id + "-post-description";
            document.getElementById("post-userId").innerHTML = row.iduser;
            document.getElementById("post-userId").id = row.id + "-post-userId";
            document.getElementById("post-players").innerHTML = "Giocatori presenti: " + row.nPlayers + "/" + row.nMaxPlayers;
            document.getElementById("post-players").id = row.id + "-post-players";
            document.getElementById("post-time_").innerHTML = "Orario: " + row.time;
            document.getElementById("post-time_").id = row.id + "-post-time_";
            document.getElementById("post-report").value = row.id;
            document.getElementById("post-report").id = row.id + "-post-report";

        })
    } else if(type == "sell") {
        //Richiesta all'html del post
        const response = await fetch("/resources/Smarty/templates/postsell.html");
        const text = await response.text();
        const i1 = text.indexOf("<body>");
        const i2 = text.indexOf("</body>");
        const bodyHTML = text.substring(i1 + "<body>".length, i2);

        $.each(rows, function(i, row) {
            let node = document.createElement("div");
            postList.append(node);
            node.outerHTML = bodyHTML;

            document.getElementById("id-post-sell").id = row.id;
            document.getElementById("post-title").innerHTML = row.title;
            document.getElementById("post-title").id = row.id + "-post-title";
            document.getElementById("post-datetime").innerHTML = row.datetime;
            document.getElementById("post-datetime").id = row.id + "-post-datetime";
            document.getElementById("post-description").innerHTML = row.description;
            document.getElementById("post-description").id = row.id + "-post-description";
            document.getElementById("post-userId").innerHTML = row.iduser;
            document.getElementById("post-userId").id = row.id + "-post-userId";
            document.getElementById("post-price").innerHTML = "Prezzo: " + row.price + "€";
            document.getElementById("post-price").id = row.id + "-post-price";
            document.getElementById("post-report").value = row.id;
            document.getElementById("post-report").id = row.id + "-post-report";
            if(row.image == "") {
                document.getElementById("post-image").remove();
            } else {
                document.getElementById("post-thumbnail").src = "data:image/png;base64," + row.image;
                document.getElementById("post-thumbnailLink").href = "/post/get_image?id=" + row.id;
                document.getElementById("post-thumbnail").id = row.id + "-post-thumbnail";
                document.getElementById("post-thumbnailLink").id = row.id + "-post-thumbnailLink";
                document.getElementById("post-image").id = row.id + "-post-image";
            }
        })
    }
}