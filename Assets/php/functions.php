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



function printCard($name, $subline, $price, $id, $bilde, $inv) {
    $handle = fopen("Assets/templates/productcard.html", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $test = str_replace('%%navn%%', $name, $line);
            $test = str_replace('%%undertittel%%', $subline, $test);
            $test = str_replace('%%pris%%', $price, $test);
            $test = str_replace('%%id%%', $id, $test);
            $test = str_replace('%%bilde%%', $bilde, $test);
            $test = str_replace('%%inv%%', $inv, $test);
            //$test = str_replace('%%bilde%%', $bilde, getBilde($id));
            echo $test;

            //NIVAA: index.php?nivaa=4?page=4?pid=x
        }
        fclose($handle);
    }
}

function printFullProduct($id, $navn, $ut, $info, $bilde, $kat, $pris, $autosalg, $inv) {
    $handle = fopen("Assets/templates/produktFull.html", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $test = str_replace('%%navn%%', $navn, $line);
            $test = str_replace('%%undertittel%%', $ut, $test);
            $test = str_replace('%%info%%', $info, $test);
            $test = str_replace('%%produktID%%', $id, $test);
            $test = str_replace('%%kategori%%', $kat, $test);
            $test = str_replace('%%bilde%%', $bilde, $test);
            $test = str_replace('%%pris%%', $pris, $test);
            $test = str_replace('%%autosalg%%', $autosalg, $test);
            $test = str_replace('%%id%%', $id, $test);
            if ($autosalg == '1') {
                $test = str_replace('glode-ikkesalgbar', 'glode-salgbar', $test);
            } else {
                $test = str_replace('glode-salgbar', 'glode-ikkesalgbar', $test);
            }
            echo $test;
        }
        fclose($handle);
    }
}



function printVognLinje($name, $ut, $price, $id, $num, $total, $sale, $bilde) {
    //Åpne opp fil
    $handle = fopen("Assets/templates/vogn_item.html", "r");

    //Hvis fil åpnet ok; linje for linje les filen og bytt ut kodeord med variablene i funksjonskallet ($name, $ut....)
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $test = str_replace('%%navn%%', $name, $line);
            $test = str_replace('%%undertittel%%', $ut, $test);
            $test = str_replace('%%pris%%', $price, $test);
            $test = str_replace('%%antall%%', $num, $test);
            $test = str_replace('%%totalpris%%', $total, $test);
            $test = str_replace('%%id%%', $id, $test);
            $test = str_replace('%%bilde%%', $bilde, $test);
            echo $test; //skriv ut linjen til websiden som skal leveres
        }
        fclose($handle);
    }
}