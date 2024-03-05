<?php 
    //DEBUG
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Start session og set variabler fra evd get. Lag anonym bruker og set cookie hvis nødvendig
    session_start();
    print_r($_COOKIE);
    if (!isset($_COOKIE['id'])) {
      nyBruker();
    }
    oppdaterBruker();
    //print "$_SERVER['HTTP_HOST']";

    $_SESSION['page'] =  isset($_GET['page']) ? $_GET['page'] : 0;
    $_SESSION['type'] =  isset($_GET['type']) ? $_GET['type'] : 0;
    $_SESSION['param'] = isset($_GET['param']) ? $_GET['param'] : "^.*%";

    echo $_COOKIE['id'] . " " . $_SESSION['page'];

    function nyBruker() {
      $con = mysqli_connect("localhost", "root", "", "Temp");
      //hvis feil - exit
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }

      //lager ny bruker
      $query = "INSERT INTO KUNDE (sist_sett) VALUES (NOW())";
      if (mysqli_query($con, $query)) {
        $last_id = mysqli_insert_id($con);
        $_COOKIE['id'] = $last_id;
      }
    }

    function oppdaterBruker() {
      $con = mysqli_connect("localhost", "root", "", "Temp");
      //hvis feil - exit
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }

      //oppdater sist-sett
      $query = "UPDATE KUNDE SET sist_sett = NOW() WHERE kundeID = " . $_COOKIE['id'];
      if (mysqli_query($con, $query)) {
        //workaround så cookies virker på localhost også
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie('id', $_COOKIE['id'], time() + 14*24*60*60, "/", $domain, false);
        echo "OPPDATERT";
      }
    }
?>

<!DOCTYPE html>
<html lang="nb" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Assets/css/styleLp.css"/>
    <link rel="stylesheet" href="Assets/css/styleMeny.css"/>
    <link rel="stylesheet" href="Assets/css/textOmOss.css"/>
    <link rel="stylesheet" href="Assets/css/mediaQueries.css"/>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    <title>Gløde Data</title>
  </head>


  <?php 
    // === CONTENT ===

    //HEADER
    include("Assets/templates/header1_ny.php"); 

    //SIDEVISNING
    //default:side 1 - hjem
    //side 2: søkeside (type=x, param=x, nivaa=?)
    //side 3: produktvisning; type=?, param=x nivaa=4
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