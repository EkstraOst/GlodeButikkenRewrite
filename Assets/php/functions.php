<?php
function nyBruker($con) {
    $query = "INSERT INTO KUNDE (sist_sett) VALUES (NOW())";
    if (mysqli_query($con, $query)) {
        $_SESSION['id'] = mysqli_insert_id($con);
    } else {
        echo "Noe gikk forferdelig galt. RIP in pieces";
        exit();
    }
}

function oppdaterBruker($con) { //TODO: bytt til mysqli-bind-param
    //oppdater sist-sett
    $query = "UPDATE KUNDE SET sist_sett = NOW() WHERE kundeID = " . $_SESSION['id'];
    mysqli_query($con, $query);
}


function giBrukerId($con) {
    if (!isset($_SESSION['id'])) { //ingen spor av bruker i nettleser
        nyBruker($con);
    } else { //Spor etter bruker - sjekk om tilsvarende bruker er i databasen
        $query = "SELECT * FROM KUNDE WHERE kundeID = " . $_SESSION['id'];
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 0) { //ingen bruker i db
            nyBruker($con);
        } else { //bruker i db.
            oppdaterBruker($con);
        }
    }
}


function antallVogn($con) {
    $stmt = mysqli_prepare($con, "SELECT COUNT(*) AS antall FROM VOGN_ITEM WHERE kundeID = ?");
    mysqli_stmt_bind_param($stmt, "d", $uid);
    mysqli_stmt_execute($stmt);
    $_SESSION['vogntall'] = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['antall'];
}
