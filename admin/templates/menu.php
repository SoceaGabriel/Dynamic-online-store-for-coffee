<!--Meniul lateral-->
<aside class="menu-bar" id="myTopnav">
  <ul>
    <!--Meniu lateral-->
    <li class="menu-link" id="dashboard" onclick="setActive(dashboard);"><a href="dashboard.php"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;Dashboard</a></li>
    <li class="menu-link" id="profile" onclick="setActive(profile);"><a href="profile.php"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;Profilul meu</a></li>
    <li class="menu-link" id="products" onclick="setActive(products);"><a href="products.php"><i class="fa fa-cube"></i>&nbsp;&nbsp;Produse</a></li>

      <!--Submeniu pentru produse-->
      <ul>
        <li class="submenu-link" id="add_product"><a href="add_product.php"><i class="fa fa-chevron-right"></i>&nbsp;Adăugare produs</a></li>
        <li class="submenu-link"><a href="products.php"><i class="fa fa-chevron-right"></i>&nbsp;Modificare produs</a></li>
        <li class="submenu-link"><a href="products.php#actualizare_stocuri"><i class="fa fa-chevron-right"></i>&nbsp;Actualizare stocuri</a></li>
        <li class="submenu-link"><a href="products.php"><i class="fa fa-chevron-right"></i>&nbsp;Ștergere produs</a></li>
      </ul>

    <!--Meniu lateral-->
    <li class="menu-link" id="users" onclick="setActive(users);"><a href="users.php"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Utilizatori</a></li>

    <!--Submeniu pentru utilizatori-->
    <ul>
      <li class="submenu-link"><a href="users.php#admins"><i class="fa fa-chevron-right"></i>&nbsp;Admini</a></li>
      <li class="submenu-link"><a href="users.php#clienti"><i class="fa fa-chevron-right"></i>&nbsp;Clienți</a></li>
    </ul>

    <li class="menu-link" id="orders" onclick="setActive(orders);"><a href="orders.php"><i class="fa fa-shopping-basket"></i>&nbsp;&nbsp;Comenzi</a></li>

    <!--Submeniu pentru comenzi-->
    <ul>
      <li class="submenu-link"><a href="orders.php#comenzi"><i class="fa fa-chevron-right"></i>&nbsp;Listă comenzi</a></li>
      <li class="submenu-link"><a href="orders.php#status_c"><i class="fa fa-chevron-right"></i>&nbsp;Modificare status</a></li>
    </ul>

    <li class="menu-link" id="orders_history" onclick="setActive(orders_history);"><a href="orders_history.php"><i class="fa fa-archive"></i>&nbsp;&nbsp;Istoric comenzi</a></li>
    <li class="menu-link" id="statistics" onclick="setActive(statistics);"><a href="statistics.php"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;Statistici</a></li>

    <!--Submeniu pentru comenzi-->
    <ul>
      <li class="submenu-link"><a href="statistics.php#prod"><i class="fa fa-chevron-right"></i>&nbsp;Produse</a></li>
      <li class="submenu-link"><a href="statistics.php#com"><i class="fa fa-chevron-right"></i>&nbsp;Comenzi</a></li>
      <li class="submenu-link"><a href="statistics.php#ca"><i class="fa fa-chevron-right"></i>&nbsp;Cifra afaceri</a></li>
      <li class="submenu-link"><a href="statistics.php#medii"><i class="fa fa-chevron-right"></i>&nbsp;Statistici medii</a></li>
    </ul>

  </ul>
</aside>
