<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Statistici</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> Statistici</p>
  </div>

  <div class="col-md-12 col-sm-12" id="prod">
  <div class="x_panel">
    <div class="x_title">
      <h2>Date statistice</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>

    <div class="row" style="display: inline-block;">
      <div class="profile_header text-center">Statistici produse</div>
        <!--Numar total de produse-->
        <?php
          $query_total = 'begin produse_func.total_produse(:tot); end;';
          $parse_total = oci_parse($c, $query_total);
          oci_bind_by_name($parse_total, ":tot", $total_prd);
          oci_execute($parse_total);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-cubes"></i></div>
            <div class="count"><?php echo $total_prd; ?></div>
            <h3>Numar total de produse</h3>
          </div>
        </div>

        <!--Numar de produse din categoria cafea macinata-->
        <?php
          $query_m = 'begin produse_func.total_cat(\'cafea_macinata\', :tot); end;';
          $parse_m = oci_parse($c, $query_m);
          oci_bind_by_name($parse_m, ":tot", $total_m);
          oci_execute($parse_m);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square"></i></div>
            <div class="count"><?php echo $total_m; ?></div>
            <h3>Numar produse de tip cafea macinata</h3>
          </div>
        </div>

        <!--Numar de produse din categoria cafea boabe-->
        <?php
          $query_b = 'begin produse_func.total_cat(\'cafea_boabe\', :tot); end;';
          $parse_b = oci_parse($c, $query_b);
          oci_bind_by_name($parse_b, ":tot", $total_b);
          oci_execute($parse_b);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-circle-o"></i></div>
            <div class="count"><?php echo $total_b; ?></div>
            <h3>Numar produse de tip cafea boabe</h3>
          </div>
        </div>

        <!--Numar de produse din categoria cafea capsule-->
        <?php
          $query_c = 'begin produse_func.total_cat(\'cafea_capsule\', :tot); end;';
          $parse_c = oci_parse($c, $query_c);
          oci_bind_by_name($parse_c, ":tot", $total_c);
          oci_execute($parse_c);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-circle"></i></div>
            <div class="count"><?php echo $total_c; ?></div>
            <h3>Numar produse de tip cafea capsule</h3>
          </div>
        </div>

        <!--Numar de produse din categoria cafea paduri-->
        <?php
          $query_p = 'begin produse_func.total_cat(\'cafea_paduri\', :tot); end;';
          $parse_p = oci_parse($c, $query_p);
          oci_bind_by_name($parse_p, ":tot", $total_p);
          oci_execute($parse_p);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check"></i></div>
            <div class="count"><?php echo $total_p; ?></div>
            <h3>Numar produse de tip cafea paduri</h3>
          </div>
        </div>

        <!--Numar de produse din categoria cafea instant-->
        <?php
          $query_i = 'begin produse_func.total_cat(\'cafea_instant\', :tot); end;';
          $parse_i = oci_parse($c, $query_i);
          oci_bind_by_name($parse_i, ":tot", $total_i);
          oci_execute($parse_i);
        ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
            <div class="count"><?php echo $total_i; ?></div>
            <h3>Numar produse de tip cafea instant</h3>
          </div>
        </div>
      </div>
      <hr class="hr_profile"/><br/>
        <!--Numarul de comenzi de pana acum-->
        <?php
          //afisare nr de produse
          $query_total = 'select count(distinct id_comanda) as "NR_TOTAL" from istoric_comenzi';
          $parse_total = oci_parse($c, $query_total);
          oci_execute($parse_total);
          if(oci_fetch($parse_total))
          {
            $total_ist = oci_result($parse_total,'NR_TOTAL');
          }

          $query_com = 'select count(*) as "NR_TOTAL" from comenzi_curente';
          $parse_com = oci_parse($c, $query_com);
          oci_execute($parse_com);
          if(oci_fetch($parse_com))
          {
            $total_com = oci_result($parse_com,'NR_TOTAL');
          }
          $tot = $total_ist + $total_com;
        ?>

        <div class="profile_header text-center">Statistici comenzi</div>
        <!--Nr de comenzi-->
        <div class="col-md-12" id="com">
          <div class="row">
            <!--Nr total de comenzi-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="info-box green-bg">
                <i class="fa fa-shopping-cart"></i>
                <div class="count"><?php echo $tot; ?></div>
                <div class="title">Numărul total de comenzi</div>
              </div>
            </div>

            <!--Din care finalizate-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="info-box lime-bg ">
                <i class="fa fa-handshake-o"></i>
                <div class="count"><?php echo $total_ist; ?></div>
                <div class="title">Din care comenzi finalizate</div>
              </div>
            </div>

            <!--Si neprocesate-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="info-box brown-bg">
                <i class="fa fa-database"></i>
                <div class="count"><?php echo $total_com; ?></div>
                <div class="title">Din care comenzi neprocesate</div>
              </div>
            </div>
          </div>
          <hr class="hr_profile"/><br/>
        </div>

        <!--Cifra de afaceri-->
        <div class="profile_header text-center">Statistici privind cifra de afaceri</div>
        <?php
          //afisare cifra de afaceri
          $query_cf_com = 'begin COM_CRT_FUNC.CA_ULTIMA_LUNA(:rez_cf_com); end;';
          $parse_cf_com = oci_parse($c, $query_cf_com);
          oci_bind_by_name($parse_cf_com, ":rez_cf_com", $rez_cf_c);
          oci_execute($parse_cf_com);

          $query_cf_ist = 'begin ISTORIC_FUNC.CA_ULTIMA_LUNA_ISTORIC(:rez_cf_ist); end;';
          $parse_cf_ist = oci_parse($c, $query_cf_ist);
          oci_bind_by_name($parse_cf_ist, ":rez_cf_ist", $rez_cf_i);
          oci_execute($parse_cf_ist);
          $ca_tot = $rez_cf_c + $rez_cf_i;
        ?>

        <div class="col-md-12" id="ca">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 offset-md-3">
              <div class="row">
                  <div class="info-box twitter-bg">
                    <i class="fa fa-money"></i>
                    <div class="count"><?php echo $ca_tot; ?> LEI</div>
                    <div class="title">Cifra de afaceri obținută în ultima lună</div>
                  </div>
              </div>
            </div>
          </div>
          <hr class="hr_profile"/><br/>
        </div>


      <!--Statistici nr medii-->
      <div class="profile_header text-center">Statistici medii</div>

      <?php
        $nr_buc = 9999999999;
        $id_cm = 9999999999;
        $pret_ttt = 99999999999;
        $query_mediu = 'begin ISTORIC_FUNC.MEDIU_PRODUSE_PRET(:nr_buc, :id_com, :pret_ttt); end;';
        $parse_mediu = oci_parse($c, $query_mediu);
        oci_bind_by_name($parse_mediu, ":nr_buc", $nr_buc);
        oci_bind_by_name($parse_mediu, ":id_com", $id_cm);
        oci_bind_by_name($parse_mediu, ":pret_ttt", $pret_ttt);
        oci_execute($parse_mediu);
      ?>

      <div class="col-md-12" id="medii">
        <div class="row">
          <!--Nr mediu de produse/comanda-->
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box dark-heading-bg">
              <i class="fa fa-line-chart"></i>
              <div class="count"><?php echo number_format($nr_buc/$id_cm, 2, ',', ' '); ?> Produse</div>
              <div class="title">Nr mediu de produse / comandă</div>
            </div>
          </div>

          <!--Pret mediu/comanda-->
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-cc-visa"></i>
              <div class="count"><?php echo number_format($pret_ttt/$id_cm, 2, ',', ' '); ?> Lei</div>
              <div class="title">Preț mediu / comandă</div>
            </div>
          </div>
        </div>
        <hr class="hr_profile"/><br/>
      </div>


    </div>

  </div>

</section>

<?php
//include footer and scripts
include "./templates/footer.php";
?>
