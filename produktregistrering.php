

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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="Assets/bootstrap5/css/bootstrap.css">
        <script src="Assets/bootstrap5/js/bootstrap.bundle.min.js"></script>

        <style>
            .fjalla-one-regular {
                font-family: "Fjalla One", sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            .formwrap {
                margin: 50px;
                width: 350px;
                max-width: 350px;
            }
        </style>


    </head>
    <body>
    <?php

//DEBUG
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = new mysqli("localhost","root","","Temp");

    //hvis feil - exit
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO PRODUKT(inventar, navn, undertittel, info, kategoriID, pris, bilde_url)  
                            VALUES (0, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdds", $navn, $ut, $info, $kat, $pris, $fil);

    $navn = $_POST['pnavn'];
    $ut = $_POST['putittel'];
    $info = $_POST['pinfo'];
    $pris = $_POST['ppris'];
    $kat = $_POST['pkat'];
    $fil = $_POST['pfil'];

    

    //utfør "query" av database og vis hver av resultatene gjennom printCard-funksjonen
    //i dette tilfellet alle produktene i mockup-databasen (4stk).
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

?>
<br>
<br>

    <div class="formwrap">
        <div id="tittel"><h3>Produktregistrering</h3></div><br><br>
        <form action="produktregistrering.php" method="POST">
            <div class="form-group"><label for="pnavn">Produktnavn:</label><input id="pnavn" name="pnavn" class="form-control" type="text"></div><br>
            <div class="form-group"><label for="putittel">Undertittel:</label><input id="putittel" name="putittel" class="form-control" type="text"></div><br>
            <div class="form-group"><label for="ppris">Pris:</label><input id="ppris" name="ppris" class="form-control" type="number"></div><br>
            <div class="form-group"><label for="pfil">Filnavn (legg i assets):</label><input id="pfil" name="pfil" class="form-control" type="text"></div><br>
            <div class="form-group">
                <label for="pkat">Kategori:</label>
                <select id="pkat" name="pkat" class="form-control">
                    <?php

                        //koble til mysql-database
                        $con = mysqli_connect("localhost","root","","Temp");

                        //hvis feil - exit
                        if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        $query = "SELECT * FROM KATEGORI";

                        //utfør "query" av database og vis hver av resultatene gjennom printCard-funksjonen
                        //i dette tilfellet alle produktene i mockup-databasen (4stk).
                        if ($result = mysqli_query($con, $query)) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=" . $row['kategoriID'] . ">" . $row['navn'] . "</option>";
                            }

                            mysqli_free_result($result);
                        }

                    ?>
                </select>
            </div><br>
            <div class="form-group"><label for="pinfo">Info (bruk gjerne html så det ser bra ut):</label><input id="pinfo" name="pinfo" class="form-control" type="textarea" rows=8></div>
            <br><br><button type="submit" class="btn btn-primary mb-2">Legg til</button>
        </form>
        </div>


    </body>
</html>