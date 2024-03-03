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