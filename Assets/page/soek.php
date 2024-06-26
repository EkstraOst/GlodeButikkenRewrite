<body>
<?php
if ($type == 0) { //SØK ETTER ALLE PRODUKTER
    $query = "SELECT * FROM produkt_view";
    $stmt = mysqli_prepare($con, $query);

} else if ($type == 1) { //SØK ETTER SUPERKATEGORI/OVERKATEGORI (ex. PC er OVERKATEGORI til Laptop og Stasjonær som er KATEGORI)
    $query =   "SELECT * FROM produkt_view p 
    INNER JOIN KATEGORI k ON k.kategoriID = p.kategoriID 
    INNER JOIN SUPERKATEGORI s ON s.s_kategoriID = k.s_kategoriID
    WHERE s.s_kategoriID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "d", $superkat);
    $superkat = $para;

} else if ($type == 2) { //SØK ETTER KATEGORI
    $query = "SELECT * FROM produkt_view p WHERE p.kategoriID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "d", $kat);
    $kat = $para;

} else if ($type == 3) { //SØK ETTER TEKST (i navn, undertittel og info)
    $query =   'select * from produkt_view where produktID IN (SELECT produktID from PRODUKT where navn regexp ? OR undertittel regexp ? OR info regexp ?)';
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sss", $tekst, $tekst, $tekst);
    $tekst = $para;
    $tekst = $para;
    $tekst = $para;
}




//Gjennomfør søket og skriv ut template for hvert resultat
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($p = mysqli_fetch_assoc($result)) {
    printCard($p['on_sale'],$p['produktNavn'], $p['undertittel'], $p['pris'], $p['produktID'], $p['bilde'], $p['inventar'], $p['autosalg']);
}
?>