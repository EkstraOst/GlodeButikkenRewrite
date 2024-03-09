function leggIVogn(produktid) {
    var xhttp; 
    if (produktid == "") {
        document.getElementById("badge").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("badge").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Assets/php/ajax_leggivogn.php?pid=" + produktid, true);
    xhttp.send();
    alert(this.responseText);

}
