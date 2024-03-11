<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $con = new mysqli("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    //Legg til produktet i vogn
    $stmt = $con->prepare("INSERT INTO VOGN_ITEM (kundeID, produktID, dato) VALUES (?, ?, NOW())");
    $stmt->bind_param("dd", $kid, $pid);
    $kid = $_SESSION['id'];
    $pid = $_GET['produktid'];
    $stmt->execute();

    echo "OLEGUNNAR1";

    //finn antall produkter i vogn og skriv ut
    $stmt2 = $con->prepare("SELECT COUNT(*) FROM VOGN_ITEM WHERE kundeID = " . $kid);
    $stmt2->execute();
    $stmt2->bind_result($antall);
    $stmt2->fetch();

    echo "OLEGUNNAR2"; 

    echo $antall; //Dette tallet er svaret js/ajax får tilbake. Et tall som legges i badge.
}