import { faker } from "https://esm.sh/@faker-js/faker";

function fyllSkjemaMedTull() {
    let inputNavn = document.getElementById("pnavn");
    let inputUndertittel = document.getElementById("putittel");
    let inputInfo = document.getElementById("pinfo");
    let inputPris = document.getElementById("ppris");
    let inputAutosalg = document.getElementById("autosalg")
    inputNavn.value = faker.commerce.productAdjective() + " " + faker.commerce.product() ;
    inputUndertittel.value = faker.commerce.productAdjective() + ". " + faker.commerce.productAdjective() + ". " + faker.commerce.productAdjective();
    inputInfo.value = faker.lorem.paragraphs({ min: 1, max: 4 }, '<br>\n');
    inputPris.value = (Math.floor(Math.random() * 20) * 10) + 99;
    inputAutosalg.value = Math.floor(Math.random() * 2);

    var select = document.getElementById('pkat');
    var items = select.getElementsByTagName('option');
    select.selectedIndex = Math.floor(Math.random() * items.length);

    document.getElementById("autosalg").checked = Math.random() < 0.8 ? true : false;
}
fyllSkjemaMedTull();

window.addEventListener("load",function() {
    document.getElementById("rngesus").addEventListener("click",fyllSkjemaMedTull);
});