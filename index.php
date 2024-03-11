<?php 
//DEBUG
error_reporting(E_ALL);
ini_set('display_errors', '1');

//FUNKSJONER
function getBilde($pid) {
  $con = new mysqli("localhost","root","","Temp");
  if ($con->connect_error) {
      die("Failed to connect to MySQL: " . $con->connect_error);
  }

  $stmt = $con->prepare("SELECT bilde from PRODUKT WHERE produktID = ?");
  $stmt->bind_param("d", $pid);
  $stmt->execute();
  $res = [$stmt->get_result()];
  echo base64_encode($res['bilde']);
}

function nyBruker($con) {
  $query = "INSERT INTO KUNDE (sist_sett) VALUES (NOW())";
  if (mysqli_query($con, $query)) {
    $last_id = mysqli_insert_id($con);
    $_SESSION['id'] = $last_id;
  } else {
    echo "Noe gikk forferdelig galt. RIP in pieces";
    exit();
  }
}

function oppdaterBruker($con) {
  //oppdater sist-sett
  $query = "UPDATE KUNDE SET sist_sett = NOW() WHERE kundeID = " . $_SESSION['id'];
  mysqli_query($con, $query);
  setcookie("id", $_SESSION['id'], time()+3600*24*14);
}


//Start session og koble til database
session_set_cookie_params(60*60*24*14, '/; samesite='. "lax", $_SERVER['HTTP_HOST'], true, true);
session_start();
$con = mysqli_connect("localhost", "root", "", "Temp");
if (mysqli_connect_errno()) {
  echo "Noe gikk galt: " . mysqli_connect_error();
  exit();
}

//Finn ut av id til bruker..
if (!isset($_SESSION['id'])) {
  if (isset($_COOKIE['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
  } else {
    nyBruker($con);
  }
}
if (!isset($_SESSION['id'])) {
  echo "Kunne ikke skape anonym id";
  exit();
}
oppdaterBruker($con);


//ordne verdier for navigering og søk
if (!isset($_SESSION['page'])) { $_SESSION['page'] = 1; }
if (!isset($_SESSION['type'])) { $_SESSION['type'] = 0; }
if (!isset($_SESSION['param'])) { $_SESSION['param'] = ".*"; }
$_SESSION['page'] =  isset($_GET['page']) ? $_GET['page'] : $_SESSION['page'];
$_SESSION['type'] =  isset($_GET['type']) ? $_GET['type'] : $_SESSION['type'];
$_SESSION['param'] = isset($_GET['param']) ? $_GET['param'] : $_SESSION['param'];



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
    <link rel="stylesheet" href="Assets/css/styleSearch.css"/>
    <link rel="stylesheet" href="Assets/css/textOmOss.css"/>
    <link rel="stylesheet" href="Assets/css/mediaQueries.css"/>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    <script type="text/javascript" src="Assets/js/script.js" defer></script>
    <script type="text/javascript" src="Assets/js/leggIVogn.js" defer></script>
    <title>Gløde Data</title>
  </head>


<?php 


    // === CONTENT ===

    //HEADER
    include("Assets/templates/header1_ny.php"); 

    //SIDEVISNING
    //default:side 1 - hjem
    //side 2: søkeside (type=x, param=x, nivaa=?)
    //side 3: produktvisning; type=?, param=id
    //side 4: vogn.
    echo "<body>";
    if ($_SESSION['page'] == 2) {
      include('Assets/page/sok.php');
    } else if ($_SESSION['page'] == 3) {
      include('Assets/page/produkt.php');
    } else if ($_SESSION['page'] == 4) {
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