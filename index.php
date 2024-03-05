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
    //DEBUG
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Start session og set variabler til valg hvis noe er i _GET eller default hvis ikke.
    session_start();
    $_SESSION['page'] =  isset($_GET['page']) ? $_GET['page'] : 0;
    $_SESSION['type'] =  isset($_GET['type']) ? $_GET['type'] : 0;
    $_SESSION['param'] = isset($_GET['param']) ? $_GET['param'] : "^.*%";

    // === CONTENT ===

    //HEADER
    include("Assets/templates/header1.php"); 

    //SIDEVISNING
    //default:side 1 - hjem
    //side 2: søkeside (type=x, param=x, nivaa=?)
    //side 3: om oss
    //side 4: produktvisning; type=?, param=x nivaa=4
    //side 5: vogn.
    echo "<body>";
    if ($_SESSION['page'] == 2) {
      include('Assets/page/sok.php');
    } else if ($_SESSION['page'] == 3) {
      include('Assets/page/produkt .php');
    } else if ($_SESSION['page'] == 4) {
      include('Assets/page/produkt.php');
    } else if ($_SESSION['page'] == 5) {
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