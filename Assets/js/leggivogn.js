//Legger 1 stk produkt i handlevogn.
//etterpå skriver den ut antall produkter totalt

const collection = document.getElementsByClassName("leggivogn");
for (const btn of collection) {
    btn.onclick = function() {leggivogn(btn.value)};
}

function leggivogn(produktid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("badge").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Assets/php/ajax_leggivogn.php?pid=" + produktid, true);
    xhttp.send();
    alert(this.responseText, produktid);
}
