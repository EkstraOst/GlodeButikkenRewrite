<!DOCTYPE html>
<html lang="nb" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Assets/css/styleLp.css"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/css/styleMeny.css"/>
    <?php 
      if (isset($_GET['page']) && $_GET['page'] == 3) {
        echo '<link rel="stylesheet" href="/OMOSSSIDE/CSS/textOmOss.css"/>';
        echo '<link rel="stylesheet" href="/OMOSSSIDE/CSS/mediaQueryOmOss.css"/>';
      }
    ?>
    <script src="Assets/js/script.js" async defer></script>
    
    <!--  <link rel="stylesheet" href="products.css"/>  -->
    
    <!-- <link rel="stylesheet" href="/GlodeButikken/style.css">
    <link rel="stylesheet" href="/GlodeButikken/imageanimation.css">
    <link rel="stylesheet" href="/GlodeButikken/slide.css"> -->

    <!-- Tab title-->
    <title>Gløde Data</title>

  </head>

<body>

<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  session_start();

  $_SESSION['page'] =  isset($_GET['page']) ? $_GET['page'] : "0";
  $_SESSION['type'] =  isset($_GET['type']) ? $_GET['type'] : "0";
  $_SESSION['param'] = isset($_GET['param']) ? $_GET['param'] : "^.*%";

  include("Assets/templates/header1.php"); 


  //DEBUG
  if (isset($_SESSION['page'])) {
    echo $_SESSION['page'];
  }
  
  if (isset($_GET['type'])) {
    echo $_GET['type'];
  }
  //end DEBUG

?>

  <main>
      <?php
        if ($_SESSION['page'] == 2) {
          include('Assets/page/sok.php');
        } else if ($_SESSION['page'] == 3) {
          include('Assets/page/om.php');
        } else {
          include('Assets/page/hjem.php');
        }
      ?>
  </main>



<footer>
    <!--- Sender deg videre til siden som knappene sender deg til originalt. -->
    <div class="footer-btns">
      <a href="https://glode.no/" class="footer-btn"> GLØDE ARBEIDSINKLUDERING AS </a>
      <a href="https://glode.no/wp-content/uploads/2023/12/Personvernerklaering.pdf" class="footer-btn"> Personvernserklæring </a>
      <a href="https://glode.no/glode-data/" class="footer-btn"> C Gløde Data Butikken </a>
    </div>
    <!-- linkene/placeholder over må endres til relevante linker -mvh Polly   .-DONE -->
</footer>
  </div>
  <!-- <script src="/GlodeButikken/imageanimation.js"></script> -->
  <!--Hæh? Vi må finne ut hvor imageanimation skal og plassere js filen til den på rett plass, kommenterer den ut foreløpig -->
  <!--Links to an external JavaScript file for dynamic behavior.-->
</body>
</html>