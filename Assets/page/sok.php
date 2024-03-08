

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //validate variables
    $type = 0;
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    }
    
    //søkeparametre
    $param = 0;
    if (isset($_GET['param'])) {
        $param = $_GET['param'];
    }
    $query = "";
    echo $type . " " . $param;
    //type
    if ($type == 0) {
        $query = "SELECT * FROM PRODUKT";
    }
    if ($type == 1) {
        $query = "SELECT * FROM PRODUKT p WHERE EXISTS (SELECT * FROM KATEGORI s WHERE s.s_kategoriID = " . $param . " AND p.kategoriID = s.kategoriID)" ;
    }
    if ($type == 2) {
        $query = "SELECT * FROM PRODUKT WHERE kategoriID ='" . $param . "'";
    }
    if ($type == 3) {
        $query = "SELECT * FROM PRODUKT WHERE navn REGEXP_LIKE (" . $param . ") UNION SELECT * FROM PRODUKT WHERE info REGEXP_LIKE (". $param . ")";
    }

    //utfør "query" av database og vis hver av resultatene gjennom printCard-funksjonen
    //i dette tilfellet alle produktene i mockup-databasen (4stk).
    if ($result = mysqli_query($con, $query)) {
        while($row = mysqli_fetch_assoc($result)) {
            printCard($row['navn'], $row['undertittel'], $row['pris']);
        }

        mysqli_free_result($result);
    }

    //avslutt databaseforbindelsen
    mysqli_close($con);

    //enkel "template-funksjon" konsept
    function printCard($name, $subline, $price) {
        $handle = fopen("Assets/templates/productcard.html", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $test = str_replace('%%navn%%', $name, $line);
                $test = str_replace('%%undertittel%%', $subline, $test);
                $test = str_replace('%%info%%', $price, $test);
                $test = str_replace('%%produktID%%', $price, $test);
                $test = str_replace('%%pris%%', $price, $test);
                $test = str_replace('%%pris%%', $price, $test);
                $test = str_replace('%%pris%%', $price, $test);
                echo $test;

                //NIVAA: index.php?nivaa=4?page=4?pid=x

            }
            fclose($handle);
        }
    }
?>
<!-- slutt på php/database -->
