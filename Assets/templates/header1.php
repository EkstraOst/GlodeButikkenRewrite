
  <header class="navHeader">
      <nav>
        <div class="navbar">  
        <div class="header-icon">
            <a href="/index.php?page=1">
                <img class="imgLogo" src="Assets/Icons/logo_wWhite2.png" alt="left icon">
              </a>
        </div>
          <i class='bx bx-menu'></i>    
          <!--Defines the logo-->
          <div class="logoHeader"><a href="index.php?page=1">Gløde Data</a></div>

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
              <li><a href="index.php?page=1">Hjem </a></li>
              <li>
                <!--placeholder link, temp solution-->
                <a href="index.php?type=0&page=2">Produkter og Tjenester</a>
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
                    $i = 0;
                    if ($result = mysqli_query($con, $query)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        echo '<li><a href="index.php?page=2&type=1&param=' . $row['kategori'] . '">' . $row['kategori'] . '</a></li>';
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
              <li><a href="index.php?page=3">Om Oss</a></li>
              <li><a href="https://glode.no/glode/tilsette/">Ta kontakt</a></li>
            </ul>
            
          </div>
          <!--Shopping cart button kodet av Amalie -->
          <button class="shoppingCartButton">
            <a href="/Handlekurv/indexKurv.html">
              <img class="shoppingCart" src="Assets/Icons/shopping-cart_Main.png" alt="Shopping Cart">
            </a>
          </button>
        </div>
      </nav>
  </header>
