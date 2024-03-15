<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $con = new mysqli("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }
    
    //Legg til produktet i vogn
    $stmt = $con->prepare("INSERT INTO VOGN_ITEM (kundeID, produktID, dato) VALUES (?, ?, NOW())");
    $stmt->bind_param("dd", $kid, $pid);
    $kid = $_SESSION['id'];
    $pid = $_GET['pid'];
    try {
        $stmt->execute();
    } catch(error) {
        //Kunne ikke legge til produkt (ikke salgbart, eller evt feil et sted).
    }

    //finn antall produkter i vogn og skriv ut
    $kundeID = $kid;
    $stmt2 = $con->prepare("SELECT COUNT(*) FROM VOGN_ITEM WHERE kundeID = ?");
    $stmt2->bind_param("i", $kundeID);
    $stmt2->execute();
    $stmt2->bind_result($antall);
    $stmt2->fetch();

    //Lagre vogntall i $_SESSION plus send tallet som svar til ajax.
    $_SESSION['vogntall'] = $antall;
    echo $antall;
}