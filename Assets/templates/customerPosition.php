<?php
  echo '<section class="customerPosition">';
  echo '<h2 class="positionText">Du er her:';

  //Print div? span? w/e? for opptil 4 nivåer;
  //1. Alle produkter (base), 2. superkategori (hvis spesifisert.. type PC, Tjenester), 3. kategori og 4. enkeltprodukt

  //Finn visningsnivå
  $nivaa = isset($_SESSTION['nivaa']) ? $_SESSION['nivaa'] : 1;

  if ($nivaa > 0) { 
    //alle produkter
  }
  if ($nivaa > 1) {
    //superkategori
  }
  if ($nivaa > 2) {
    //kategori
  }
  if ($nivaa > 3) {
    //produkt
  }


  echo "</h2>";
  echo "</section>";