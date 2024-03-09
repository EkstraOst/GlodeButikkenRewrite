

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PRODUKTREGISTRERING</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <style>
            .fjalla-one-regular {
                font-family: "Fjalla One", sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            .formwrap {
                margin: 50px;
                width: 550px;
                max-width: 550px;
                margin:auto;
            }
        </style>

    <script type="module" src="Assets/js/fakeinput.js" defer></script>


    </head>
    <body>
    <?php

//DEBUG
error_reporting(E_ALL);
ini_set('display_errors', '1');

//GLOBAL VARS
$BILDE_PLACEHOLDER = "Assets/img/placeholder_image.jpg";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //print_r($_POST);

    $con = new mysqli("localhost","root","","Temp");

    //hvis feil - exit
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO PRODUKT(inventar, navn, undertittel, info, kategoriID, pris, bilde, autosalg)  
                            VALUES (0, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddsd", $navn, $ut, $info, $kat, $pris, $fil, $asalg);

    $navn = $_POST['pnavn'];
    $ut = $_POST['putittel'];
    $info = $_POST['pinfo'];
    $pris = $_POST['ppris'];
    $kat = $_POST['pkat'];
    $fil = "";
    if (isset($_FILES['bilde']['tmp_name'])) {
        $fil = file_get_contents($_FILES['pbilde']['tmp_name']);
    } else {
        $fil = file_get_contents($BILDE_PLACEHOLDER);
    }
    $asalg = 1;
    if (isset($_POST['autosalg']) && $_POST['autosalg'] == "0") {
        $asalg = 0;
    }

    if (!(strlen($navn) < 4 || $pris <= 0)) {
        if ($stmt->execute()) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo '    <strong>Suksess!</strong>';
            echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '    <span aria-hidden="true">&times;</span>';
            echo '   </button>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '    <strong>Det oppsto en feil.</strong>';
            echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '    <span aria-hidden="true">&times;</span>';
            echo '   </button>';
            echo '</div>';
        }
    }
}

?>
<br>
<br>

    <div class="formwrap">
        <div id="tittel"><h3>Produktregistrering</h3></div><br><br>
        <form enctype="multipart/form-data" action="produktregistrering.php" method="POST">

            <!-- FELT: navn -> pnavn -->
            <div class="form-group"><label for="pnavn">Produktnavn:</label><input id="pnavn" name="pnavn" class="form-control" type="text"></div>
            
            <br>
            <!-- FELT: undertittel -> putittel -->
            <div class="form-group"><label for="putittel">Undertittel:</label><input id="putittel" name="putittel" class="form-control" type="text"></div>
            
            <br>
            <!-- FELT: pris -> ppris -->
            <div class="form-group"><label for="ppris">Pris:</label><input id="ppris" name="ppris" class="form-control" type="number"></div>
            
            <br>
            <!-- FELT: kategori -> pkat : genererer en liste av alle kategorier i en meny -->
            <div class="form-group">
                <label for="pkat">Kategori:</label>
                <select id="pkat" name="pkat" class="form-control">
                    <?php
                        //koble til og gjør klar søk
                        $con = mysqli_connect("localhost","root","","Temp");
                        if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }
                        $query = "SELECT * FROM KATEGORI";
                        
                        //finn alle kategorier og gjør de om til valg i meny
                        if ($result = mysqli_query($con, $query)) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=" . $row['kategoriID'] . ">" . $row['navn'] . "</option>";
                            }
                            mysqli_free_result($result);
                        }

                    ?>
                </select>
            </div>
            
            <br>
            <!-- FELT: info -> pinfo -->
            <div class="form-group"><label for="pinfo">Info (bruk gjerne html så det ser bra ut):</label><input id="pinfo" name="pinfo" class="form-control" type="textarea" rows="5"></div>
            
            <br>
            <!-- FELT: bilde -> pbilde -->
            <div class="form-group">
                <label for="pbilde">Produktbilde:</label>
                <input type="file" class="form-control-file" name="pbilde" id="pbilde">
            </div>
            
            <br>
            <!-- FELT: autosalg -> autosalg -->
            <div class="form-check">
                <input class="form-check-input" name="autosalg" type="checkbox" value="0" id="autosalg">
                <label class="form-check-label" for="autosalg">
                    Ta kontakt for salg!
                </label>
            </div>
            
            <br>
            <br>
            <button type="submit" class="btn btn-primary mb-2">Legg til</button>
            <br>
            <button type="button" class="btn btn-outline-info mb-2 btn-sm" id="rngesus" name="Flippert McKvakk">Random</button>
        
        </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html> 