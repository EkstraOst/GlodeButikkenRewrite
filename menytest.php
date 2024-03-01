<ul class="htmlCss-sub-menu sub-menu">
                  
                  <!-- Sub-meu for "PC" within "Produkter" menu -->
                  <li class="more">
                    <span><a href="#">PC</a>
                      <i class='bx bxs-chevron-right arrow more-arrow'></i>
                    </span>
                  <!-- using the css class to style from "more"-->
                    <ul class="more-sub-menu sub-menu">
                      <li><a href="#">Stasjonær</a></li>
                      <li><a href="/ProductList/indexPl.html">Laptop</a></li>
                    </ul>
                  </li>
                  
                  <li><a href="#">Skjermer</a></li>
                  <li class="more">
                    <!-- Skrev "Mer" fordi "Tilbehør" ble et for stort ord i forhold til stylingen, 
                    kan endres på seinere -Mvh Polly-->
                    <span><a href="#">Mer</a>
                      <i class='bx bxs-chevron-right arrow more-arrow'></i>
                    </span>
                  <!--Sub-menu for "More" within the "Produkter" menu-->
                    <ul class="more-sub-menu sub-menu">
                      <li><a href="#">Tastatur</a></li>
                      <li><a href="/Produkter/Tilbehoer/Rexel_makuleringsmaskin/indexRM.html">Makulering</a></li>
                      <li><a href="/Produkter/Tilbehoer/Toner_and_blekk/indexTB.html">Toner og blekk</a></li>
                    </ul>
                  </li>
                </ul>


Superkategori:

<ul class="htmlCss-sub-menu sub-menu">
    <!-- SELECT DISTINCT kategori FROM PRODUKT -->
    <?php 
      $con = mysqli_connect("localhost","root","","Temp");
      //hvis feil - exit
      if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
      }

      $query = "SELECT DISTINCT kategori FROM PRODUKT";
      if ($result = mysqli_query($con, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li><a href="index.php?kategori=' . $row['kategori'] . '">' . $row['kategori'] . '</a></li>'
        }
      }
    ?>
</ul>


Kategori:
Stasjonær
Laptop
Skjerm
Tastatur

Makuleringsmaskin
Toner og blekk

Sikker sletting