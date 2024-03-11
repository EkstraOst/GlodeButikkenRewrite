<?php
function getBilde($con, $pid) {
    $stmt = $con->prepare("SELECT bilde from PRODUKT WHERE produktID = ?");
    $stmt->bind_param("b", $pid);
    $stmt->execute();
    $res = $stmt->get_result();
    //TODO: gå over til å lagre bilder i Assets og beholde kun filnavn i databasen.
    //Du vet... så tar det ikke 1 min å laste en side med produktbilder
    echo $res['bilde'];

}
