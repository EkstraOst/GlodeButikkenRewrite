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

    
?>
