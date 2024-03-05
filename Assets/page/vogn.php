<?php
//koble til mysql-database
$con = mysqli_connect("localhost","root","","Temp");

//hvis feil - exit
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
$pcount = [];
// QUERY 1: FINN
$query = "SELECT * FROM vogn_item WHERE kundeID = " . $_SESSION['id'];
//
if ($result = mysqli_query($con, $query)) {
    while($row = mysqli_fetch_assoc($result)) {
        //FOR HVERT PRODUKT I LISTEN; FINN ANTALLET
        $produkt = $row['produktID'] . "";
        if (isset($pcount[$produkt])) {
            $pcount[$produkt]++;
        } else {
            $pcount[$produkt] = 1;
        }
    }
    mysqli_free_result($result);
}
    //SKRIV UT HTML FOR HVERT ELEMENT-PAR I LISTEN. BRUK produktID TIL Å HENTE RESTEN AV PRODUKTINFO
foreach ($pcount as $key => $value) {
    $pquery = "SELECT * FROM PRODUKT WHERE produktID = " . $key;
    if ($p_res = mysqli_query($con, $pquery)) {
        while($p_row = mysqli_fetch_assoc($p_res)) {
            
        }
    }
    
    $count = $value;
    $pid = $key;


    
}

/*
//Finn distinkte produkter i vogn.
distinct: SELECT DISTINCT produktID FROM vogn_item WHERE kundeID = $_SESSION['kid']; //HVILKE PRODUKTER ER I VOGNEN
//For hvert distinkte produkt; Finn antall.

for every distinct produktID FROM vogn_item WHERE kundeID = $_SESSION['kid'] {
    
}
//Loop over dinstinkte produkter; Skriv varelinje og sett inn bestilt antall i html-felt.
*/