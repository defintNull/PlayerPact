$(document).ready(function(){
    //var e = document.getElementById("postChoice");
    $('#postChoice').on('click', 'a.dropdown-item', function(){
        var choice = $(this).text();
        document.getElementById("dropdown").innerHTML = choice;
    });
    
    //$('#createPostPage').append();
});
