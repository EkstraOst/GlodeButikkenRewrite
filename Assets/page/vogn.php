<!-- HMTL FØR ORDRESKJEMA -->
<main>
    <section class="customerPosition">
        <h2 class="positionText">Du er her: <a href="/index.html">Forside</a> <i class="positionArrow"></i>Handlekurv</h2>
    </section>
    <section class="shopItems">
        <div class="cartHeader">
            <h1 class="cartText">Handlekurv</h1>
        </div>
        <div class="shopItemsHeader">
            <div class="shopItemsHeaderWrapperLeft"></div>
            <div class="headerAmountDiv">
                <h3 class="amountText">Antall</h3>
            </div>
            <div class="headerPriceDiv">
            <h3 class="priceText">Pris</h3>
        </div>
        <div class="headerDeleteDiv">
            <h3 deleteText>Slett</h3>
        </div>
    </div>
    <div class="shopItemsDiv">

<?php
//SKRIV ORDRESKJEMA //TODO: SKAL ORDRELINJEN OPPDATERES? I så fall er $_GET TINGEN

//Databasesøket for handlevogn-info.
$query = "SELECT p.produktID as id, p.navn, p.undertittel, p.info, p.bilde, p.inventar, p.autosalg, IFNULL(MIN(r.nypris), p.pris) as pris, t.antall, 
IF(MIN(r.nypris) < p.pris, 1, 0) AS on_sale, (pris * antall) AS totalpris FROM PRODUKT p
LEFT JOIN RABATT r 
ON r.produktID = p.produktID
LEFT JOIN (SELECT * FROM KAMPANJE WHERE NOW() < KAMPANJE.sluttdato AND NOW() >= KAMPANJE.startdato) k 
ON k.kampanjeID = r.kampanjeID
INNER JOIN VOGN_ITEM v 
ON v.produktID = p.produktID
INNER JOIN (SELECT VOGN_ITEM.produktID, COUNT(*) AS antall FROM VOGN_ITEM WHERE IFNULL(VOGN_ITEM.solgt, 0) != 1 AND kundeID = ? GROUP BY VOGN_ITEM.produktID) t 
ON t.produktID = v.produktID
WHERE p.autosalg = 1
GROUP BY p.produktID;";

//sikre søket, klargjør og kjør
$stmt = mysqli_prepare($con, $query);
$kid = $uid;
mysqli_stmt_bind_param($stmt, "i", $kid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); //alle resultatene lander her i $result som en type array

$totalsum = 0;
while ($p = mysqli_fetch_assoc($result)) { //hent ett og ett resultat til det er tomt - skriv ut produktkort med resultatet som html
    printVognLinje($p['navn'], $p['undertittel'], $p['pris'], $p['id'], $p['antall'], $p['totalpris'], $p['on_sale'], $p['bilde']);
    $totalsum += $p['totalpris'];
}
?>

    <section class="buttonPay">
        <div class="buttonPayDiv">
            <div class="buttonPayThankYou">
                <h3>Takk for din Handel!</h3>
                <h3>Hilsen fra butikken Placeholder</h3>
                <a href="/Star/indexStar.html" class="buttonPayLink"> Ønsker du å gi oss en tilbakemelding?</a>
            </div>
            <div class="buttonPayPriceDiv">
                <h3 class="buttonPayPrice">Total pris: kr <?php echo $totalsum ?> ,-</h3>
            </div>
            <div class="buttonPayBtnDiv">
                <button class="buttonPayBtn">Gå videre til betaling</button>
            </div>
        </div>
    </section>
</main>