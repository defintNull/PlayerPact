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
            document.getElementById("datetime").innerHTML = row.datetime;
            document.getElementById("datetime").id = row.id + "-datetime";
            document.getElementById("description").innerHTML = row.description;
            document.getElementById("description").id = row.id + "-description";
            document.getElementById("user").innerHTML = row.iduser;
            document.getElementById("user").id = row.id + "-user";

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
            document.getElementById("datetime").innerHTML = row.datetime;
            document.getElementById("datetime").id = row.id + "-datetime";
            document.getElementById("description").innerHTML = row.description;
            document.getElementById("description").id = row.id + "-description";
            document.getElementById("user").innerHTML = row.iduser;
            document.getElementById("user").id = row.id + "-user";
            document.getElementById("players").innerHTML = "Giocatori presenti: " + row.nPlayers + "/" + row.nMaxPlayers;
            document.getElementById("players").id = row.id + "-player";
            document.getElementById("time_").innerHTML = "Orario: " + row.time;
            document.getElementById("time_").id = row.id + "-time";

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
            document.getElementById("datetime").innerHTML = row.datetime;
            document.getElementById("datetime").id = row.id + "-datetime";
            document.getElementById("description").innerHTML = row.description;
            document.getElementById("description").id = row.id + "-description";
            document.getElementById("user").innerHTML = row.iduser;
            document.getElementById("user").id = row.id + "-user";
            document.getElementById("price").innerHTML = "Prezzo: " + row.price + "€";
            document.getElementById("price").id = row.id + "-price";
            if(row.image == null) {
                document.getElementById("image").remove();
            } else {
                document.getElementById("image").innerHTML = row.image;
            }
            document.getElementById("image").id = row.id + "-image";

        })
    }
}