
  <header class="navHeader">
    <!--Følgene kode er for det meste laget av Sandra-->
      <!--Bruker bindestrek fordi koden knekker hvis eg ikke gjør det på den måten-->
      <!-- Endre class name og flytt "navHeader-class til nav element(se over at koden i css ikkje
        kollliderer. Gi så header ny class og style den slik at vi slipper å ha margin-top:70px i alle andre 
        filer.)"-->

      <!--Contains the navigation bar-->
      <nav>
        
        <!--Wraps the entire navigation bar.-->
        <div class="navbar">  
          <!--Innskudd kodelinje fra Amalie -->
        <div class="header-icon">
            <a href="/index.html">
                <img class="imgLogo" src="/Assets/Icons/logo_wWhite2.png" alt="left icon">
              </a>
        </div>
        <!-- fortsetter med kode fra Sandra-->    
          <!--Represents a menu icon using Boxicons.-->
          <i class='bx bx-menu'></i>    
          <!--Defines the logo-->
          <div class="logoHeader"><a href="/index.html">Gløde Data</a></div>
          <!--Amalie og Trond-Morten sin kode linje: -->
          <div class="mode-toggle" onclick="toggleMode()">
            <div class="circle"></div>
          </div>

          <!--Videre med Sandra sin kode: -->
          <!-- Contains the navigation links-->
          <div class="nav-links">
            <!-- Includes a logo and a close icon-->
            <div class="sidebar-logo">

              <!-- <span class="logo-name">Gløde Data</span> -->
              <i class='bx bx-x' ></i>
            </div>
            <!-- List of main navigation links-->
            <ul class="links">
              <li><a href="index.php">Hjem </a></li>
              <li>
                <!--placeholder link, temp solution-->
                <a href="index.php?alle">Produkter</a>
                <!-- List of main navigation links-->
                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                <!-- Sub-menu for "Produkter" with additional items.-->
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
                        echo '<li><a href="index.php?kategori=' . $row['kategori'] . '">' . $row['kategori'] . '</a></li>';
                      }
                    }
                  ?>
                </ul>
              </li>

              <!-- <li>
                <a href="/Sikker_sletting/indexSS.html">Tjenester</a>
                <i class='bx bxs-chevron-down js-arrow arrow '></i>
                <ul class="js-sub-menu sub-menu">
                  <li><a href="/Sikker_sletting/indexSS.html">Sikker sletting</a></li>
                </ul>
                ----------------  Midlertidig kommentert ut, da denne tjenesten trolig kommer under produkter i steden -------
              </li> -->
              <li><a href="/OMOSSSIDE/indexAbout.html">Om Oss Ja!</a></li>
              <li><a href="https://glode.no/glode/tilsette/">Kontakt oss</a></li>
            </ul>
            
          </div>
          <!--Shopping cart button kodet av Amalie -->
          <button class="shoppingCartButton">
            <a href="/Handlekurv/indexKurv.html">
              <img class="shoppingCart" src="/Assets/Icons/shopping-cart_Main.png" alt="Shopping Cart">
            </a>
          </button>
        </div>
      </nav>
  </header>


</body>
</html>