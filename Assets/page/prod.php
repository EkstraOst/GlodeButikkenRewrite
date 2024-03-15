<?php
//Gjør sikkert søk etter produkt i $para (se index.php under SIDE-INNSTILLINGER)
$query = "SELECT * FROM fullprodukt_view WHERE produktID = ?";
$stmt = mysqli_prepare($con, $query);
$prodID = $para;
mysqli_stmt_bind_param($stmt, "d", $prodID);
mysqli_stmt_execute($stmt);
$p = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

//gjør svarene litt mer håndterlige
$id = $p['produktID'];
$navn = $p['navn'];
$undertittel = $p['undertittel'];
$info = $p['info'];
$kategori = $p['kategori'];
$autosalg = $p['autosalg'];
$inventar = $p['inventar'];
$salg = $p['on_sale'];
$bilde = $p['bilde'];
$pris = $p['pris'];

//skriv ut siden med riktige verdier satt inn
printFullProduct($id, $navn, $undertittel, $info, $bilde, $kategori, $pris, $autosalg, $inventar);