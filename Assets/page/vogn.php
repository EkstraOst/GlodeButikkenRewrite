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

$pcount = [];
// QUERY 1: FINN

//DEBUG:
$_COOKIE['id'] = 1;
//end DEBUG

$query = "select produktID, count(*) as antall from VOGN_ITEM where kundeID = " . $_COOKIE['id'] . " group by produktID";
//
$total = 0;
if ($result = mysqli_query($con, $query)) {
    echo "<ul id='vognliste'>";
    while ($row = mysqli_fetch_assoc($result)) {
        //FOR HVERT PRODUKT I LISTEN;
        $subtotal = 0;
        $subquery = "select * from PRODUKT where produktID = " . $row['produktID'];
        if ($subresult = mysqli_query($con, $subquery)) {
            $subrow = mysqli_fetch_assoc($subresult);

            //Sjekk for rabatt
            $ny_pris = $subrow['pris'];
            $merk_salg = false;
            $prisquery = "select * from KAMPANJE k where NOW() > startdato AND NOW() <= sluttdato AND EXISTS (select r.nypris from RABATT r where (r.kampanjeID = k.kampanjeID AND r.produktID = 1))";
            if ($prisresult = mysqli_query($con, $prisquery)) {
                while ($prisrow = mysqli_fetch_assoc($prisresult)) {
                    if ($ny_pris > $prisrow['nypris']) {
                        $ny_pris = $prisrow['nypris'];
                        $merk_salg = true;
                    }
                }

            }
            $subtotal = $row['antall'] * $ny_pris;

            $total += $subtotal;
        }
        echo "</ul>";
        echo "<div class='totalsum'>" . $total . "</div>";
    }
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