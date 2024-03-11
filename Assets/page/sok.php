

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //validate variables
    $type = $_SESSION['type'];
    $param = $_SESSION['param'];
    $query = "";
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
            printCard($row['navn'], $row['undertittel'], $row['pris'], $row['produktID'], $row['bilde']);
        }

        mysqli_free_result($result);
    }

    //avslutt databaseforbindelsen
    //enkel "template-funksjon" konsept
    function printCard($name, $subline, $price, $id, $bilde) {
        $handle = fopen("Assets/templates/productcard.html", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $test = str_replace('%%navn%%', $name, $line);
                $test = str_replace('%%undertittel%%', $subline, $test);
                $test = str_replace('%%pris%%', $price, $test);
                $test = str_replace('%%id%%', $id, $test);
                //$test = str_replace('%%bilde%%', $bilde, getBilde($id));
                echo $test;

                //NIVAA: index.php?nivaa=4?page=4?pid=x
            }
            fclose($handle);
        }
    }
?>
<!-- slutt på php/database -->
