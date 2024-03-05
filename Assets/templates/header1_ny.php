<header class="navHeader">
  <nav>
    <div class="navbar">
      <div class="header-icon">
        <a href="/index.php?page=1">
          <img class="imgLogo" src="Assets/Icons/logo_wWhite2.png" alt="left icon">
        </a>
      </div>
      <i class='bx bx-menu'></i>
      <div class="logoHeader"><a href="index.php?page=1">Gløde Data</a></div>

      <div class="mode-toggle" onclick="toggleMode()">
        <div class="circle"></div>
      </div>
      <div class="nav-links">
        <div class="sidebar-logo">

          <i class='bx bx-x'></i>
        </div>
        <ul class="links">
          <li><a href="index.php?page=1">Hjem </a></li>
          <li>
            <a href="index.php?type=0&page=2">Produkter og Tjenester</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">

              <?php
              $con = mysqli_connect("localhost", "root", "", "Temp");
              //hvis feil - exit
              if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
              }

              //hent alle superkategorier som har aktive kategotier
              $skat_query = "select * from SUPERKATEGORI s where exists (select * from (select * from kategori t where exists (select * from PRODUKT p where p.kategoriID = t.kategoriID)) k where k.s_kategoriID = s.s_kategoriID)";
              if ($result_sk = mysqli_query($con, $skat_query)) {
                while ($skrow = mysqli_fetch_assoc($result_sk)) {
                  //Superkategori-meny
                  echo '<li class="more">'; 
                  echo  '<span><a href="index.php?page=2&type=1&param=' . $skrow['s_kategoriID'] . '">' . $skrow['navn'] . '</a>'; //TODO: fix link og GET koder for superkategori-søk
                  echo  "  <i class='bx bxs-chevron-right arrow more-arrow'></i>";
                  echo  '</span>';
                  echo  '<ul class="more-sub-menu sub-menu">';
                  //Så kommer undermeny med kategorier

                  $kat_query = "select * from KATEGORI k where exists (select * from PRODUKT p where p.kategoriID = k.kategoriID) AND k.s_kategoriID = '" . $skrow['s_kategoriID'] . "'";
                  if ($result_k = mysqli_query($con, $kat_query)) {
                    while ($krow = mysqli_fetch_assoc($result_k)) {
                      echo '<li><a href="index.php?page=2&type=2&param=' . $krow['kategoriID'] . '">' . $krow['navn'] . '</a></li>';
                    }
                  }
                  //avsluttende html
                  echo "  </ul>";
                  echo "</li>";
                }
              }


              ?>

            </ul>
          </li>
          <li><a href="index.php?page=3">Om Oss</a></li>
          <li><a href="https://glode.no/glode/tilsette/">Ta Kontakt</a></li>
        </ul>
      </div>
      <!--Shopping cart button kodet av Amalie -->
      <button class="shoppingCartButton">
        <a href="/index.php?page=6">
          <img class="shoppingCart" src="Assets/Icons/shopping-cart_Main.png" alt="Handlevogn">
        </a>
      </button>
    </div>
  </nav>
</header>

