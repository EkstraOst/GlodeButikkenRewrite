<!-- HMTL FØR ORDRESKJEMA -->




<?php
//SKRIV ORDRESKJEMA

//TODO: SKAL ORDRELINJEN OPPDATERES? I så fall er $_GET TINGEN

$query = "SELECT p.produktID as id, p.navn, p.undertittel, p.info, p.bilde, p.inventar, p.autosalg, IFNULL(MIN(r.nypris), p.pris) as pris, t.antall, 
IF(MIN(r.nypris) < p.pris, 1, 0) AS on_sale, (pris * antall) AS totalpris FROM PRODUKT p
LEFT JOIN RABATT r ON r.produktID = p.produktID
LEFT JOIN (SELECT * FROM KAMPANJE WHERE NOW() < KAMPANJE.sluttdato AND NOW() >= KAMPANJE.startdato) k ON k.kampanjeID = r.kampanjeID
INNER JOIN VOGN_ITEM v ON v.produktID = p.produktID
INNER JOIN (SELECT VOGN_ITEM.produktID, COUNT(*) AS antall FROM VOGN_ITEM WHERE IFNULL(VOGN_ITEM.solgt, 0) != 1  GROUP BY VOGN_ITEM.produktID) t ON t.produktID = v.produktID
WHERE p.autosalg = 1
AND v.kundeID = ?
GROUP BY p.produktID;";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $kid);
$kid = $uid;
$kid = 2;
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

echo "<div class='ordreskjema'>";
print_r($result);
while ($p = mysqli_fetch_assoc($result)) {
    printVognLinje($p['navn'], $p['undertittel'], $p['pris'], $p['id'], $p['antall'], $p['totalpris'], $p['on_sale']);
}
echo "</div>";

function printVognLinje($name, $ut, $price, $id, $num, $total, $sale) {
    $handle = fopen("Assets/templates/vogn_item.html", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $test = str_replace('%%navn%%', $name, $line);
            $test = str_replace('%%undertittel%%', $ut, $test);
            $test = str_replace('%%pris%%', $price, $test);
            $test = str_replace('%%antall%%', $num, $test);
            $test = str_replace('%%total%%', $total, $test);
            echo $test; 
        }
        fclose($handle);
    }
}
?>
<!-- HMTL ETTER ORDRESKJEMA -->








<!-- SLUTT -->