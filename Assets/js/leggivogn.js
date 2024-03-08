function leggIVogn(produktid) {
    var xhttp; 
    if (str == "") {
        document.getElementById("badge").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("badge").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ajax_leggivogn.php?q="+produktid, true);
    xhttp.send();
}
