

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //validate variables
    $type = $_SESSION['type'];
    $param = $_SESSION['param'];
    $query = "";
    $stmt = "";

    //Søketype

    //SØK ETTER ALLE PRODUKTER
    if ($type == 0) { 
        $query = "SELECT * FROM fullprodukt_view";
        $stmt = mysqli_prepare($con, $query);
    }

    //SØK ETTER SUPERKATEGORI/OVERKATEGORI (ex. PC er OVERKATEGORI til Laptop og Stasjonær som er KATEGORI)
    if ($type == 1) { 
        $query =   "SELECT * FROM fullprodukt_view p 
                    INNER JOIN KATEGORI k ON k.kategoriID = p.kategoriID 
                    INNER JOIN SUPERKATEGORI s ON s.s_kategoriID = k.s_kategoriID
                    WHERE s.s_kategoriID = ?";
        
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "d", $superkat);
        $superkat = $param;
    }

    //SØK ETTER KATEGORI
    if ($type == 2) { 
        $query = "SELECT * FROM fullprodukt_view p WHERE p.kategoriID = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "d", $kat);
        $kat = $param;
    }

    //SØK ETTER TEKST (i navn, undertittel og info)
    if ($type == 3) { 
        $query =   "SELECT * from fullprodukt_view f 
                    WHERE f.navn REGEXP ? OR f.undertittel REGEXP ? OR f.info REGEXP ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ddd", $tekst, $tekst2, $tekst3);
        $tekst = $param;
        $tekst2 = $param;
        $tekst3 = $param;
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    //produktdata
    while ($p = mysqli_fetch_assoc($result)) {
        printCard($p['navn'], $p['undertittel'], $p['pris'], $p['produktID'], $p['bilde'], $p['inventar']);
    }

    //gjør svarene litt mer håndterlige
    /*
    $id = $p['id'];
    $navn = $p['navn'];
    $undertittel = $p['undertittel'];
    $info = $p['info'];
    $kategori = $p['kategori'];
    $autosalg = $p['autosalg'];
    $inventar = $p['inventar'];
    $salg = $p['on_sale'];
    $bilde = $p['bilde'];
    $pris = $p['pris'];
    */

    //enkel "template-funksjon" konsept
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
?>
<!-- slutt på php/database -->
