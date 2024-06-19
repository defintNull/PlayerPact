$(document).ready(function() {
    var ugly = document.getElementById('sql-result').value;
    if(ugly != ""){
        var obj = JSON.parse(ugly);
        var pretty = JSON.stringify(obj, undefined, 4);
        document.getElementById('sql-result').value = pretty;
    }
});