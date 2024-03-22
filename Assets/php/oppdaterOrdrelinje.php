<?php

if (isset($_POST['par2'])) $_SESSION['par2'] = $_POST['par2'];
if (isset($_POST['par3'])) $_SESSION['par3'] = $_POST['par3'];
if ($type == 1 && isset($_SESSION['par2']) && isset($_SESSION['par3']) && $_SESSION['par2'] != $_SESSION['par3']) { //type == 1; oppdater vogn.
    $nytt_antall = $_SESSION['par3'];
    $gammelt_antall = $_SESSION['par2'];
    $pid = $_SESSION['para'];
    $diff = abs($gammelt_antall - $nytt_antall);
    if ($gammelt_antall > $nytt_antall) {
        //reduser med $gammelt_antall-$nytt_antall
        $query = "DELETE FROM VOGN_ITEM WHERE kundeID = ? LIMIT " . ($gammelt_antall-$nytt_antall);
        $stmt = $con->prepare($query);
        $stmt->bind_param("d", $uid);
        $stmt->execute();
    } else {
        //øk med $gammelt_antall-$nytt_antal
        for ($i = 0; $i < $diff; $i++) {
            $query = "INSERT INTO VOGN_ITEM (kundeID, produktID, dato) VALUES (?, ?, DATE(NOW()))";
            $stmt = $con->prepare($query);
            $stmt->bind_param("dd", $uid, $pid);
            $stmt->execute();
        }
    }
}