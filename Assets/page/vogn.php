<?php

function printVognLinje($name, $subline, $price, $num) {
    $handle = fopen("Assets/templates/vogn_item.html", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $test = str_replace('%%navn%%', $name, $line);
            $test = str_replace('%%undertittel%%', $subline, $test);
            $test = str_replace('%%pris%%', $price, $test);
            $test = str_replace('%%antall%%', $num, $test);
            echo $test; 
        }
        fclose($handle);
    }
};

// QUERY 1: FINN PRODUKT OG ANTALL I VOGN
$query = "select produktID, count(*) as antall from VOGN_ITEM where kundeID = " . $_SESSION['id'] . " group by produktID";
//
echo "<table><tr>
        <th>Produkt</th>
        <th>Antall</th>
        <th>Pris</th>
        <th>Sum</th>";
if ($result = mysqli_query($con, $query)) {
    echo "<tr>";
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<th>";
        //FOR HVERT PRODUKT I LISTEN;
        $subtotal = 0;
        $subquery = "SELECT 
                PRODUKT.produktID,
                PRODUKT.navn, 
                PRODUKT.undertittel, 
                PRODUKT.info, 
                PRODUKT.inventar, 
                KATEGORI.navn as kategori, 
                PRODUKT.autosalg,
                PRODUKT.pris,
                IFNULL(min(RABATT.nypris), PRODUKT.pris) as sluttpris 
            FROM 
                PRODUKT
            INNER JOIN 
                RABATT 
            ON 
                PRODUKT.produktID = RABATT.produktID
            INNER JOIN 
                KAMPANJE 
            ON 
                KAMPANJE.kampanjeID = RABATT.kampanjeID
            INNER JOIN 
                KATEGORI 
            ON 
                KATEGORI.kategoriID = PRODUKT.kategoriID
            WHERE 
                PRODUKT.produktID = 1
            AND 
                NOW() >= KAMPANJE.startdato
            AND 
                NOW() < KAMPANJE.sluttdato";


        if ($subresult = mysqli_query($con, $subquery)) {
            $subrow = mysqli_fetch_assoc($subresult);
            $subtotal = $row['antall'] * $subrow['sluttpris'];
            $total += $subtotal;
            $navn = $subrow['navn'];
            $undertittel = $subrow['undertittel'];
            $info = $subrow['info'];
            $sluttpris = $subrow['sluttpris'];
            $inventar = $subrow['inventar'];
            $autosalg = $subrow['autosalg'];
            $kategori = $subrow['kategori'];

            echo "<tr>" . $navn . "</tr>";
            echo "<tr>" . $antall . "</tr>";
            echo "<tr>" . $pris . "</tr>";
            echo "<tr>" . $subtotal . "</tr>";
        }
        echo "</th>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<div class='totalsum'>" . $total . "</div>";
    mysqli_free_result($result);
}

/*
//Finn distinkte produkter i vogn.
distinct: SELECT DISTINCT produktID FROM vogn_item WHERE kundeID = $_SESSION['kid']; //HVILKE PRODUKTER ER I VOGNEN
//For hvert distinkte produkt; Finn antall.

for every distinct produktID FROM vogn_item WHERE kundeID = $_SESSION['kid'] {
    
}
//Loop over dinstinkte produkter; Skriv varelinje og sett inn bestilt antall i html-felt.
*/