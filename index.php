<?php 
//DEBUG
if (true) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
//VARIABLER
include("Assets/php/variables.php");

//FUNKSJONER
include("Assets/php/functions.php");


//Start session og koble til database
$con = mysqli_connect("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
if (mysqli_connect_errno()) {
    echo "Noe gikk galt: " . mysqli_connect_error(); //TODO: Skal vi skrive ut
    exit();
}
session_set_cookie_params(60*60*24*14, '/; samesite='. "lax", $_SERVER['HTTP_HOST'], true);
session_start();


giBrukerId($con);



//ordne verdier for navigering og søk
if (!isset($_SESSION['page'])) { $_SESSION['page'] = 1; }
if (!isset($_SESSION['type'])) { $_SESSION['type'] = 0; }
if (!isset($_SESSION['param'])) { $_SESSION['param'] = ".*"; }
$_SESSION['page'] =  isset($_GET['page']) ? $_GET['page'] : $_SESSION['page'];
$_SESSION['type'] =  isset($_GET['type']) ? $_GET['type'] : $_SESSION['type'];
$_SESSION['param'] = isset($_GET['param']) ? $_GET['param'] : $_SESSION['param'];

$side = $_SESSION['page'];
$type = $_SESSION['type'];
$param = $_SESSION['param'];
$uid = $_SESSION['id'];

//Finn antall varer i handlevogn
$query =   "SELECT COUNT(*) AS antall FROM VOGN_ITEM WHERE kundeID = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "d", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//produktdata
$p = mysqli_fetch_assoc($result);
$_SESSION['vogntall'] = $p['antall'];
?>


<!DOCTYPE html>
<html lang="nb" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/css/styleLp.css"/>
    <link rel="stylesheet" href="Assets/css/style2.css"/>
    <link rel="stylesheet" href="Assets/css/style_landing.css"/>
    <link rel="stylesheet" href="Assets/css/styleMeny.css"/>
    <link rel="stylesheet" href="Assets/css/vogn.css"/>
    <link rel="stylesheet" href="Assets/css/styleSearch.css"/>
    <link rel="stylesheet" href="Assets/css/mediaQueries.css"/>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    <script type="text/javascript" src="Assets/js/script.js" defer></script>
    <script type="text/javascript" src="Assets/js/leggivogn.js" defer></script>

    <title>Gløde Data</title>
</head>


<?php 

// === CONTENT ===

//HEADER
include("Assets/templates/header1_ny.php"); 

//VELG SIDE Å VISE
echo "<body>";
if ($side == 2) {
    include('Assets/page/sok.php');
} else if ($side == 3) {
    include('Assets/page/produkt.php');
} else if ($side == 4) {
    include('Assets/page/vogn.php');
} else {
    include('Assets/page/hjem.php');
}
echo "</body>";

//FOOTER
include('Assets/templates/footer1.html');

// === END CONTENT ===
?>
</html>