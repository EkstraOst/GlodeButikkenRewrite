<?php
    $overskrift = "Søk etter produkter:";
    if ($_GET['type'] == '1') {
        //Menysøk etter kategori
        $overskrift = $_GET['param'] . ":";
    } else if ($_GET['type'] == '2') {
        //Fritekstsøk
        $overskrift = "Produkter som inneholder '" . $_GET['param'] . "':";
    }

    echo "<div class='search-headline'>";
    echo $overskrift;
    echo "</div>";
?>

<!-- Searchbar settes inn her som html-->




<!-- Her kommer resultatene -->
<?php
    //validate variables
    $type = 0;
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    }
    $query = "";
    //søkeparametre
    $param = 0;
    if (isset($_GET['param'])) {
        $param = $_GET['param'];
    }

    //type
    if ($type == 0) {
        $query = "SELECT * FROM PRODUKT";
    }
    if ($type == 1) {
        $query = "SELECT * FROM PRODUKT WHERE kategori='" . $param . "'";
    }
    if ($type == 2) {
        $query = "SELECT * FROM PRODUKT WHERE navn REGEXP_LIKE (" . $param . ") UNION SELECT * FROM PRODUKT WHERE info REGEXP_LIKE (". $param . ")";
    }

    //koble til mysql-database
    $con = mysqli_connect("localhost","root","","Temp");

    //hvis feil - exit
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
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
                $test = str_replace('%%pris%%', $price, $test);
                echo $test;
            }
            fclose($handle);
        }
    }
?>
<!-- slutt på php/database -->
