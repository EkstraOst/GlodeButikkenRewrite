<!DOCTYPE html>
<html lang="nb" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Assets/css/styleLp.css"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/css/styleMeny.css"/>
    <script src="Assets/js/script.js" async defer></script>
    
    <!--  <link rel="stylesheet" href="products.css"/>  -->
   
    <!-- <link rel="stylesheet" href="/GlodeButikken/style.css">
    <link rel="stylesheet" href="/GlodeButikken/imageanimation.css">
    <link rel="stylesheet" href="/GlodeButikken/slide.css"> -->

    <!-- Tab title-->
    <title>Gløde Data</title>

   </head>

<body>

<?php include("/Assets/templates/header1.html"); ?>

  <main>
        <!--Main title-->
        <!--Kodet av Sandra og Amalie-->
      <h1 class="main_title">Hvorfor Velge Gløde Butikken?</h1>
      <div class="splashPosition">
        <img class="imgSplash" src="Assets/Splash2.jpg" alt="Bilde av masse laptoper i butikkhyllen">
      </div>

      <div class="slide">
              <!--tenkte vi kan gjøre sån at det slider bytter på paragrafer -->
          <p class="anim-1 text">Alle våre IKT produkter har fått en gundig gjenomgang før de blir lagt ut for salg</p>
          <p class="anim-2 text">Miljøbevisst, det er viktig at vi tar vare på miljøet og gjenbruker brukt IKT utstyr</p>
          <p class="anim-3 text">GlødeButikken har gunstige  priser  og Rask levering</p>

      </div>
          <!--infomasjon og salg -->
      <div class="textImgPosition">
        <div class="iTextWbtn">
          <div class="infoText">
              <h2 class="h1LP">Brukt IKT</h2>
              <h3 class="h3LP">salg av laptoper, stasjonære datamaskiner, skjermer.</h3>
              <p class="pLP">Gratis frakt ved kjøp over NOK 2.500,-
                  "Forutsetter vekt under 20 kilo"</p>
              <p class="pLP">Gløde har egen butikk og “klikk og hent” på Mjåtveitflaten 35 </p>
              <p class="pLP">Åpningstider: Alle hverdager 08.00 - 15:00</p>
          </div>

          <button class="btn" id="button"><a class="btnProduct" href="/ProductList/indexPl.html">Se produkter</a></button>
          <!-- above is placeholderlink, Sandra Fix-->

        </div>
        <div>
          <img class="leftImg" src="Assets/Desk1.jpg" alt="Bilde av skranken i Gløde Data Butikken">
        </div>
      </div>
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
  <script src="/script.js"></script>
</body>
</html>