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
    $con = new mysqli("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
    
    //hvis feil - exit
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }
    
    $stmt = $con->prepare("INSERT INTO PRODUKT(inventar, navn, undertittel, info, kategoriID, pris, bilde, autosalg)  
    VALUES (0, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddsd", $navn, $ut, $info, $kat, $pris, $fil, $asalg);
    
    $id = "";
    $navn = $_POST['prnavn'];
    $ut = $_POST['prut'];
    $info = $_POST['prinfo'];
    $pris = $_POST['prpris'];
    $kat = $_POST['prkat'];
    $fil = "default_product_img.png";
    $asalg = 1;
    if (isset($_POST['autosalg']) && $_POST['autosalg'] == "0") {
        $asalg = 0;
    }

    $return_error = 0;
    $err_info = "";
    if (strlen($navn) >= 4 && $pris > 0) {
        if ($stmt->execute()) {
            $id = $con->insert_id;
            //$upload_dir = "../Assets/img/"; //Bruk denne når den ligger i Admin-mappen
            $upload_dir = "Assets/img/"; //Bruk denne når den ligger med butikkfilene.
            //$upload_dir = ""; //testing
            if ($_FILES['pbilde']['error'] == UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['pbilde']['name'])['extension']; // get the extension of the file
                if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
                    $fil = "ProduktBilde_id" . $id . "." . $ext;
                    move_uploaded_file( $_FILES['pbilde']['tmp_name'], $fil);
                } else {
                    //feil filtype
                    $return_error = 2;
                    $err_info = "Ingen passende fil lastet opp. Godtar jpg/png.";
                }
            } else {
                //ingen fil lastet opp
                $return_error = 1;
                $err_info = "Ingen fil lastet opp.";
            }

            $stmt = $con->prepare("UPDATE PRODUKT SET bilde = ? WHERE produktID = ?");
            $stmt->bind_param("sd", $fil, $id);
            if (!$stmt->execute()) {
                $return_error = 3;
                $err_info = "Noe galt skjedde under databaseoppdatering.";
            }
        }
    } else {
        $return_error = 4;
        $err_info = "Sjekk at navn er lengre enn 4 bokstaver og at pris er over 0,-";
    }

    if ($return_error == 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '    <strong>Hipp hurra! Alt gikk bra. For en dag!</strong>';
        echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '    <span aria-hidden="true">&times;</span>';
        echo '   </button>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '    <strong>' . $err_info . ' (Gløde Spesialfeil no' . $return_error .  ')</strong>';
        echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '    <span aria-hidden="true">&times;</span>';
        echo '   </button>';
        echo '</div>';
    }
}

?>
<br>
<br>

<div class="formwrap" style="max-width: 700px; width: 700px; margin: auto;>
<div id="tittel"><h3>Produktregistrering</h3></div><br><br>
<form enctype="multipart/form-data" action="produktregistrering.php" method="POST">

<!-- FELT: navn -> prnavn -->
<div class="form-group"><label for="prnavn">Produktnavn:</label><input id="prnavn" name="prnavn" class="form-control" type="text"></div>

<br>
<!-- FELT: undertittel -> prut -->
<div class="form-group"><label for="prut">Undertittel:</label><input id="prut" name="prut" class="form-control" type="text"></div>

<br>
<!-- FELT: pris -> prpris -->
<div class="form-group"><label for="prpris">Pris:</label><input id="prpris" name="prpris" class="form-control" type="number"></div>

<br>
<!-- FELT: kategori -> prkat : genererer en liste av alle kategorier i en meny -->
<div class="form-group">
<label for="prkat">Kategori:</label>
<select id="prkat" name="prkat" class="form-control">
<?php
//koble til og gjør klar søk
$con = mysqli_connect("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
$query = "SELECT * FROM KATEGORI";
echo "OLE";
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
<!-- FELT: info -> prinfo -->
<div class="form-group"><label for="prinfo">Info (bruk gjerne html så det ser bra ut):</label><input id="prinfo" name="prinfo" class="form-control" type="textarea" rows="5"></div>

<br>
<!-- FELT: bilde -> pbilde -->
<div class="form-group">
<label for="pbilde">Produktbilde:</label>
<input type="file" accept="image/x-png,image/jpeg,image/png" class="form-control-file" name="pbilde" id="pbilde">
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
<button type="button" class="btn btn-outline-info mb-2 btn-sm" id="rngesus" name="Flippert McKvakk">Randomize</button>

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html> 