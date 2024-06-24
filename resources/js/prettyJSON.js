/**
 * Adjusts graphic for admin query
 *
 */
$(document).ready(function() {
    var ugly = document.getElementById('sql-result').value;
    if(ugly.length != 0 && ugly !== null && ugly.substring(0, 9) != "Exception"){
        var obj = JSON.parse(ugly);
        var pretty = JSON.stringify(obj, undefined, 4);
        document.getElementById('sql-result').value = pretty;
    }
});