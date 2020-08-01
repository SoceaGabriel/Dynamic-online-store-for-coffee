<?php
//include header information and top bar
include "./templates/top.php";

//include navigation bar
include "./templates/menu.php";
?>

<!--Partea principala a panoului de control-->
<section class="main-content">
  <div class="page-name">
    <p>Istoric Comenzi</p>
    <p class="path-link"><a href="dashboard.php">Home</a> <i class="fa fa-chevron-right"></i> Istoric Comenzi</p>
  </div>

  <div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Istoricul tuturor comenzilor de până acum</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>

    <!--Tabelul cu istoricul produselor-->
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead class="header-table-history">
                <tr>
                  <th>Număr curent</th>
                  <th>ID Comandă</th>
                  <th>ID Utilizator</th>
                  <th>Nume și prenume client</th>
                  <th>Număr produse comandate</th>
                  <th>Data efectuării comenzii</th>
                  <th>Data finalizării comenzii</th>
                  <th>Detalii comandă</th>
                </tr>
              </thead>


              <tbody>
                <?php
                //afisarea produselor in tabel
                $i=1;
                $query_cod_com = 'select distinct id_comanda from istoric_comenzi';
                $parse_cod_com = oci_parse($c,$query_cod_com);
                oci_execute($parse_cod_com);
                while(oci_fetch($parse_cod_com))
                {
                  $cod_com = oci_result($parse_cod_com, 'ID_COMANDA');
                  $cursor_comenzi = oci_new_cursor($c);
                  $query_comenzi = 'begin istoric_func.select_comenzi(:id_c ,:crsr); end;';
                  $parse_comenzi = oci_parse($c,$query_comenzi);
                  oci_bind_by_name($parse_comenzi, ":id_c", $cod_com);
                  oci_bind_by_name($parse_comenzi, ":crsr", $cursor_comenzi, -1, OCI_B_CURSOR);
                  oci_execute($parse_comenzi);
                  oci_execute($cursor_comenzi);
                  while(oci_fetch($cursor_comenzi))
                  {
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    $i = $i+1;
                    echo "<td>".oci_result($cursor_comenzi,'ID_COMANDA')."</td>";
                    echo "<td>".oci_result($cursor_comenzi,'UTILIZATORI_ID_USER')."</td>";

                    //afisare nume utilizator
                    $query_name = 'select nume, prenume from utilizatori where id_user ='.oci_result($cursor_comenzi,'UTILIZATORI_ID_USER');
                    $parse_name = oci_parse($c,$query_name);
                    oci_execute($parse_name);
                    if(oci_fetch($parse_name))
                    {
                      echo "<td>".oci_result($parse_name,'PRENUME')." ".oci_result($parse_name,'NUME')."</td>";
                    }

                    //calcularea numarului de produse comandate
                    $query_sum = 'select sum(NR_BUCATI_CUMPARATE) as N_B_C from istoric_comenzi where id_comanda= '.$cod_com;
                    $parse_sum = oci_parse($c,$query_sum);
                    oci_execute($parse_sum);
                    if(oci_fetch($parse_sum))
                    {
                      $suma= oci_result($parse_sum, 'N_B_C');
                    }
                    echo "<td>".$suma."</td>";
                    echo "<td>".oci_result($cursor_comenzi,'DATA_FORMATATA')."</td>";
                    echo "<td>".oci_result($cursor_comenzi,'DATA_FINALIZARE_COM')."</td>";
                    $id_usr = oci_result($cursor_comenzi,'UTILIZATORI_ID_USER');
                    echo "<td><form method='POST' action='history_details.php'>
                                <input type='hidden' id='id_com_history' name='id_com_history' value='".$cod_com."'/>
                                <input type='hidden' id='id_user_history' name='id_user_history' value='".$id_usr."'/>
                                <input type='submit' id='detalii_history' name='detalii_history' class='btn' style='font-size:18px; color:white; background-color: #b6c70c;' title='detalii_button' aria-hidden='true' value='Vezi detalii&#8669;'/>
                              </form></td>";
                    echo "</tr>";
                  }
                  oci_free_statement($cursor_comenzi);
                }

                ?>
              </tbody>
            </table>
            <?php
              //afisare nr de produse
              $query_total = 'select count(distinct id_comanda) as "NR_TOTAL" from istoric_comenzi';
              $parse_total = oci_parse($c, $query_total);
              oci_execute($parse_total);
              if(oci_fetch($parse_total))
              {
                if(oci_result($parse_total,'NR_TOTAL')>0)
                {
                  //daca sunt comenzi
                  echo "<span class='text-green'>Sunt ".oci_result($parse_total,'NR_TOTAL')." comenzi găsite în istoric.</span>";
                }
                else
                {
                  //daca nu sunt comenzi
                  echo "<span class='text-red'>Nu sunt comenzi procesate încă!</span>";
                }
              }
            ?>
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
