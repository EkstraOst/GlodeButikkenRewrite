

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //Gjør sikkert søk etter produkt
    $query = "SELECT * from fullprodukt_view WHERE produktID = ?";
    $stmt = mysqli_prepare($con, $query);
    $prodID = $_SESSION['id'];
    mysqli_stmt_bind_param($stmt, "d", $prodID);
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    //produktdata
    $p = mysqli_fetch_assoc($result);

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

                //NIVAA: index.php?nivaa=4?page=4?pid=x

            }
            fclose($handle);
        }
    }