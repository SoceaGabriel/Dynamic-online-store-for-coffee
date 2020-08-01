<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Detalii comandă</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> <a href="orders.php"> Comenzi </a> <i class="fa fa-chevron-right"></i> Detalii comandă</p>
  </div>

  <?php
  //se seteaza id-ul utilizatorului si statusul comenzii
    if(isset($_POST['detalii_com']))
    {
      $pret_total=0;
      $id_comanda = $_POST['id_com_hidden']; //ID-ul comenzii pentru a afisa produsele comandate
      $query_com = 'select * from comenzi_curente where id_comanda = '.$id_comanda;
      $parse_com = oci_parse($c, $query_com);
      oci_execute($parse_com);
      if(oci_fetch($parse_com))
      {
        $id_usr = oci_result($parse_com,'ID_USER'); //ID utilizator pentru a afisa datele cumparatorului
        $Status = oci_result($parse_com,'STATUS_COMANDA'); //Statusul comenzii
      }
    }
  ?>

  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Detalii pentru comanda numărul <?php echo $id_comanda; ?></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <!--Status comanda-->
          <div>
            <div class="btn bg-warning text-center col-md-8 col-sm-8 offset-xl-2">Status comandă: <b><?php echo $Status; ?></b></div><br/><br/><br/>
          </div>
          <!--Afisam informatiile despre utilizator-->
          <?php
          $cursor_ad = oci_new_cursor($c);
          $query_ad = 'begin utilizatori_func.select_admin_profile(:adm,:id_adm); end;';
          $parse_ad = oci_parse($c,$query_ad);
          oci_bind_by_name($parse_ad, ":adm", $cursor_ad, -1, OCI_B_CURSOR);
          oci_bind_by_name($parse_ad, ":id_adm", $id_usr);
          oci_execute($parse_ad);
          oci_execute($cursor_ad);
          if(oci_fetch($cursor_ad))
          {
            //setare variabile php cu datele din baza de date
            $var1 = oci_result($cursor_ad,'NUME');
            $var2 = oci_result($cursor_ad,'PRENUME');
            $var3 = oci_result($cursor_ad,'TELEFON');
            $var4 = oci_result($cursor_ad,'EMAIL');
            $var5 = oci_result($cursor_ad,'LOCALITATE');
            $var6 = oci_result($cursor_ad,'JUDET');
            $var7 = oci_result($cursor_ad,'COD_POSTAL');
            $var8 = oci_result($cursor_ad,'ADRESA');
          }
          oci_free_statement($cursor_ad);
          ?>

          <div class="profile_header text-center">Detalii client</div>
          <!--Nume si prenume-->
          <div class="profile_item">
            <div class="profile_header">Nume și prenume client</div>
            <div class="text_profile"><?php echo $var1." ".$var2; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Email-->
          <div class="profile_item">
            <div class="profile_header">Email client</div>
            <div class="text_profile"><?php echo $var4; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Telefon-->
          <div class="profile_item">
            <div class="profile_header">Telefon client</div>
            <div class="text_profile">0<?php echo $var3; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Localitate-->
          <div class="profile_item">
            <div class="profile_header">Localitate livrare</div>
            <div class="text_profile"><?php echo $var5; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Judet-->
          <div class="profile_item">
            <div class="profile_header">Județ livrare</div>
            <div class="text_profile"><?php echo $var6; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Cod postal-->
          <div class="profile_item">
            <div class="profile_header">Cod poștal</div>
            <div class="text_profile"><?php echo $var7; ?></div>
          </div>
          <hr class="hr_profile"/>

          <!--Adresa-->
          <div class="profile_item">
            <div class="profile_header">Adresa de livrare</div>
            <div class="text_profile"><?php echo $var8; ?></div>
          </div>
          <hr class="style-eight"/>

          <!--Afisam tabela cu produsele din comanda-->
          <br/><br/><div class="profile_header text-center">Produse comandate</div>

          <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead class="header-table-orders-det">
                <!--Antet tabel produse comanda-->
                <tr>
                  <th>Cod produs</th>
                  <th>Nume produs</th>
                    <th>Tip produs</th>
                  <th>Cantitate(g)</th>
                  <th>Număr bucăți comandate</th>
                  <th>Preț per bucată(Lei)</th>
                  <th>Preț total(Lei)</th>
                </tr>
              </thead>


              <tbody>
                <?php
                //afisarea produselor in tabel
                $query_detail = 'select cod_produs_comandat, nr_bucati_comandate, pret_per_buc, pret_total from produse_comanda where comenzi_curente_id_comanda = '.$id_comanda;
                $parse_detail = oci_parse($c,$query_detail);
                oci_execute($parse_detail);
                while(oci_fetch($parse_detail))
                {
                  $prod_com = oci_result($parse_detail,'COD_PRODUS_COMANDAT');
                  $nr_buc_com = oci_result($parse_detail,'NR_BUCATI_COMANDATE');
                  $pret_buc = oci_result($parse_detail,'PRET_PER_BUC');
                  $pret_tot = oci_result($parse_detail,'PRET_TOTAL');
                  $pret_total = $pret_total + $pret_tot;
                  echo "<tr>";
                  echo "<td>".$prod_com."</td>"; //cod produs comandat

                  $query_prods = 'select * from produse where cod_produs = '.$prod_com;
                  $parse_prods = oci_parse($c,$query_prods);
                  oci_execute($parse_prods);
                  if(oci_fetch($parse_prods))
                  {
                    $nume_pr = oci_result($parse_prods,'NUME_CAFEA');
                    echo "<td>".$nume_pr."</td>"; //numele produsului
                    $tip_prod = oci_result($parse_prods,'TIP_CAFEA');
                    echo "<td>".$tip_prod."</td>"; //tipul produsului
                    $canti = oci_result($parse_prods,'CANTITATE');
                    echo "<td>".$canti."</td>"; //gramajul produsului
                    $prom = oci_result($parse_prods,'PROMOTIE');
                  }
                  echo "<td>".$nr_buc_com."</td>"; //nr bucatilor comandate
                  echo "<td>".$pret_buc."</td>"; //afisam pretul per bucata
                  echo "<td>".$pret_tot."</td>"; //afisam pretul actualizat cu nr de produse
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
            <?php
              //afisare nr de produse
              $query_total = 'select count(*) as "NR_TOTAL" from produse_comanda where comenzi_curente_id_comanda = '.$id_comanda;
              $parse_total = oci_parse($c, $query_total);
              oci_execute($parse_total);
              if(oci_fetch($parse_total))
              {
                if(oci_result($parse_total,'NR_TOTAL')>0)
                {
                  echo "<span class='text-green'>Sunt ".oci_result($parse_total,'NR_TOTAL')." tipuri de produse in aceasta comanda.</span><br/>";
                  echo "<span class='text-green'>Prețul total al comenzii este ".$pret_total." lei.</span>";
                }
                else
                {
                  echo "<span class='text-red'>Nu sunt produse comanadate</span>";
                }
              }
            ?>
          </div>

          <!--Buton inapoi-->
          <br/>
          <div style="text-align:center;">
            <a href="orders.php" class="btn btn-info">Înapoi la comenzi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section>

<?php
//include footer and scripts
include "./templates/footer.php";
?>
