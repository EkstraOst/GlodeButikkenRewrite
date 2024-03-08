

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //validate variables


    $query = "SELECT PRODUKT.produktID, PRODUKT.inventar, PRODUKT.navn, PRODUKT.undertittel, PRODUKT.info, PRODUKT.pris, KATEGORI.navn as kategori, PRODUKT.bilde, PRODUKT.autosalg FROM PRODUKT
              INNER JOIN KATEGORI ON KATEGORI.kategoriID = PRODUKT.kategoriID
              WHERE PRODUKT.produktID = " . $_SESSION['param'];
    //type
    //utfør "query" av database og vis hver av resultatene gjennom printCard-funksjonen
    //i dette tilfellet alle produktene i mockup-databasen (4stk).
    if ($result = mysqli_query($con, $query)) {
        while($row = mysqli_fetch_assoc($result)) {
            printFullProduct($row['produktID'], $row['navn'], $row['undertittel'], $row['info'], $row['kategori'], $row['pris'], $row['autosalg'], $row['inventar']);
        }

        mysqli_free_result($result);
    }

    //avslutt databaseforbindelsen
    mysqli_close($con);

    //enkel "template-funksjon" konsept
    function printFullProduct($id, $navn, $ut, $info, $kat, $pris, $autosalg, $inv) {
        $handle = fopen("Assets/templates/produktFull.html", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $test = str_replace('%%navn%%', $navn, $line);
                $test = str_replace('%%undertittel%%', $ut, $test);
                $test = str_replace('%%info%%', $info, $test);
                $test = str_replace('%%produktID%%', $id, $test);
                $test = str_replace('%%kategori%%', $kat, $test);
                $test = str_replace('%%pris%%', $pris, $test);
                $test = str_replace('%%autosalg%%', $autosalg, $test);
                echo $test;

                //NIVAA: index.php?nivaa=4?page=4?pid=x

            }
            fclose($handle);
        }
    }